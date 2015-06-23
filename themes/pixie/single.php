<?php get_header(); ?>

<div id="main" class="post-single loop">

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'content' );

		endwhile; ?>

		<?php // Pagination
		$blog_show_prev_next_link = get_theme_mod( 'blog_show_prev_next_link', true );

		ob_start(); previous_post_link( '%link', '<span class="fa fa-angle-left"></span>' . __( 'Previous Post', 'pixie' ) ); $prev = ob_get_clean();
		ob_start(); next_post_link( '%link', __( 'Next Post', 'pixie' ) . '<span class="fa fa-angle-right"></span>' ); $next = ob_get_clean();
		if ( $blog_show_prev_next_link && ( ! empty( $prev ) || ! empty( $next ) ) ) : ?>
			<div class="post-pagination pagination container typography-meta">
				<span class="left"><?php echo wp_kses_post( $prev ); ?></span>
				<span class="right"><?php echo wp_kses_post( $next ); ?></span>
			</div>
		<?php endif;

		get_template_part( 'related' );

		comments_template();

	else :

		// No Posts Found
		get_template_part( 'content', 'none' );

	endif; ?>

</div>

<?php get_footer(); ?>