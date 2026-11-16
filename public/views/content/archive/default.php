<?php
/**
 * ecclesiastical ( content.php )
 *
 * @package   ecclesiastical
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://benjlu.com )
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
			<?php printf( '<span class="entry__sticky">%1$s</span>', esc_html__( 'Featured', 'ecclesiastical' ) ); ?>
		<?php } ?>
		<?php Backdrop\Post\display_title( [
			'class' => 'entry__title text-medium'
		] ); ?>
		<div class="entry__metadata">
			<?php Backdrop\Post\display_author( [ 'text' => '<i class="fa fa-user"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_date( [ 'text' => '<i class="fa fa-calendar-alt"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_comments_link( [ 'text' => '<i class="fa fa-comment"></i> %s' ] ); ?>
		</div>
	</header>
	<div class="entry__excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
