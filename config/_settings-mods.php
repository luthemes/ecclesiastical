<?php
/**
 * Theme mods settings Config.
 *
 * Defines the default theme mods for the theme. Child themes can overwrite this
 * with a `config/_settings-mods.php` file or the `ecclesiastical/config/_settings-mods/`
 * filter.
 *
 * If a default value requires PHP code to execute, use a closure. It will be
 * invoked at an appropriate time when all functions are available for use.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

return [

	// Default global layout ( left-sidebar, right-sidebar or no-sidebar ).
	'global_layout' => 'left-sidebar',

	// Whether to show a random powered by quote by default. If set to `false`,
	// the `theme_footer_custom_credit` value will be used.
	'theme_footer_powered_by' => false,

	// Default footer credit text.
	'theme_footer_custom_credit' => function() {
		// Translators: 1 is the current year, 2 is a link to the site.
		$copyright = sprintf( __( 'Copyright &#169; %1$s. %2$s', 'ecclesiastical' ), gmdate( 'Y' ), Backdrop\Site\render_site_link() );

		$platform = Backdrop\is_classicpress() ? Backdrop\Site\render_cp_link() : Backdrop\Site\render_wp_link();

		// Translators: 1 is a link to ClassicPress or WordPress, 2 is a link to the theme.
		$powered = sprintf( __( 'Powered By %1$s and %2$s', 'ecclesiastical' ), $platform, Backdrop\Site\render_theme_link() );

		return $copyright . ' <br /> ' . $powered;
	},

	// Default feature image size.
	'theme_content_feature_image' => 'ecclesiastical-medium-thumbnails',
];
