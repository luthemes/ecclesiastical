<?php

namespace Ecclesiastical\Customize\Footer;
use Ecclesiastical\Customize\Customizable;
use WP_Customize_Manager;
use Backdrop\Tools\Collection;
use Ecclesiastical\Tools\Mod;
use Ecclesiastical\Template\Footer;

class Customize extends Customizable {

	/**
	 * Registers customizer sections.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		$manager->add_section( 'theme_footer_credit', [
			'panel' => 'theme_footer',
			'title' => esc_html__( 'Credit', 'ecclesiastical' ),
		] );
	}

	/**
	 * Registers customizer settings.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		// Register footer settings.
		$manager->add_setting( 'theme_footer_powered_by', [
			'default'           => Mod::fallback( 'theme_footer_powered_by' ),
			'sanitize_callback' => 'wp_validate_boolean',
		] );

		$manager->add_setting( 'theme_footer_custom_credit', [
			// Translators: %s is the theme link.
			'default'           => Mod::fallback( 'theme_footer_custom_credit' ),
			'sanitize_callback' => function( $value ) {
				return wp_kses( $value, Footer::allowedTags() );
			}
		] );
	}

	/**
	 * Registers customizer controls.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		// Powered by control.
		$manager->add_control( 'theme_footer_powered_by', [
			'section'  => 'theme_footer_credit',
			'type'     => 'checkbox',
			'label'    => __( 'Show random "powered by" credit text.', 'ecclesiastical' )
		] );

    		// Footer credit control.
		$manager->add_control( 'theme_footer_custom_credit', [
			'section'         => 'theme_footer_credit',
			'type'            => 'textarea',
			'label'           => __( 'Custom Footer Text', 'ecclesiastical' ),
			'active_callback' => function( $control ) {
				return ! $control->manager->get_setting( 'theme_footer_powered_by' )->value();
			}
		] );
	}

	/**
	 * Registers customizer partials.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerPartials( WP_Customize_Manager $manager ) {

	}

	/**
	* Registers JSON for the customize controls script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function controlsJson( Collection $json ) {

	}

	/**
	* Registers JSON for the customize preview script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function previewJson( Collection $json ) {

	}
}
