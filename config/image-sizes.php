<?php
/**
 * Image Sizes Config.
 *
 * Defines the image sizes that the theme sets.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

return [
	'ecclesiastical-small-thumbnails' => [
		'label'  => __( 'Small', 'ecclesiastical' ),
		'width'  => 324,
		'height' => 324,
		'crop'   => true,
	],
	'ecclesiastical-medium-thumbnails' => [
		'label'  => __( 'Medium', 'ecclesiastical' ),
		'width'  => 810,
		'height' => 396,
		'crop'   => true,
	],
	'ecclesiastical-large-thumbnails' => [
		'label'  => __( 'Large', 'ecclesiastical' ),
		'width'  => 1170,
		'height' => 614,
		'crop'   => true,
	],
];
