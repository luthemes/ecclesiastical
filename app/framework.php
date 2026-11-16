<?php
/**
 * Boot the framework
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

/**
 * Create a new application instance
 *
 * Backdrop 1.x registers its own providers (attributes, languages, templates, template hierarchy and views) when the
 * application is created. If an application has already been created, we reuse it.
 */
$ecclesiastical = \Backdrop\booted() ? \Backdrop\app() : new \Backdrop\Core\Application();

/**
 * Register Service Provider with the Framework
 */
$ecclesiastical->provider( Ecclesiastical\Provider::class );
$ecclesiastical->provider( Ecclesiastical\CleanCP\Provider::class );
$ecclesiastical->provider( Ecclesiastical\Customize\Provider::class );
$ecclesiastical->provider( Ecclesiastical\Menu\Provider::class );
$ecclesiastical->provider( Ecclesiastical\Settings\Provider::class );
$ecclesiastical->provider( Ecclesiastical\Sidebar\Provider::class );

/**
 * Allow child themes and plugins to add their own providers.
 */
do_action( 'ecclesiastical/bootstrap', $ecclesiastical );

/**
 * Boot the Framework
 */
$ecclesiastical->boot();
