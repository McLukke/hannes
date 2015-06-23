<?php get_header(); ?>

<div id="main" class="portfolio-single loop">

	<?php if ( have_posts() ) :

		while ( have_posts() ) : the_post();

// Begin Print ?>

<article id="portfolio-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

		<header class="entry-header">

			<div class="entry-meta typography-meta">

				<?php $categories = get_the_terms( get_the_ID(), 'portfolio-type' );

				$cat_string = array();
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$cat_string[] = $category->name;
					}
				} ?>

				<?php $pt = get_post_type_object( 'portfolio' );

				printf( '%s &nbsp;&rarr;&nbsp; %s', '<a href="' . esc_url( get_post_type_archive_link( 'portfolio' ) ) . '">' . __( 'Portfolio', 'pixie' ) . '</a>', implode( ', ', $cat_string ) ); ?>
				
				<?php // Edit Link
				edit_post_link( '<span class="fa fa-pencil"></span> ' . __( 'Edit', 'pixie' ), '<span class="edit-link right">', '</span>' ); ?>

			</div>

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

			<div class="entry-thumbnail"><?php the_post_thumbnail( 'content-width' ); ?></div>

		<?php else : ?>

			<div class="entry-thumbnail-blank side-background"></div>

		<?php endif; ?>

		<div class="entry-content typography-content">

			<?php // The Content
			echo '<div class="portfolio-content">';
				the_content();
			echo '</div>'; ?>

			<?php // Zilla Portfolio Media
			echo tzp_add_portfolio_post_media( '' ); ?>

			<?php // Zilla Portfolio Meta
			echo pixie_tzp_add_portfolio_post_meta( '' ); ?>

		</div>

	</div>

</article>

<?php comments_template(); ?>

<?php // End Print

		endwhile;

	else :

		// No Posts Found
		get_template_part( 'content', 'none' );

	endif; ?>

</div>

<?php get_footer(); ?>