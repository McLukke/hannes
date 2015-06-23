<?php if ( comments_open() && get_option( 'thread_comments' ) ) : wp_enqueue_script( 'comment-reply' ); ?>

	<div class="comments">

		<div class="center-wrapper">

			<?php if ( have_comments() ) : ?>
				<div class="comments-index">

					<header>
						<h3 class="comments-heading typography-big-heading">
							<?php comments_number(
								__( 'No Comments', 'pixie' ),
								__( '1 Comment', 'pixie' ),
								__( '% Comments', 'pixie' )
							); ?>
						</h3>
					</header>

					<ul class="comments-list">
						<?php wp_list_comments( array( 'callback' => 'pixie_wp_list_comments_callback' ) ); ?>
					</ul>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<nav class="comments-pagination pagination container typography-meta">
						<span class="left"><?php next_comments_link( __( '&laquo; Newer Comments', 'pixie' ) ); ?></span>
						<span class="right"><?php previous_comments_link( __( 'Older Comments &raquo;', 'pixie' ) ); ?></span>
					</nav>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<?php if ( comments_open() ) : ?>

				<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? ' aria-required="true"' : '' );

				$fields['author'] = '
					<p class="form-group">
						<input id="respond-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Name', 'pixie' ) . '" size="40" />
					</p>
				';

				$fields['email'] = '
					<p class="form-group">
						<input id="respond-email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Email', 'pixie' ) . '" size="40" />
					</p>
				';

				$fields['url'] = '
					<p class="form-group">
						<input id="respond-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website', 'pixie' ) . '" size="40" />
					</p>
				';

				$comment = '
					<p class="form-group">
						<textarea id="respond-comment" name="comment" rows="4" aria-required="true" placeholder="' . __( 'Comment', 'pixie' ) . '"></textarea>
					</p>
				';

				$must_log_in = '
					<p class="respond-must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>
				';

				$logged_in_as = '
					<p class="respond-logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>
				';

				$comment_notes_before = '';
				$comment_notes_after = '';

				comment_form( array(
					'fields'               => $fields,
					'comment_field'        => $comment,
					'must_log_in'          => $must_log_in,
					'logged_in_as'         => $logged_in_as,
					'comment_notes_before' => $comment_notes_before,
					'comment_notes_after'  => $comment_notes_after,
					'id_form'              => 'respond-form',
					'id_submit'            => 'respond-submit',
					'title_reply'          => __( 'Leave a Reply', 'pixie' ),
					'title_reply_to'       => __( 'Leave a Reply to %s', 'pixie' ),
					'cancel_reply_link'    => __( '/ Cancel Reply', 'pixie' ),
					'label_submit'         => __( 'Post Comment', 'pixie' ),
				) ); ?>

			<?php endif; ?>

		</div>

	</div>

<?php endif; ?>