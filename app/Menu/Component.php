<?php
/**
 * Menus ( app/Menu/Component.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Menu;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	/**
	 * Menus that the theme registers ( location => label ).
	 *
	 * @return array
	 */
	public function menus(): array {
		return [
			'primary'   => esc_html__( 'Primary Sidebar', 'ecclesiastical' ),
			'secondary' => esc_html__( 'Secondary Sidebar', 'ecclesiastical' ),
			'social'    => esc_html__( 'Social Navigation', 'ecclesiastical' ),
		];
	}

	/**
	 * Registers the nav menus.
	 *
	 * @return void
	 */
	public function register(): void {
		register_nav_menus( apply_filters( 'ecclesiastical/register/menus', $this->menus() ) );
	}

	/**
	 * Enqueues the navigation script.
	 *
	 * @return void
	 */
	public function enqueue(): void {
		wp_enqueue_script( 'ecclesiastical-navigation', get_theme_file_uri( 'public/assets/js/app.js' ), [ 'jquery' ], '1.0.0', true );
		wp_localize_script( 'ecclesiastical-navigation', 'ecclesiasticalScreenReaderText', [
			'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'ecclesiastical' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'ecclesiastical' ) . '</span>',
		] );
	}

	/**
	 * Boots the component.
	 *
	 * @return void
	 */
	public function boot(): void {
		add_action( 'after_setup_theme', [ $this, 'register' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}
}
