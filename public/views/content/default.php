<?php
/**
 * Default default
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
			<?php Backdrop\Post\display_author( [ 'before' => '<span class="entry__metadata-item"><i class="fa fa-user entry__icon" aria-hidden="true"></i>', 'after' => '</span>' ] ); ?>
			<?php Backdrop\Post\display_date( [ 'before' => '<span class="entry__metadata-item"><i class="fa fa-calendar-alt entry__icon" aria-hidden="true"></i>', 'after' => '</span>' ] ); ?>
			<?php Backdrop\Post\display_comments_link( [ 'before' => '<span class="entry__metadata-item"><i class="fa fa-comment entry__icon" aria-hidden="true"></i>', 'after' => '</span>' ] ); ?>
		</div>
	</header>
    <?php if ( has_post_thumbnail() ) { ?>
        <picture class="entry__thumbnail">
            <?php the_post_thumbnail( Ecclesiastical\Tools\Mod::get( 'theme_content_feature_image' ) ); ?>
        </picture>
    <?php } ?>
	<div class="entry__excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
