<?php

/**
 * Override Default Settings
 */
remove_filter( 'the_content', 'tzp_add_portfolio_post_meta' );
remove_filter( 'the_content', 'tzp_add_portfolio_post_media' );

if ( ! defined( 'TZP_DISABLE_ARCHIVE' ) ) define( 'TZP_DISABLE_ARCHIVE', TRUE );

/**
 * New Settings
 */
function pixie_tzp_set_gallery_image_size( $value ) {
	return 'content-width';
}
add_filter( 'tzp_set_gallery_image_size', 'pixie_tzp_set_gallery_image_size' );

function pixie_tzp_add_portfolio_post_meta( $content ) {
	global $post;
	$output = '';

	if( $post->post_type == 'portfolio' ) {
		$url = get_post_meta( $post->ID, '_tzp_portfolio_url', true );
		$date = get_post_meta( $post->ID, '_tzp_portfolio_date', true );
		$client = get_post_meta( $post->ID, '_tzp_portfolio_client', true );

		if( $url || $date || $client ) {
			$output .= '<div class="portfolio-entry-meta"><ul>';
				if( $date ) {
					$output .= sprintf( '<li><strong>%1$s</strong> <span class="portfolio-project-date">%2$s</span></li>', __( 'Date: ', 'pixie' ), esc_html( $date ) );
				}
				if( $url ) {
					$output .= sprintf( '<li><strong>%1$s</strong><a class="portfolio-project-url" href="%2$s">%3$s</a></li>', __( 'URL: ', 'pixie' ), esc_url( $url ), esc_url( $url ) );
				}
				if( $client ) {
					$output .= sprintf( '<li><strong>%1$s</strong><span class="portfolio-project-client">%2$s</span></li>', __( 'Client: ', 'pixie' ), esc_html( $client ) );
				}
			$output .= '</ul></div>';
		}

		return $content . $output;
	} else {
		return $content;
	}
}