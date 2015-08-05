<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<?php if ( is_sticky() ) :

		$sticky_text = get_theme_mod( 'blog_sticky_text', __( 'Sticky Post', 'pixie' ) ); ?>
		<span class="sticky-badge" title="<?php echo esc_attr( $sticky_text ); ?>"></span>
	<?php endif; ?>

	<div class="center-wrapper">

		<header class="entry-header">

			<div class="entry-meta typography-meta">

				<?php printf( '%s / %s', wp_kses_post( get_the_category_list( ', ' ) ), esc_html(date_i18n('F j, Y', strtotime(get_the_date()) )) ); ?>
				
				<?php // Edit Link
				edit_post_link( '<span class="fa fa-pencil"></span> ' . __( '', 'pixie' ), '<span class="edit-link right">', '</span>' ); ?>

			</div>

			<?php if ( is_single() ) : ?>
				<h1 class="entry-title typography-title">
					<?php the_title(); ?>
				</h1>
			<?php else : ?>
				<h2 class="entry-title typography-title">
					<?php echo the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
				</h2>
			<?php endif; ?>

		</header>

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="entry-featured-side-background">

				<div class="side-background-anchor" data-target="#side-background-featured-<?php the_ID(); ?>"></div>

				<div id="side-background-featured-<?php the_ID(); ?>" class="side-background wait-loaded">

					<?php switch ( get_post_format() ) :
						case 'gallery':
							
							$images = get_post_meta( get_the_ID(), '_format_gallery_images', true );
							if ( ! empty( $images ) ) : ?>
								<div class="side-background-overlay">
									<div class="side-background-overlay-inner">
										<div class="entry-gallery">
											<ul class="rslides">
												<?php foreach ( $images as $image ) : ?>
													<li><?php echo wp_kses_post( wp_get_attachment_image( $image, 'full' ) ); ?></li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								</div>
							<?php endif;

							break;
						
						case 'audio':

							$audio = get_post_meta( get_the_ID(), '_format_audio_embed', true );
							if ( ! empty( $audio ) ) : ?>
								<div class="side-background-overlay">
									<div class="side-background-overlay-inner">
										<div class="entry-audio-embed">
											<div class="entry-audio-embed-inner">
												<?php echo wp_kses( $audio, array(
													'iframe' => array(
														'align' => array(),
														'frameborder' => array(),
														'height' => array(),
														'longdesc' => array(),
														'marginheight' => array(),
														'marginwidth' => array(),
														'name' => array(),
														'sandbox' => array(),
														'scrolling' => array(),
														'seamless' => array(),
														'src' => array(),
														'srcdoc' => array(),
														'width' => array(),
														'id' => array(),
														'class' => array(),
														'style' => array(),
													),
												) ); ?>
											</div>
										</div>
									</div>
								</div>
							<?php endif;

							break;
						
						case 'video':

							$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
							if ( ! empty( $video ) ) : ?>
								<div class="side-background-overlay">
									<div class="side-background-overlay-inner">
										<div class="entry-video-embed">
											<div class="entry-video-embed-inner">
												<?php echo wp_kses( $video, array(
													'iframe' => array(
														'align' => array(),
														'frameborder' => array(),
														'height' => array(),
														'longdesc' => array(),
														'marginheight' => array(),
														'marginwidth' => array(),
														'name' => array(),
														'sandbox' => array(),
														'scrolling' => array(),
														'seamless' => array(),
														'src' => array(),
														'srcdoc' => array(),
														'width' => array(),
														'id' => array(),
														'class' => array(),
														'style' => array(),
													),
												) ); ?>
											</div>
										</div>
									</div>
								</div>
							<?php endif;

							break;

					endswitch; ?>

					<div class="side-background-image">
						<?php echo wp_kses_post( wp_get_attachment_image( get_post_thumbnail_id() , 'full' ) ); ?>
					</div>
					
				</div>

			</div>

			<div class="entry-thumbnail">
				<?php if ( is_single() ) : ?>
					<?php the_post_thumbnail( 'content-width' ); ?>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'content-width' ); ?></a>
				<?php endif; ?>
			</div>

		<?php else : ?>

			<div class="entry-thumbnail-blank side-background"></div>

		<?php endif; ?>

		<div class="entry-content typography-content">

			<?php // The Content
			the_content(); ?>

		</div>

		<?php if ( is_single() ) : ?>

			<footer class="entry-footer">

				<?php // Post Pages Pagination
				ob_start();
				wp_link_pages( array(
					'before'           => '<strong>' . __( 'Pages: ', 'pixie' ) . '</strong>',
					'after'            => '',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'nextpagelink'     => __( 'Next Page', 'pixie' ),
					'previouspagelink' => __( 'Previous page', 'pixie' ),
					'pagelink'         => '%',
					'echo'             => 1,
				) );
				$post_pages_pagination = ob_get_clean();

				if ( ! empty( $post_pages_pagination ) ) : ?>
					<div class="entry-pages-pagination">
						<span class="screen-reader-text"><?php _e( 'Paged Post Navigation', 'pixie' ); ?></span>
						<?php echo wp_kses_post( $post_pages_pagination ); ?>
					</div>
				<?php endif; ?>

				<?php // Post Tags
				$blog_show_tags = get_theme_mod( 'blog_show_tags', true );
				$tags = get_the_tag_list();

				if ( $blog_show_tags && ! empty( $tags ) ) : ?>
					<div class="entry-tags tagscloud">
						<span class="screen-reader-text"><?php _e( 'Tagged in', 'pixie' ); ?></span>
						<?php echo wp_kses_post( $tags ); ?>
					</div>
				<?php endif; ?>

				<?php // Post Share
				$blog_show_social_share = get_theme_mod( 'blog_show_social_share', true );
				if ( ! empty( $blog_show_social_share ) ) : ?>
					<div class="entry-share">
						<div class="entry-share-title typography-meta"><?php _e( 'Share this post', 'pixie' ); ?></div>
						<div class="entry-share-links social-media-links">
							<a class="entry-share-facebook" target="_blank" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ); ?>">
								<i class="fa fa-facebook"></i><span class="hidden">facebook</span>
							</a>
							<a class="entry-share-twitter" target="_blank" href="<?php echo esc_url( 'https://twitter.com/home?status=' . get_the_title() . '%20-%20' . get_the_permalink() ); ?>">
								<i class="fa fa-twitter"></i><span class="hidden">twitter</span>
							</a>
							<a class="entry-share-google-plus" target="_blank" href="<?php echo esc_url( 'https://plus.google.com/share?url=' . get_the_permalink() ); ?>">
								<i class="fa fa-google-plus"></i><span class="hidden">google-plus</span>
							</a>
							<a class="entry-share-pinterest" target="_blank" href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . wp_get_attachment_url( get_post_thumbnail_id() ) . '&description=' . get_the_title() ); ?>">
								<i class="fa fa-pinterest"></i><span class="hidden">pinterest</span>
							</a>
						</div>
					</div>
				<?php endif; ?>

				<?php // Author bio.
				$blog_show_author_bio = get_theme_mod( 'blog_show_author_bio', true );

				if ( $blog_show_author_bio && get_the_author_meta( 'description' ) ) : ?>
					<div class="entry-author">

						<div class="entry-author-avatar"><?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 90 , '', get_the_author_meta( 'display_name' ) ) ); ?></div>
						<h6 class="entry-author-name typography-heading"><?php the_author(); ?></h6>
						<p class="entry-author-bio"><?php the_author_meta( 'description' ); ?></p>

						<?php
						$blog_show_author_socmed = get_theme_mod( 'blog_show_author_socmed', true );
						if ( $blog_show_author_socmed ) :
							
							$socmed = array();

							if ( get_the_author_meta( 'facebook' ) ) $socmed['facebook'] = get_the_author_meta( 'facebook' );
							if ( get_the_author_meta( 'twitter' ) ) $socmed['twitter'] = get_the_author_meta( 'twitter' );
							if ( get_the_author_meta( 'instagram' ) ) $socmed['instagram'] = get_the_author_meta( 'instagram' );
							if ( get_the_author_meta( 'pinterest' ) ) $socmed['pinterest'] = get_the_author_meta( 'pinterest' );
							if ( get_the_author_meta( 'googleplus' ) ) $socmed['googleplus'] = get_the_author_meta( 'googleplus' );
							if ( get_the_author_meta( 'dribbble' ) ) $socmed['dribbble'] = get_the_author_meta( 'dribbble' );
							if ( get_the_author_meta( 'behance' ) ) $socmed['behance'] = get_the_author_meta( 'behance' );

							if ( count( $socmed ) > 0 ) : ?>
								<div class="entry-author-socmed social-media-links">
									<?php if ( array_key_exists( 'facebook', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://facebook.com/' . $socmed['facebook'] ); ?>/"><span class="fa fa-facebook"></span><span class="hidden">facebook</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'twitter', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://twitter.com/' . $socmed['twitter'] ); ?>/"><span class="fa fa-twitter"></span><span class="hidden">twitter</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'instagram', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://instagram.com/' . $socmed['instagram'] ); ?>/"><span class="fa fa-instagram"></span><span class="hidden">instagram</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'pinterest', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://pinterest.com/' . $socmed['pinterest'] ); ?>/"><span class="fa fa-pinterest"></span><span class="hidden">pinterest</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'googleplus', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://plus.google.com/' . $socmed['googleplus'] ); ?>/"><span class="fa fa-google-plus"></span><span class="hidden">googleplus</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'dribbble', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://dribbble.com/' . $socmed['dribbble'] ); ?>/"><span class="fa fa-dribbble"></span><span class="hidden">dribbble</span></a><?php endif; ?>
									<?php if ( array_key_exists( 'behance', $socmed ) ) : ?><a href="<?php echo esc_url( 'http://www.behance.net/' . $socmed['behance'] ); ?>/"><span class="fa fa-behance"></span><span class="hidden">behance</span></a><?php endif; ?>
								</div>
							<?php endif;
						endif; ?>

					</div>
				<?php endif; ?>

			</footer>

		<?php endif; ?>

	</div>

</article>