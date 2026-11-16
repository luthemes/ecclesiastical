# Ecclesiastical
Ecclesiastical is a starter theme for ClassicPress

The main objective of this starter theme is to help myself and other developer to create a theme without the need to code. The starter theme also uses the Backdrop framework (backdrop-dev/framework 1.x) to do its work for this starter theme.

## Requirements
There are few things that we will need to begin.

- ClassicPress 2.0 or higher
- PHP 7.4 or higher
- Git
- Composer
- Node.js 20.19 or higher (to build the assets)

Install the dependencies with `composer install` in the theme folder before activating the theme.


## Development
The styles and scripts are built with [Vite](https://vite.dev).

- `npm install` installs the build tools
- `npm run watch` rebuilds the assets while you work
- `npm run prod` builds the assets into `public/assets`
- `npm run build` builds the assets and exports the theme into the `ecclesiastical` folder

## Testing
The theme can be tested against WordPress's [Theme Unit Test](https://github.com/WordPress/theme-test-data) data on a throwaway ClassicPress site that uses SQLite. Run `composer install` in the theme first, then:

```bash
WP_PLATFORM=classicpress tests/setup.sh /tmp/cp-site
tests/import-test-data.sh /tmp/cp-site
tests/crawl.sh /tmp/cp-site
php tests/admin-check.php /tmp/cp-site
```

`crawl.sh` requests every post, page and archive from the test data, checks each one renders with the theme's header and footer, and checks that `debug.log` has no PHP errors, warnings or notices. `admin-check.php` checks the customizer settings and the settings page. The block test data is not imported because ClassicPress has no block editor.

## Documentations
Coming Soon.

## Copyright and License
Ecclesiastical is licensed under the GNU GPL, v2 or later

© 2018-2021. Benjamin Lu