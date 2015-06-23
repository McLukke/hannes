<?php

/*
 * Template Name: Portfolio Archive
 */

get_header(); ?>

<div id="main" class="portfolio-archive loop">

	<?php if ( have_posts() ) :

		while ( have_posts() ) : the_post();

// Begin Print ?>

<article id="page-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

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

		<header class="entry-header">
			<h1 class="entry-title typography-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content typography-content">

			<?php // The Content
			the_content(); ?>

		</div>

		<?php global $wp_query; $temp = $wp_query;
		$wp_query = new WP_Query( array(
			'post_type'      => 'portfolio',
			'posts_per_page' => -1,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		) );

		if ( have_posts() ) : ?>

			<div class="portfolio-grid container">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php $categories = get_the_terms( get_the_ID(), 'portfolio-type' );

					$cat_string = array();
					$filter_string = array();
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category ) {
							$cat_string[] = $category->name;
							$filter_string[] = 'filter-' . $category->slug;
						}
					} ?>

					<div id="portfolio-<?php the_ID(); ?>" <?php post_class( implode( ' ', $filter_string ) ); ?>>
						<a href="<?php the_permalink(); ?>" class="portfolio-inner">

							<div class="portfolio-image">
								<?php the_post_thumbnail( 'grid' ); ?>
							</div>
							<div class="portfolio-overlay"></div>
							<div class="portfolio-text">
								<h2 class="portfolio-heading typography-heading"><?php the_title(); ?></h2>
								<div class="portfolio-category typography-meta"><?php echo implode( ', ' , $cat_string ); ?></div>
							</div>

						</a>
					</div>

				<?php endwhile; ?>

			</div>
			
		<?php else :

			// No Posts Found
			get_template_part( 'content', 'none' );

		endif;

		$wp_query = $temp; wp_reset_postdata(); ?>

	</div>

</article>

<?php // Footer

ob_start();

// Text
$text = get_theme_mod( 'portfolio_archive_footer_text' );
if ( ! empty( $text ) ) : ?>
	<div class="portfolio-archive-footer-text"><?php echo wp_kses_post( $text ); ?></div>
<?php endif;

// Button
$button_url = get_theme_mod( 'portfolio_archive_footer_button_url' );
$button_text = get_theme_mod( 'portfolio_archive_footer_button_text' );
if ( ! empty( $button_url ) && ! empty ( $button_text ) ) : ?>
	<div class="portfolio-archive-footer-button">
		<a href="<?php echo esc_url( $button_url ); ?>" class="button button-accent">
			<?php echo wp_kses_post( $button_text ); ?>
		</a>
	</div>
<?php endif;

$print = ob_get_clean();
if ( ! empty( $print ) ) : ?>

	<div class="portfolio-archive-footer">
		<div class="center-wrapper">
			<?php echo wp_kses_post( $print ); ?>
		</div>
	</div>

<?php endif; ?>

<?php comments_template(); ?>

<?php // End Print

		endwhile;

	else :

		// No Posts Found

	endif; ?>

</div>

<?php get_footer(); ?>