<?php
/**
 * Layout customizer ( app/Customize/Layout/Customize.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Customize\Layout;

use Ecclesiastical\Customize\Customizable;
use Ecclesiastical\Tools\Mod;
use WP_Customize_Manager;

class Customize extends Customizable {

	/**
	 * The layout choices ( value => image ).
	 *
	 * @return array
	 */
	public static function choices(): array {
		return [
			'left-sidebar'  => get_theme_file_uri( '/public/images/2cl.png' ),
			'right-sidebar' => get_theme_file_uri( '/public/images/2cr.png' ),
			'no-sidebar'    => get_theme_file_uri( '/public/images/1col.png' ),
		];
	}

	public function registerSections( WP_Customize_Manager $manager ) {

		$manager->add_section( 'global_layout', [
			'panel'    => 'theme_global',
			'title'    => esc_html__( 'Global Layout', 'ecclesiastical' ),
			'priority' => 5,
		] );
	}

	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'global_layout', [
			'default'           => Mod::fallback( 'global_layout' ),
			'sanitize_callback' => function( $value ) {
				return array_key_exists( $value, static::choices() ) ? $value : Mod::fallback( 'global_layout' );
			},
		] );
	}

	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->add_control( new ImageRadio( $manager, 'global_layout', [
			'description' => esc_html__( 'General Layout applies to all layouts that supports in this theme.', 'ecclesiastical' ),
			'section'     => 'global_layout',
			'settings'    => 'global_layout',
			'type'        => 'radio-image',
			'choices'     => static::choices(),
		] ) );
	}
}
