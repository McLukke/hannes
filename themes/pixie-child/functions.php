<?php

function pixie_child_after_setup_theme() {
	load_child_theme_textdomain( 'pixie', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'pixie_child_after_setup_theme' );