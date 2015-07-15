<article id="page-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

		<header class="entry-header">

			<h1 class="entry-title typography-title"><?php the_title(); ?></h1>
			
		</header>

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="entry-featured-side-background">

				<div class="side-background-anchor" data-target="#side-background-featured-<?php the_ID(); ?>"></div>

				<div id="side-background-featured-<?php the_ID(); ?>" class="side-background wait-loaded">
					<div class="side-background-image">
						<?php echo wp_kses_post( wp_get_attachment_image( get_post_thumbnail_id() , 'full' ) ); ?>
					</div>
				</div>

			</div>

			<div class="entry-thumbnail">
				<?php the_post_thumbnail( 'content-width' ); ?>
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
				$post_page_pagination = ob_get_clean();

				if ( ! empty( $post_page_pagination ) ) : ?>
					<div class="entry-pages-pagination">
						<?php echo wp_kses_post( $post_page_pagination ); ?>
					</div>
				<?php endif; ?>

			</footer>

		<?php endif; ?>

	</div>

</article>