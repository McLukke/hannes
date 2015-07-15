<?php

function pixie_resume_builder_setup() {
	// Thumbnail Support
	add_post_type_support( 'rb_resume', 'thumbnail' );

	// Resume Builder
	remove_image_size( 'rb-resume-thumbnail' );
	add_image_size( 'rb-resume-thumbnail', 150, 150, true );
}
add_action( 'after_setup_theme', 'pixie_resume_builder_setup' );

function pixie_resume_builder_scripts() {
	// Dequeue CSS
	wp_dequeue_style( 'rb-font-awesome' );
	wp_dequeue_style( 'rb-styles' );

	// Dequeue JS
	wp_dequeue_script( 'rb-raty' );
	wp_dequeue_script( 'rb-functions' );
}
add_action( 'wp_enqueue_scripts', 'pixie_resume_builder_scripts' );