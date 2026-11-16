<?php
/**
 * Theme Compatibility
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

/**
 * Add actions to fail at certain point in the load process.
 */
add_action( 'after_switch_theme', 'ecclesiastical_switch_theme'   );

/**
 * Returns the compatibility messaged based on whether the WP or PHP minimum
 * requirement wasn't met.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function ecclesiastical_compat_message() {

	if ( version_compare( $GLOBALS['wp_version'], '4.9', '<' ) ) {

		return sprintf(
			// Translators: 1 is the required WordPress version and 2 is the user's current version.
			__( 'ecclesiastical requires at least ClassicPress or WordPress version %1$s. You are running version %2$s. Please upgrade and try again.', 'ecclesiastical' ),
			'4.9',
			$GLOBALS['wp_version']
		);

	} elseif ( version_compare( PHP_VERSION, '7.4', '<' ) ) {

		return sprintf(
			// Translators: 1 is the required PHP version and 2 is the user's current version.
			__( 'ecclesiastical requires at least PHP version %1$s. You are running version %2$s. Please upgrade and try again.', 'ecclesiastical' ),
			'7.4',
			PHP_VERSION
		);
	}

	return '';
}

/**
 * Switches to the previously active theme after the theme has been activated.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $old_name  Previous theme name/slug.
 * @return void
 */
function ecclesiastical_switch_theme( $old_name ) {

	switch_theme( $old_name ? $old_name : WP_DEFAULT_THEME );

	unset( $_GET['activated'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Only removes a core flag.

	add_action( 'admin_notices', 'ecclesiastical_upgrade_notice' );
}

/**
 * Outputs an admin notice with the compatibility issue.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ecclesiastical_upgrade_notice() {

	printf( '<div class="error"><p>%s</p></div>', esc_html( ecclesiastical_compat_message() ) );
}