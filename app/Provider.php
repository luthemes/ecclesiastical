<?php
/**
 * Theme provider ( app/Provider.php )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical;

use Backdrop\Core\ServiceProvider;
use Ecclesiastical\Tools\Config;

class Provider extends ServiceProvider {

	/**
	 * Binds a single instance of the theme mod defaults.
	 *
	 * @return void
	 */
	public function register(): void {

		$this->app->singleton( 'ecclesiastical/mods', function() {
			return Config::get( '_settings-mods' );
		} );
	}
}
