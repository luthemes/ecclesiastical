<?php
/**
 * Posts pagination.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

Backdrop\Pagination\display( 'posts', [
	'prev_text'  => __( '&larr; Previous', 'ecclesiastical' ),
	'next_text'  => __( 'Next &rarr;', 'ecclesiastical' ),
	'title_text' => __( 'Posts Navigation', 'ecclesiastical' ),
] );
