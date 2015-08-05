<?php get_header(); ?>

<div id="main" class="search-index loop">

	<?php $side_background = get_theme_mod( 'side_background_image_search' ) ;

	if ( ! is_integer( $side_background ) ) {
		$side_background = get_attachment_id_by_url( $side_background );
	}

	if ( ! empty( $side_background ) ) : ?>
		<div class="side-background-default">

			<div class="side-background-anchor" data-target="#side-background-featured-<?php the_ID(); ?>"></div>

			<div class="side-background">
				<?php echo wp_kses_post( wp_get_attachment_image( $side_background , 'full' ) ); ?>
			</div>

		</div>
	<?php endif; ?>

	<header class="page-heading">
		<div class="center-wrapper">
			<h1 class="typography-page-heading"><?php printf( __( 'Search results for "%s"', 'pixie' ), esc_html( get_search_query() ) ); ?></h1>
		</div>
	</header>

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'search' );

		endwhile; ?>

		<?php // Pagination
		$prev = get_previous_posts_link( '<span class="fa fa-angle-left"></span>' . __( 'Previous Post', 'pixie' ) );
		$next = get_next_posts_link( __( 'Next Post', 'pixie' ) . '<span class="fa fa-angle-right"></span>' );
		?>

		<?php if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
			<div class="posts-pagination pagination container typography-meta">
				<span class="screen-reader-text"><?php _e( 'Posts Navigation', 'pixie' ); ?></span>
				<span class="left"><?php echo wp_kses_post( $prev ); ?></span>
				<span class="right"><?php echo wp_kses_post( $next ); ?></span>
			</div>
		<?php endif;

	else :

		// No Posts Found
		get_template_part( 'content', 'none' );

	endif; ?>

</div>

<?php get_footer(); ?>