<?php 
/*
 * Template Name: Default Template No Heading
 */

get_header(); ?>

<style>
	.entry-header
	{
		display: none;
	}
</style>

<div id="main" class="page-single loop">

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'page' );

		endwhile;

		comments_template();

	else :

		// No Posts Found
		get_template_part( 'content', 'none' );

	endif; ?>

</div>

<?php get_footer(); ?>