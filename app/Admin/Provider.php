<?php
/**
 * Service provider ( app/Admin/Provider.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Admin;

use Backdrop\Core\ServiceProvider;

class Provider extends ServiceProvider {

	/**
	 * Binds a single instance of the component to the container.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->app->singleton( Component::class );
	}

	/**
	 * Boots the component.
	 *
	 * @return void
	 */
	public function boot(): void {
		$this->app->resolve( Component::class )->boot();
	}
}
