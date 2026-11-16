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
	<header class="entry-header">
		<?php Backdrop\Post\display_title( [ 'class' => 'entry-title' ] ); ?>
		<div class="entry-metadata">
			<?php Backdrop\Post\display_author( [ 'text' => '<i class="fa fa-user"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_date( [ 'text' => '<i class="fa fa-calendar-alt"></i> %s' ] ); ?>
			<?php Backdrop\Post\display_comments_link( [ 'text' => '<i class="fa fa-comment"></i> %s' ] ); ?>
		</div>
	</header>
    <?php if ( has_post_thumbnail() ) { ?>
        <picture class="post-thumbnail">
            <?php the_post_thumbnail( Ecclesiastical\Tools\Mod::get( 'theme_content_feature_image' ) ); ?>
        </picture>
    <?php } ?>
	<div class="entry-excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
