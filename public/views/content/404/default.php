<?php
/**
 * ecclesiastical ( content-404.php )
 *
 * @package   ecclesiastical
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */
?>
<article id="post-0" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Page Not Found', 'ecclesiastical' ); ?></h1>
	</header>
	<div class="entry-content">
		<p>
			<?php
				printf( esc_html__( "Just kidding! It looks like you have stumbled upon a page that doesn't exist, so that means I probably broke something. To find what you are looking for, check out the most recent articles below or try a search: ", 'ecclesiastical' ) );
			?>
		</p>
		<?php get_search_form(); ?>
	</div>
</article>