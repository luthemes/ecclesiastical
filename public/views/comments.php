<?php
/**
 * Default comments template
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
<?php $engine = Backdrop\App::resolve( 'view/engine' ); ?>
<?php if ( post_password_required() ) { return; } ?>

<?php if ( comments_open() ) { ?>
	<header class="comments-header">
		<h1 class="comments-title">
			<?php $count = get_comments_number(); ?>
			<?php
			if ( '1' === $count ) {
				printf( esc_html_x( 'One Comment', 'comments title', 'ecclesiastical' ) );
			} else {
				// Translators: 1 = counts.
				printf( _nx( '%1$s Comment', '%1$s Comments', absint( $count ), 'comments title', 'ecclesiastical' ), absint( number_format_i18n( $count ) ) ); // phpcs:ignore
			}
			?>
		</h1>
	</header>
	<section id="comments-area" class="comments-area">
		<?php if ( have_comments() ) { ?>
		<?php } ?>
		<ul class="comment-list">
			<?php
				wp_list_comments( [
					'style'       => 'ul',
					'avatar_size' => 50,
					'callback' => 'Ecclesiastical\display_comment'
				] );
			?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<div class="comment-previous"><?php previous_comments_link( '<i class="fa fa-arrow-circle-o-left"></i> ' . esc_html__( 'Older Comments', 'ecclesiastical' ) ); ?></div>
				<div class="comment-next"><?php next_comments_link( '<i class="fa fa-arrow-circle-o-right"></i> ' . esc_html__( 'Newer Comments', 'ecclesiastical' ) ); ?></div>
			</nav>
		<?php } ?>
		<?php comment_form(); ?>
	</section>
<?php } ?>
