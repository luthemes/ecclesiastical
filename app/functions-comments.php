<?php
/**
 * Comments
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */

namespace Ecclesiastical;

/**
 * Callback for wp_list_comments(), outputs a single comment.
 *
 * @param  \WP_Comment $comment Comment.
 * @param  array       $args    Arguments passed to wp_list_comments().
 * @param  int         $depth   Depth of the comment.
 * @return void
 */
function display_comment( $comment, $args, $depth ) { ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment__body">
			<header class="comment__meta">
				<?php if ( 0 !== $args['avatar_size'] ) : ?>
					<?php echo get_avatar( $comment, $args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ); ?>
				<?php endif; ?>
				<div class="comment__details">
					<cite class="comment__author fn"><?php echo get_comment_author_link(); ?></cite>
					<div class="comment__metadata">
						<a class="comment__date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( esc_html__( '%1$s at %2$s', 'ecclesiastical' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
							?>
						</a>
						<span class="comment__reply">
							<?php
								comment_reply_link( array_merge( $args, [
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								] ) );
							?>
						</span>
					</div>
					<?php if ( '0' === $comment->comment_approved ) : ?>
						<em class="comment__moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ecclesiastical' ); ?></em>
					<?php endif; ?>
				</div>
			</header>
			<div class="comment__content">
				<?php comment_text(); ?>
			</div>
		</div>
<?php }
