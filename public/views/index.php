<?php
/**
 * Default index template
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
		<div id="layout" class="site-layout site-layout--<?php echo esc_attr( Ecclesiastical\Tools\Mod::get( 'global_layout' ) ); ?>">
			<main id="main" class="content-area">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							$engine->display( 'content', get_post_format()  );
						endwhile;
						$engine->display( 'nav/pagination', 'posts' );
					else :
							$engine->display( 'content/none' );
					endif;
				?>
			</main>
			<?php Ecclesiastical\display_sidebar( 'primary' ); ?>
		</div>
	</section>
<?php $engine->display( 'footer' ); ?>