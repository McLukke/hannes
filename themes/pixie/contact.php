<?php

/*
 * Template Name: Contact + Maps
 */

get_header(); ?>

<div id="main" class="resume-single loop">

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

// Begin Print ?>

<article id="page-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

		<header class="entry-header">

			<h1 class="entry-title typography-title"><?php the_title(); ?></h1>

		</header>

		<?php // Map

		wp_enqueue_script( 'maplace', PIXIE_JS . '/maplace-0.1.3.min.js', array( 'jquery' ), '0.1.3', true );
		$map_pins = get_theme_mod( 'contact_map_locations' );
		$map_show_pin = get_theme_mod( 'contact_show_map_pins', true );
		$map_zoom = get_theme_mod( 'contact_map_zoom', 15 );
		$map_style = get_theme_mod( 'contact_map_style' );

		$map_pins = preg_split( "/\\r\\n|\\r|\\n/", $map_pins );

		$pins = array();
		foreach ( $map_pins as $pin ) {
			if ( empty( $pin ) ) continue;
			$pin = preg_replace( "/(^)?(<br\s*\/?>\s*)+$/", "", $pin );
			$pin = explode( '|' , $pin, 4 );
			$pin = array_map( 'trim', $pin );
			$pins[] = array(
				'lat' => isset( $pin[0] ) ? $pin[0] : '',
				'lon' => isset( $pin[1] ) ? $pin[1] : '',
				'html' => isset( $pin[2] ) ? $pin[2] : '',
				'icon' => isset( $pin[3] ) ? $pin[3] : '',
			);
		}

		?>

		<div class="entry-featured-side-background">

			<div class="side-background-anchor" data-target="#side-background-featured-<?php the_ID(); ?>"></div>

			<div id="side-background-featured-<?php the_ID(); ?>" class="side-background">
				<div class="side-background-map">
					<div id="gmap"></div>
			
					<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
					<!-- GOGGLE MAPS CONFIGURATION -->
					<!-- ref: http://maplacejs.com/ -->
					<script>
					var gmap_options = {
						generate_controls : false,
						locations : [
							<?php foreach ( $pins as $pin ) : ?>
								{
									lat : <?php echo esc_js( $pin[ 'lat' ] ); ?>,
									lon : <?php echo esc_js( $pin[ 'lon' ] ); ?>,
									html : '<?php echo esc_js( $pin[ 'html' ] ); ?>',
									icon : '<?php echo esc_js( $pin[ 'icon' ] ); ?>',
									animation : google.maps.Animation.DROP,
									visible : <?php echo esc_js( $map_show_pin == 1 ? 'true' : 'false' ); ?>,
								},
							<?php endforeach; ?>
						],
						map_options : {
							scrollwheel : true,
							mapTypeControl : false,
							streetViewControl : false,
							zoomControlOptions : {
								style : google.maps.ZoomControlStyle.SMALL,
							},
							zoom : <?php echo esc_js( $map_zoom ); ?>,
						},
						styles : {
							'Pixie' : <?php echo ( ! empty( $map_style ) ) ? html_entity_decode( $map_style ) : '[]'; ?>,
						},
					};
					</script>
				</div>
			</div>

		</div>

		<div class="entry-content typography-content">

			<?php // The Content
			the_content(); ?>

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