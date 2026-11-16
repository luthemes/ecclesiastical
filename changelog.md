# Change Log

## 1.0.3 - TBD
- Switch to ClassicPress: add Requires CP header, require PHP 7.4, and link to ClassicPress in the footer
- Switch to Backdrop framework 1.x (backdrop-dev/framework)
- Menus, sidebars and the layout customizer are now theme components
- Add Appearance > Ecclesiastical Settings page (General, Themes and Plugins) with options to disable emoji, the toolbar and embeds, and to choose a private page for the 404 error
- Add customizer options for the feature image size and the footer credit text
- Image sizes and theme mod defaults moved to `config/`
- Build assets with Vite instead of Laravel Mix; assets are loaded through the Vite manifest
- Don't add `html5` theme support on ClassicPress 2.0 and higher, which deprecates it
- Fix a warning in the Plugins tab when the plugin API request fails
- Add tests that run the Theme Unit Test data against a ClassicPress site
- Fix the menu toggle screen reader text, which used keys that were never set
- Load Merriweather, Fira Sans and Font Awesome from the theme

## 1.0.2 - October 28, 2021
- Fixed Sidebar display in 404.php
- Add search.php for results

## 1.0.1 - October 27, 2021
- Add Secondary Navigation
- Add Social Navigation

## 1.0.0 - October 27, 2021
- Initial Release