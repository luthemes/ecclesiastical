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
use Benlumia007\Backdrop\Tools\ServiceProvider;
use Ecclesiastical\Customize\Layouts\Component;

class Provider extends ServiceProvider {
	/**
	 * Binds the implementation of the attributes contract to the container.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( 'customize/layouts', Component::class );
    }
    
    public function boot() {
        $this->app->resolve( 'customize/layouts' )->boot();
    }
}