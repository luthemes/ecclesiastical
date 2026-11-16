<?php
/**
 * Display functions
 *
 * Template tags for the navigation menus and sidebars.
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical;

/**
 * Outputs a navigation menu by theme location ( primary, secondary or social ).
 *
 * @param  string $location Theme location.
 * @return void
 */
function display_menu( string $location ): void {
	if ( 'primary' === $location ) {
		if ( has_nav_menu( 'primary' ) ) { ?>
			<nav id="primary" class="primary-menu">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'ecclesiastical' ); ?></button>
				<?php
					wp_nav_menu( [
						'theme_location' => 'primary',
						'container'      => '',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu__items',
						'depth'          => 2,
					] );
				?>
			</nav>
		<?php }
	} elseif ( 'secondary' === $location ) { ?>
		<nav id="secondary" class="secondary-menu">
			<?php wp_nav_menu( [ 'theme_location' => 'secondary', 'container' => '', 'menu_class' => 'menu__items', 'depth' => 1 ] ); ?>
		</nav>
	<?php } elseif ( 'social' === $location ) {
		if ( has_nav_menu( 'social' ) ) { ?>
			<nav id="social" class="social-menu">
				<?php
					wp_nav_menu( [
						'theme_location' => 'social',
						'container'      => '',
						'menu_id'        => 'social-menu',
						'menu_class'     => 'menu__items',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'fallback_cb'    => '',
					] );
				?>
			</nav>
		<?php }
	}
}

/**
 * Outputs a sidebar by id ( primary or secondary ).
 *
 * @param  string $sidebar_id Sidebar id.
 * @return void
 */
function display_sidebar( string $sidebar_id ): void { ?>
	<div id="aside" class="site-aside">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</div>
<?php }
