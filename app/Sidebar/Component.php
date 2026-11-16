<?php
/**
 * Sidebars ( app/Sidebar/Component.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Sidebar;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	/**
	 * Sidebars that the theme registers ( id => name and description ).
	 *
	 * @return array
	 */
	public function sidebars(): array {
		return [
			'primary'   => [
				'name' => esc_html__( 'Primary Sidebar', 'ecclesiastical' ),
				'desc' => esc_html__( 'test', 'ecclesiastical' ),
			],
			'secondary' => [
				'name' => esc_html__( 'Secondary Sidebar', 'ecclesiastical' ),
				'desc' => esc_html__( 'test', 'ecclesiastical' ),
			],
		];
	}

	/**
	 * Registers the sidebars.
	 *
	 * @return void
	 */
	public function register(): void {
		foreach ( $this->sidebars() as $id => $sidebar ) {
			register_sidebar( apply_filters( 'ecclesiastical/register/sidebar', [
				'name'          => $sidebar['name'],
				'id'            => $id,
				'description'   => $sidebar['desc'],
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			] ) );
		}
	}

	/**
	 * Boots the component.
	 *
	 * @return void
	 */
	public function boot(): void {
		add_action( 'widgets_init', [ $this, 'register' ] );
	}
}
