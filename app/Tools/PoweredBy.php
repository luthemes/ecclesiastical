<?php
/**
 * Powered By Text Class.
 *
 * A simple class for randomly displaying a "powered by..." line of text in the
 * theme footer.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2024 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical\Tools;

/**
 * Powered by class.
 *
 * @since  1.0.0
 * @access public
 */
class PoweredBy {

	/**
	 * Returns an array of all the powered by quotes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function all() {

		return apply_filters( 'ecclesiastical/poweredby/collection', [
			esc_html__( 'Powered by heart and soul.', 'ecclesiastical' ),
			esc_html__( 'Powered by crazy ideas and passion.', 'ecclesiastical' ),
			esc_html__( 'Powered by the thing that holds all things together in the universe.', 'ecclesiastical' ),
			esc_html__( 'Powered by love.', 'ecclesiastical' ),
			esc_html__( 'Powered by the vast and endless void.', 'ecclesiastical' ),
			esc_html__( 'Powered by the code of a maniac.', 'ecclesiastical' ),
			esc_html__( 'Powered by peace and understanding.', 'ecclesiastical' ),
			esc_html__( 'Powered by coffee.', 'ecclesiastical' ),
			esc_html__( 'Powered by sleepness nights.', 'ecclesiastical' ),
			esc_html__( 'Powered by the love of all things.', 'ecclesiastical' ),
			esc_html__( 'Powered by something greater than myself.', 'ecclesiastical' ),
			esc_html__( 'Powered by whispers from the future.', 'ecclesiastical' ),
			esc_html__( 'Powered by the fusion of technology and dreams.', 'ecclesiastical' ),
			esc_html__( 'Powered by the strength found in kindness.', 'ecclesiastical' ),
			esc_html__( 'Powered by the melodies of the unseen world.', 'ecclesiastical' ),
			esc_html__( 'Powered by the courage of the unheard voices.', 'ecclesiastical' ),
			esc_html__( 'Powered by the beauty of the human spirit.', 'ecclesiastical' ),
			esc_html__( 'Powered by the quest for eternal wisdom.', 'ecclesiastical' ),
			esc_html__( 'Powered by the energy of uncharted galaxies.', 'ecclesiastical' ),
			esc_html__( 'Powered by the magic hidden in plain sight.', 'ecclesiastical' ),
			esc_html__( 'Powered by the legacy of the ancients.', 'ecclesiastical' ),
			esc_html__( 'Powered by the dance between light and darkness.', 'ecclesiastical' ),
			esc_html__( 'Powered by the touch of the morning sun.', 'ecclesiastical' ),
			esc_html__( 'Powered by the secrets of the deep ocean.', 'ecclesiastical' ),
			esc_html__( 'Powered by the echoes of laughter and joy.', 'ecclesiastical' ),
			esc_html__( 'Powered by the relentless pursuit of truth.', 'ecclesiastical' ),
		] );
	}

	/**
	 * Displays a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function display() {

		echo esc_html( static::render() );
	}

	/**
	 * Returns a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public static function render() {

		$collection = static::all();

		return $collection[ array_rand( $collection, 1 ) ];
	}
}