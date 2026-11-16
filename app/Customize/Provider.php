<?php
/**
 * Customize provider ( app/Customize/Provider.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Customize;

use Backdrop\Core\ServiceProvider;
use Backdrop\Customize\Component;

class Provider extends ServiceProvider {

	/**
	 * Binds the Backdrop customize component with the theme's customizer parts.
	 *
	 * @return void
	 */
	public function register(): void {

		$this->app->singleton( Component::class, function() {

			return new Component( [
				Layout\Customize::class,
				FeatureImage\Customize::class,
				Footer\Customize::class,
			] );
		} );
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
