<?php
	function pixie_child_after_setup_theme() {
		load_child_theme_textdomain( 'pixie', get_stylesheet_directory() . '/languages' );
	}
	add_action( 'after_setup_theme', 'pixie_child_after_setup_theme' );

	// function theme_enqueue_styles() {
 //    $parent_style = 'parent-style';

 //    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 //    wp_enqueue_style( 'child-style',
 //      get_stylesheet_directory_uri() . '/style.css',
 //      array( $parent_style )
 //    );
	// }
	// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
?>
