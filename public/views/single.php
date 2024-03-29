<?php
/**
 * Default single template
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
<?php $engine = Benlumia007\Backdrop\App::resolve( 'view/engine' ); ?>
<?php $engine->display( 'header' ); ?>
	<section id="content" class="site-content">
		<div id="layout" class="<?php echo esc_attr( get_theme_mod( 'global_layout', 'left-sidebar' ) ); ?>">
			<main id="main" class="content-area">
				<?php 
					while ( have_posts() ) : the_post();
						$engine->display( 'content/page'  );
					endwhile;
					comments_template();
				?>
			</main>
			<?php Benlumia007\Backdrop\Theme\Sidebar\display( 'sidebar', [ 'primary' ] ); ?>
		</div>
	</section>
<?php $engine->display( 'footer' ); ?>