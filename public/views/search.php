<?php
/**
 * Default search template
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
		<div id="layout" class="site-layout site-layout--no-sidebar">
			<main id="main" class="content-area">
                <header class="archive__header">
                    <?php printf( 
                        '<h1 class="archive__title">%1$s %2$s</h1>',
                        esc_html__( 'Search results for: ', 'ecclesiastical' ),
                        '<span class="archive__query">' . get_search_query() . '</span>'
                    ); ?>
                </header>

				<?php if ( have_posts() ) : ?>
					<div class="archive__loop">
						<ul class="archive__grid">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php $engine->display( 'content' ); ?>
							<?php endwhile; ?>
						</ul>
						<?php $engine->display( 'nav/pagination', 'posts' ); ?>
					</div>
				<?php endif; ?>
			</main>
		</div>
	</section>
<?php $engine->display( 'footer' ); ?>