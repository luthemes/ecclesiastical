<?php
/**
 * Installs the test site, activates Ecclesiastical and adds test content.
 *
 * Usage: php tests/install.php /path/to/site
 *
 * @package Ecclesiastical
 */

$site = $argv[1] ?? '';

if ( ! $site || ! file_exists( "{$site}/wp-config.php" ) ) {
	fwrite( STDERR, "Usage: php tests/install.php /path/to/site\n" );
	exit( 1 );
}

define( 'WP_INSTALLING', true );
$_SERVER['HTTP_HOST'] = 'localhost';

require "{$site}/wp-load.php";
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

// Don't try to send the welcome email.
add_filter( 'pre_wp_mail', '__return_false' );

wp_install( 'Ecclesiastical Test', 'admin', 'admin@example.test', true, '', wp_generate_password() );
update_option( 'permalink_structure', '/%postname%/' );

switch_theme( 'ecclesiastical' );

if ( get_stylesheet() !== 'ecclesiastical' ) {
	fwrite( STDERR, "Could not activate Ecclesiastical.\n" );
	exit( 1 );
}

$errors = wp_get_theme()->errors();

if ( $errors ) {
	fwrite( STDERR, 'Theme errors: ' . implode( ', ', $errors->get_error_messages() ) . "\n" );
	exit( 1 );
}

// A sticky post, published first so it's the oldest. It should still be
// listed first on the blog.
$sticky_id = wp_insert_post( [
	'post_title'   => 'Featured Post',
	'post_name'    => 'featured-post',
	'post_content' => '<p>Sticky body.</p>',
	'post_status'  => 'publish',
	'post_date'    => '2020-01-01 00:00:00',
] );

stick_post( $sticky_id );

// A post with a comment, for the single template and the comments template.
$post_id = wp_insert_post( [
	'post_title'   => 'Test Post',
	'post_author'  => 1,
	'post_name'    => 'test-post',
	'post_content' => '<p>Post body.</p>',
	'post_status'  => 'publish',
] );

$parent = wp_insert_comment( [
	'comment_post_ID'  => $post_id,
	'comment_author'   => 'Commenter',
	'comment_content'  => 'Test comment.',
	'comment_approved' => 1,
] );

// A threaded reply.
wp_insert_comment( [
	'comment_post_ID'  => $post_id,
	'comment_parent'   => $parent,
	'comment_author'   => 'admin',
	'comment_content'  => 'Author reply.',
	'comment_approved' => 1,
	'user_id'          => 1,
] );

// A page with comments turned on, and one comment.
$guestbook_id = wp_insert_post( [
	'post_type'      => 'page',
	'post_title'     => 'Guestbook',
	'post_name'      => 'guestbook',
	'post_content'   => '<p>Sign the guestbook.</p>',
	'post_status'    => 'publish',
	'comment_status' => 'open',
] );

wp_insert_comment( [
	'comment_post_ID'  => $guestbook_id,
	'comment_author'   => 'Visitor',
	'comment_content'  => 'Guestbook comment.',
	'comment_approved' => 1,
] );

// A private page to use as the custom 404 page.
$error_id = wp_insert_post( [
	'post_type'    => 'page',
	'post_title'   => 'Custom 404',
	'post_name'    => 'custom-404',
	'post_content' => '<p>Custom error page body.</p>',
	'post_status'  => 'private',
] );

update_option( 'ecclesiastical_test_error_page', $error_id );

// Menus for the three theme locations.
$menu_id = wp_create_nav_menu( 'Test Menu' );
wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Guestbook', 'menu-item-url' => home_url( '/guestbook/' ), 'menu-item-status' => 'publish' ] );
$locations = get_theme_mod( 'nav_menu_locations', [] );
foreach ( [ 'primary', 'secondary', 'social' ] as $location ) {
	$locations[ $location ] = $menu_id;
}
set_theme_mod( 'nav_menu_locations', $locations );

// Save the rewrite rules for the new permalink structure.
flush_rewrite_rules();

printf( "Installed ClassicPress %s with %s %s.\n", $GLOBALS['cp_version'] ?? $GLOBALS['wp_version'], wp_get_theme()->get( 'Name' ), wp_get_theme()->get( 'Version' ) );
