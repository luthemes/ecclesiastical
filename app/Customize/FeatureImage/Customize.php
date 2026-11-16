<?php

namespace Ecclesiastical\Customize\FeatureImage;
use Ecclesiastical\Customize\Customizable;
use WP_Customize_Manager;
use Backdrop\Tools\Collection;
use Ecclesiastical\Tools\Config;
use Ecclesiastical\Tools\Mod;

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

		$manager->add_section( 'theme_content_feature_image', [
			'panel' => 'theme_content',
			'title' => esc_html__( 'Feature Image', 'ecclesiastical' ),
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

        // Add a setting for the feature image size.
		$manager->add_setting( 'theme_content_feature_image', [
			'default'           => Mod::fallback( 'theme_content_feature_image' ),
			'sanitize_callback' => function( $value ) {
				return array_key_exists( $value, Config::get( 'image-sizes' ) ) ? $value : Mod::fallback( 'theme_content_feature_image' );
			},
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

           // Prepare choices array.
    $choices = Config::get( 'image-sizes' );
    foreach ( $choices as $size_name => $size_attrs ) {
        $choices[ $size_name ] = $size_attrs['label'];
    }

            // Add a control for the feature image size.
    $manager->add_control( 'theme_content_feature_image', array(
        'label'    => __( 'Feature Image Size', 'ecclesiastical' ),
        'section'  => 'theme_content_feature_image',
        'settings' => 'theme_content_feature_image',
        'type'     => 'select',
        'choices'  => $choices,
    ) );
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
