<?php
/**
 * Scripts
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

use function Ecclesiastical\Vite\asset;

/**
 * Enqueue Scripts and Styles
 *
 * @since  1.0.0
 * @access public
 * @return void
 *
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
add_action( 'wp_enqueue_scripts', function() {
	/**
	 * Fonts and icons. These were previously loaded by the Backdrop Google Fonts and Font Awesome packages.
	 */
	wp_enqueue_style( 'ecclesiastical-fonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;500;700&family=Merriweather:wght@400;700&display=swap', array(), null );
	wp_enqueue_style( 'ecclesiastical-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );

	/**
	 * Rather than enqueue the main stylesheet, we are going to enqueue sceen.css since all of the styles will
	 * go here. We only need parse the information for the Theme in style.css so that it can be activated.
	 */
	wp_enqueue_style( 'ecclesiastical-screen', asset( 'resources/scss/screen.scss' ), array(), null );

	/**
	 * This allows users to comment by clicking on reply so that it gets nested.
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

add_action( 'wp_enqueue_scripts', function() {
	$text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $text_color ) {
		return;
	}
	$value      = display_header_text() ? sprintf( 'color: #%s', esc_html( $text_color ) ) : 'display: none;';
	$custom_css = "
		.site-branding .site-title a,
		.site-description {
			{$value}
		}
	";
	wp_add_inline_style( 'ecclesiastical-screen', $custom_css );
} );

/**
 * Hide customizer controls whose active callback is false.
 *
 * The customizer applies a control's starting active state before the control is in the page, so a control that is
 * inactive when the customizer loads stays visible until its state changes. Mark inactive controls with a class and
 * keep it in step with the active state.
 */
add_action( 'customize_controls_enqueue_scripts', function() {
	wp_add_inline_style( 'customize-controls', 'li.customize-control.ecclesiastical-control-inactive { display: none !important; }' );

	wp_add_inline_script( 'customize-controls', "wp.customize.bind( 'ready', function() {
		var watch = function( control ) {
			var sync = function( active ) {
				control.container.toggleClass( 'ecclesiastical-control-inactive', ! active );
			};
			sync( control.active() );
			control.active.bind( sync );
		};
		wp.customize.control.each( watch );
		wp.customize.control.bind( 'add', watch );
	} );" );
} );
