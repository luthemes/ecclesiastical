<?php
/**
 * ecclesiastical ( content-none.php )
 *
 * @package   ecclesiastical
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

?>
<article id="post-0" <?php post_class( 'post' ); ?>>
	<header class="entry__header">
		<h1 class="entry__title">
			<?php esc_html_e( 'Nothing Found', 'ecclesiastical' ); ?>
		</h1>
	</header>
	<div class="entry__content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
					// Translators: 1 = admin url.
					printf( esc_html__( 'Ready to publish your first post? %s', 'ecclesiastical' ), '<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">' . esc_html__( 'Get Started', 'ecclesiastical' ) . '</a>' );
				?>
			</p>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'ecclesiastical' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</article>
