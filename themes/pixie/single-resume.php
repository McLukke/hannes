<?php

/*
 * Template Name: Resume
 */

get_header(); ?>

<div id="main" class="resume-single loop">

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			$id = $post->ID;
			if ( is_page() ) $id = get_theme_mod( 'resume_default' );

// Begin Print ?>

<article id="resume-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

		<h1 class="sr-only"><?php echo esc_html( get_the_title( $id ) ); ?></h1>

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

		<?php elseif ( has_post_thumbnail( $id ) ) : ?>

			<div class="entry-featured-side-background">

				<div class="side-background-anchor" data-target="#side-background-featured-<?php echo esc_attr( $id ); ?>"></div>

				<div id="side-background-featured-<?php echo esc_attr( $id ); ?>" class="side-background wait-loaded">
					<div class="side-background-image">
						<?php echo wp_kses_post( wp_get_attachment_image( get_post_thumbnail_id( $id ) , 'full' ) ); ?>
					</div>
				</div>

			</div>

			<div class="entry-thumbnail">
				<?php echo wp_kses_post( get_the_post_thumbnail( $id, 'content-width' ) ); ?>
			</div>

		<?php else : ?>

			<div class="entry-thumbnail-blank side-background"></div>

		<?php endif; ?>

		<?php

		wp_enqueue_script( 'inview', PIXIE_JS . '/jquery.inview.min.js', array( 'jquery' ), '1.0.0', true );

		echo do_shortcode( '[rb_resume id="' . $id . '"]' );
		
		?>

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