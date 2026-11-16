<?php
/**
 * Layouts
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
/**
 * Define namespace
 */
namespace Ecclesiastical\Customize\Layouts;
use Ecclesiastical\Customize\Layouts\Control\ImageRadio;
use Backdrop\Contracts\Bootable;
use WP_Customize_Manager;

class Component implements Bootable {
	/**
	 * Boots the component.
	 *
	 * @return void
	 */
	public function boot(): void {
		add_action( 'customize_register', [ $this, 'panels' ] );
		add_action( 'customize_register', [ $this, 'sections' ] );
		add_action( 'customize_register', [ $this, 'settings' ] );
		add_action( 'customize_register', [ $this, 'controls' ] );
	}

	/**
	 * Sanitizes the layout choice against the choices of the control.
	 *
	 * @param  string $input   Layout string.
	 * @param  object $setting Setting being sanitized.
	 * @return string
	 */
	public static function sanitize_layout( $input, $setting ) {
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return array_key_exists( $input, $choices ) ? $input : $setting->default;
	}

    public function panels( WP_Customize_Manager $manager ) {
		$manager->add_panel( 'theme_options', [
            'title' => esc_html( 'Theme Options', 'ecclesiastical' ),
			'priority' => 5,
        ] );
    }

    public function sections( WP_Customize_Manager $manager ) {
        $manager->add_section( 'global_layout', [
            'title'    => esc_html__( 'Global Layout', 'ecclesiastical' ),
			'panel'    => 'theme_options',
			'priority' => 5,
        ] );
    }

    public function settings( WP_Customize_Manager $manager ) {
        $manager->add_setting( 'global_layout', [
            'default'           => 'left-sidebar',
            'sanitize_callback' => [ __CLASS__, 'sanitize_layout' ],
        ] );
    }

    public function controls( WP_Customize_Manager $manager ) {
        $manager->add_control(
			new ImageRadio(
				$manager,
				'global_layout', [
					'description' => esc_html__( 'General Layout applies to all layouts that supports in this theme.', 'ecclesiastical' ),
					'section'     => 'global_layout',
					'settings'    => 'global_layout',
					'type'        => 'radio-image',
					'choices'     => [
                            'left-sidebar'  => get_theme_file_uri( '/public/images/2cl.png' ),
                            'right-sidebar' => get_theme_file_uri( '/public/images/2cr.png' ),
                            'no-sidebar'    => get_theme_file_uri( '/public/images/1col.png' ),
						],
				]
			)
		);
    }
}