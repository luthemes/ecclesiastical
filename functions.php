<?php
/**
 * Theme functions file.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

/**
 * Table of Content
 *
 * 1.0 - Compatibility Check
 * 2.0 - Backdrop Framework
 */

/**
 * 1.0 - Compatibility Check
 */
if ( version_compare( $GLOBALS['wp_version'], '4.9', '<' ) || version_compare( PHP_VERSION, '7.4', '<' ) ) {
	require_once( get_parent_theme_file_path( 'app/functions-compat.php' ) );
	return;
}

/**
 * Global Functions
 */
require_once( get_parent_theme_file_path( 'app/functions-global.php' ) );

/**
 * 2.0 - Backdrop Framework
 */
if ( file_exists( get_parent_theme_file_path( '/vendor/autoload.php' ) ) ) {
	require_once get_parent_theme_file_path( '/vendor/autoload.php' );
}
