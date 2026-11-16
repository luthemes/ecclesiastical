<?php
/**
 * Default single ( partial )
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php Backdrop\Post\display_title( [ 'class' => 'entry__title' ] ); ?>
		<div class="entry__metadata">
			<?php Backdrop\Post\display_author( [ 'text' => '<i class="fa fa-user"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_date( [ 'text' => '<i class="fa fa-calendar-alt"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_comments_link( [ 'text' => '<i class="fa fa-comment"></i> %s' ] ); ?>
		</div>
	</header>
	<div class="entry__content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( [
				'before'      => '<div class="entry__page-links">' . esc_html__( 'Pages:', 'ecclesiastical' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ecclesiastical' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">,</span> ',
			] );
			?>
	</div>
	<div class="entry__taxonomies">
		<?php Backdrop\Post\display_terms( [ 'taxonomy' => 'category', 'class' => 'entry__categories' ] ); ?>
		<?php Backdrop\Post\display_terms( [ 'taxonomy' => 'post_tag', 'class' => 'entry__tags' ] ); ?>
	</div>
</article>
