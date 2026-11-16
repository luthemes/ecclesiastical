<?php
/**
 * Default archive template
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
<?php $engine = Backdrop\App::resolve( 'view/engine' ); ?>
<?php $engine->display( 'header' ); ?>
	<section id="content" class="site-content">
		<div id="global-layout" class="no-sidebar">
			<main id="main" class="content-area">
				<?php if ( ! is_front_page() ) { ?>
					<header class="archive-header">
						<?php the_archive_title( '<h1 class="archive-title">', '</h1>'); ?>
						<?php the_archive_description( '<p class="archive-description">', '</p>'); ?>
					</header>
				<?php } ?>

				<?php if ( have_posts() ) : ?>
					<div class="loop">
						<ul class="grid has-3-columns">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php $engine->display( 'content/archive' ); ?>
							<?php endwhile; ?>
						</ul>
						<?php the_posts_pagination(); ?>
					</div>
				<?php endif; ?>
			</main>
		</div>
	</section>
<?php $engine->display( 'footer' ); ?>