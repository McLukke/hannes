<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

	<div id="comment-container-<?php comment_ID(); ?>" class="comment-container">
		<?php switch ( $comment->comment_type ) :

		// ===============================================

			case 'pingback' : case 'trackback' : ?>
				<p><?php _e( 'Pingback:', 'pixie' ); ?> <?php comment_author_link(); ?></p>
			<?php break;

		// ===============================================

			default :

				global $post; ?>
				<div class="comment-avatar"><?php echo wp_kses_post( get_avatar( $comment, '60' ) ); ?></div>

				<header class="comment-header container">

					<div class="comment-name typography-heading">
						<?php comment_author_link(); ?>
						<?php if ( $comment->user_id === $post->post_author ) : ?>
							<span class="comment-is-author"><?php _e( '(Author)', 'pixie' ); ?></span>
						<?php endif; ?>
					</div>

					<div class="comment-meta typography-meta">
						<?php printf( __( '%s at %s', 'pixie' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?>

						<?php comment_reply_link( array_merge( $args, array(
							'add_below'  => 'comment-container',
							'reply_text' => ' &mdash; ' . __( 'Reply', 'pixie' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'before'     => '',
							'after'      => '',
						) ) ); ?>
					</div>

				</header>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pixie' ); ?></p>
				<?php endif; ?>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

			<?php break;

		endswitch; ?>
	</div>