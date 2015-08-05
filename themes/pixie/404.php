<?php get_header(); ?>

<div id="main" class="post-single loop">

	<article id="no-post" <?php post_class( 'entry no-post' ); ?>>

		<div class="center-wrapper">

			<div class="typography-content">
				<h1 class="typography-title"><?php _e( 'Siden Blev Ikke Fundet', 'pixie' ); ?></h1>
				<p><?php printf( __( 'Den side, du anmoder om ikke eksisterer, du gå tilbage til <a href="%s">startside</a>, eller prøv at bruge vores søgefunktion.', 'pixie' ), esc_url( home_url() ) ); ?></p>
			</div>

		</div>

	</article>

</div>

<?php get_footer(); ?>