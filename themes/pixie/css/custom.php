<?php global $pixie_data; ?>

body,
.typography-page-heading {
	font-family: "<?php echo esc_html( get_theme_mod( 'font_family_1', 'PT Serif' ) ) ?>";
}

h1, h2, h3, h4, h5, h6,
input[type="reset"],
input[type="submit"],
button,
.button,
.rb-btn,
.typography-title,
.typography-big-heading,
.typography-heading,
.typography-meta,
#reply-title,
.portfolio-grid .portfolio-title,
.widget_recent_entries .post-date,
.widget_pixie_recent_posts .widget-post-date,
.widget_pixie_random_posts .widget-post-date,
.widget_rss .rss-date,
.rb-about-text .rb-title,
.rb-section-title,
.rb-experience .rb-right,
.rb-experience .rb-title,
.rb-widget-contactinfo .widget-title,
.rb-widget-experience .rb-experience-title {
	font-family: "<?php echo esc_html( get_theme_mod( 'font_family_2', 'Montserrat' ) ); ?>";
}

a, a:hover, a:focus,
input[type="reset"],
input[type="submit"],
button,
.button,
.rb-btn.rb-btn-white,
.rb-section-title,
.rb-widget-contactinfo .widget-title,
.rb-widget-experience .widget-title {
	color: <?php echo esc_html( get_theme_mod( 'color_accent', '#96c86e' ) ); ?>;
}

.entry-header:after,
input[type="reset"]:hover, input[type="reset"]:focus,
input[type="submit"]:hover, input[type="submit"]:focus,
button:focus, button:hover,
.button:focus, .button:hover,
.rb-btn.rb-btn-white:focus, .rb-btn.rb-btn-white:hover,
.portfolio-grid .portfolio:hover .portfolio-overlay,
.rb-widget-experience .rb-experience-rating > div {
	background-color: <?php echo esc_html( get_theme_mod( 'color_accent', '#96c86e' ) ); ?>;
}

input[type="reset"],
input[type="submit"],
button,
.button,
.rb-btn.rb-btn-white {
	border-color: <?php echo esc_html( get_theme_mod( 'color_accent', '#96c86e' ) ); ?>;
}

.side-background-left #main:before {
	right: <?php echo 100 - esc_html( get_theme_mod( 'side_background_width', 50 ) ); ?>%;
}
.side-background-right #main:before {
	left: <?php echo 100 - esc_html( get_theme_mod( 'side_background_width', 50 ) ); ?>%;
}
@media ( min-width: 992px ) {
	.side-background-left {
		padding-left: <?php echo esc_html( get_theme_mod( 'side_background_width', 50 ) ); ?>%;
	}
	.side-background-right {
		padding-right: <?php echo esc_html( get_theme_mod( 'side_background_width', 50 ) ); ?>%;
	}
}

.side-background {
	width: <?php echo esc_html( get_theme_mod( 'side_background_width', 50 ) ); ?>%;
}
.side-background-image:after {
	background-color: rgba(0,0,0,0.<?php echo esc_html( get_theme_mod( 'side_background_overlay_opacity', 0 ) ); ?>);
}
.side-background-overlay ~ .side-background-image:after {
	background-color: rgba(0,0,0,0.<?php echo esc_html( get_theme_mod( 'side_background_addon_overlay_opacity', 50 ) ); ?>);
}
@media ( min-width: 992px ) {
	.side-background-left .side-background {
		left: 0;
	}
	.side-background-right .side-background {
		right: 0;
	}
}

.entry.sticky .sticky-badge {
	border-top-color: <?php echo esc_html( get_theme_mod( 'color_accent', '#96c86e' ) ); ?>;
	border-right-color: <?php echo esc_html( get_theme_mod( 'color_accent', '#96c86e' ) ); ?>;
}