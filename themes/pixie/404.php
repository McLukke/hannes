<?php get_header(); ?>

<div id="main" class="post-single loop">

	<article id="no-post" <?php post_class( 'entry no-post' ); ?>>

		<div class="center-wrapper">

			<div class="typography-content">
				<h1 class="typography-title"><?php _e( 'Page Not Found', 'pixie' ); ?></h1>
				<p><?php printf( __( 'The page you are requesting does not exists, please go back to <a href="%s">home page</a>, or try using our search feature.', 'pixie' ), esc_url( home_url() ) ); ?></p>
			</div>

		</div>

	</article>

</div>

<?php get_footer(); ?>