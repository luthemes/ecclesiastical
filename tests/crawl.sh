#!/usr/bin/env bash
#
# Requests every page of the test site and checks each one renders.
#
# Usage: tests/crawl.sh /path/to/site
#
# Meant to run after tests/import-test-data.sh. For each path from
# tests/urls.php, checks the response is 200 (404 for the missing page), the
# page has the header and footer, no PHP error was printed, and the site did
# not show its critical error page. Then checks a few edge cases from the test
# data and the theme's settings, and that debug.log has no PHP errors,
# warnings or notices.
#
# Use the same SITE_URL as tests/setup.sh.

set -uo pipefail

WP_DIR="${1:?Usage: crawl.sh /path/to/site}"
SITE_URL="${SITE_URL:-http://127.0.0.1:8889}"
ADDRESS="${SITE_URL#http://}"
THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOG="$WP_DIR/wp-content/debug.log"
OUT="$(mktemp -d)"
FAILED=0
COUNT=0

php -S "$ADDRESS" -t "$WP_DIR" > "$OUT/server.log" 2>&1 &
SERVER=$!
trap 'kill $SERVER 2>/dev/null; rm -rf "$OUT"' EXIT

for _ in $(seq 1 50); do
	curl -s -o /dev/null "$SITE_URL/" && break
	sleep 0.2
done

fail() { echo "FAIL $1"; FAILED=1; }

check() {
	local path="$1" expected="$2" status
	COUNT=$((COUNT + 1))
	status="$(curl -s -o "$OUT/page.html" -w '%{http_code}' "$SITE_URL$path")"

	if [ "$status" != "$expected" ]; then
		fail "$path returns $expected (got $status)"
		return
	fi

	grep -qF 'id="masthead"' "$OUT/page.html" || fail "$path: missing header"
	grep -qF 'id="colophon"' "$OUT/page.html" || fail "$path: missing footer"
	grep -qF 'critical error on this website' "$OUT/page.html" && fail "$path: critical error"
	grep -qE '<b>(Fatal error|Warning|Notice|Deprecated)</b>' "$OUT/page.html" && fail "$path: PHP error in the page"
}

# Start from the default settings, so the crawl doesn't depend on an earlier run.
php -r '
	$_SERVER["HTTP_HOST"] = "localhost";
	require $argv[1] . "/wp-load.php";
	delete_option( "ecclesiastical_settings" );
' "$WP_DIR"

rm -f "$LOG"
PATHS="$(php "$THEME_DIR/tests/urls.php" "$WP_DIR")"

while IFS= read -r path; do
	check "$path" 200
done <<< "$PATHS"

check /does-not-exist-at-all/ 404

# expect PATH TEXT DESCRIPTION
expect() {
	curl -s -o "$OUT/page.html" "$SITE_URL$1"
	grep -qF -- "$2" "$OUT/page.html" || fail "$3 (missing on $1: $2)"
}

# Theme features.
expect / 'ecclesiastical-screen' 'theme stylesheet is enqueued'
expect / 'class="site-title"' 'site title uses the theme class'
expect / 'id="primary-menu"' 'primary menu renders'
expect / 'id="menu-social"' 'social menu renders'
expect / 'class="site-footer-credit"' 'footer credit renders'
expect / 'Powered By <a class="cp-link"' 'footer links to ClassicPress'
expect / 'name="generator"' 'Backdrop adds the generator meta tag'
expect /template-paginated/ 'page-links' 'split post shows page links'
expect /template-password-protected/ 'post-password-form' 'password-protected post shows the password form'
expect /does-not-exist-at-all/ 'It looks like you stumbled upon a page' '404 shows the default message'

# The 404 page can be set to a private page in the settings.
php -r '
	$_SERVER["HTTP_HOST"] = "localhost";
	require $argv[1] . "/wp-load.php";
	update_option( "ecclesiastical_settings", [ "error_page" => (int) get_option( "ecclesiastical_test_error_page" ) ] );
' "$WP_DIR"
expect /does-not-exist-at-all/ 'Custom error page body.' '404 shows the page chosen in the settings'

if [ -s "$LOG" ]; then
	fail "debug.log has PHP errors:"
	sort "$LOG" | uniq -c | sort -rn | head -n 30
fi

if [ "$FAILED" -ne 0 ]; then
	echo "Checked $COUNT pages. Some checks failed."
	exit 1
fi

echo "Checked $COUNT pages. All passed."
