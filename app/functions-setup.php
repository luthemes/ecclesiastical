<?php
/**
 * Theme Setup
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
namespace Ecclesiastical;

/**
 * Setup Theme Support.
 *
 * This is where all of the add_theme_support(); will happen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link   https://developer.wordpress.org/themes/basics/theme-functions/
 * @link   https://developer.wordpress.org/reference/functions/load_theme_textdomain/
 */
add_action( 'after_setup_theme', function() {
		/**
		 * Content width is a theme feature, when set, it can set the maximum allow width for any content in teh theme like
		 * oEmbeds and images added to posts.
		 */
		$GLOBALS['content_width'] = 800;

		/**
		 * By adding add_theme_support( 'title-tag' );, this will let WordPress manage all document titles and should be use instead of wp_title();.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * By adding add_theme_support( 'automatic-feed-links' );, this feature when enabled allows feed links for post and comments
		 * in the head of the theme. This feature should be used in place of of the deprecated function automatic_feed_links();.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * By adding add_theme_support( 'html5', array() );, this feature when enabled allows the user use of HTML5 markup for
		 * comment list, comment forms, search forms, galleries, and captions. ClassicPress 2.0 and higher uses HTML5 by default
		 * and deprecates this argument, so it is only added on other platforms.
		 */
		if ( ! \Backdrop\is_classicpress() ) {
			add_theme_support( 'html5', array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
			) );
		}

		/**
		 * By adding add_theme_support( 'post-thumbnails' );, this feature when enabled allows you to setup featured images
		 * also known as featured image. If you need to use conditional, please consider using has_post_thumbnail.
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'post-formats', array(
			'aside',
		) );

		/**
		 * Image sizes are defined in `config/image-sizes.php`. The small size is used for content in the home for blogs, the
		 * medium size for content that has sidebars and the large size for content that has no sidebars.
		 */
		foreach ( Tools\Config::get( 'image-sizes' ) as $name => $size ) {
			add_image_size( $name, $size['width'], $size['height'], ! empty( $size['crop'] ) );
		}

		/**
		 * Load theme translation.
		 */
		load_theme_textdomain( 'ecclesiastical', get_parent_theme_file_path( '/languages ' ) );
	}
);

/**
 * Add support for custom header.
 */
add_action( 'after_setup_theme', function() {
	add_theme_support( 'custom-header',
		[
			'default-text-color' => 'ffffff',
			'default-image'      => get_parent_theme_file_uri( '/public/images/header-image.jpg' ),
			'height'             => 1200,
			'max-width'          => 2000,
			'width'              => 2000,
			'flex-height'        => false,
			'flex-width'         => false,
		]
	);

	register_default_headers(
		array(
			'header-image' => array(
				'url'           => '%s/public/images/header-image.jpg',
				'thumbnail_url' => '%s/public/images/header-image.jpg',
				'description'   => esc_html__( 'Header Image', 'ecclesiastical' ),
			),
		)
	);
} );

add_action( 'backdrop/templates/register', function( $templates ) {
	$templates->add(
		'template-custom-sidebar.php', [
			'label' => esc_html__( 'Custom Sidebar', 'ecclesiastical' ),
			'post_types' => [ 'page' ]
		]
	);

	$templates->add(
		'template-left-sidebar.php', [
			'label' => esc_html__( 'Left Sidebar', 'ecclesiastical' ),
			'post_types' => [ 'page' ]
		]
	);

	$templates->add(
		'template-right-sidebar.php', [
			'label' => esc_html__( 'Right Sidebar', 'ecclesiastical' ),
			'post_types' => [ 'page' ]
		]
	);
} );