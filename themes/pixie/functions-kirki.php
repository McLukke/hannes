<?php

/**
 * Variables
 */
global $pixie_data;

// Fill Social Media array
$pixie_data['social_media_links'] = apply_filters( 'pixie_social_media_links', array(
	'facebook' => __( 'Facebook', 'pixie' ),
	'twitter' => __( 'Twitter', 'pixie' ),
	'instagram' => __( 'Instagram', 'pixie' ),
	'pinterest' => __( 'Pinterest', 'pixie' ),
	'google-plus' => __( 'Google Plus', 'pixie' ),
	'dribbble' => __( 'Dribbble', 'pixie' ),
	'behance' => __( 'Behance', 'pixie' ),
) );

function pixie_get_posts_array( $post_type = 'post' ) {
	$return = array(
		0 => __( '-- Select --', 'pixie' ),
	);
	$posts = get_posts( array(
		'post_type' => $post_type,
	) );
	foreach ( $posts as $post ) {
		$return[ $post->ID ] = $post->post_title;
	}
	return $return;
}

/**
 * Create the customizer panels and sections
 */
function pixie_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'styles', array(
		'title'       => __( 'Styles', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'header', array(
		'title'       => __( 'Header', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'side_background', array(
		'title'       => __( 'Side Background', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'footer', array(
		'title'       => __( 'Footer', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'blog', array(
		'title'       => __( 'Blog', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'portfolio', array(
		'title'       => __( 'Portfolio', 'pixie' ),
		'priority'    => 300,
		'description' => __( 'Make sure you already install "Zilla Portfolio" plugin, and create portfolio posts. To create the portfolio archive page: Create a New Page, change the "Page template" to "Portfolio Archive". That page should display all your portfolio posts below the text content.' ),
	) );

	$wp_customize->add_section( 'resume', array(
		'title'       => __( 'Resume', 'pixie' ),
		'priority'    => 300,
		'description' => __( 'Make sure you already install "Resume Builder" plugin, and create a resume (or modify the sample resume provided). And then, Create a New Page, change the "Page template" to "Resume". Choose your default resume.' ),
	) );

	$wp_customize->add_section( 'contact', array(
		'title'       => __( 'Contact', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'social_media', array(
		'title'       => __( 'Social Media', 'pixie' ),
		'priority'    => 300,
	) );

	$wp_customize->add_section( 'custom_scripts', array(
		'title'       => __( 'Custom Scripts', 'pixie' ),
		'priority'    => 300,
	) );

}
add_action( 'customize_register', 'pixie_customize_register' );

/**
 * Create the setting
 */
function pixie_kirki_fields( $fields ) {

	global $pixie_data;

	// Styles
	$fields[] = array(
		'section'     => 'styles',
		'type'        => 'color',
		'setting'     => 'color_accent',
		'label'       => __( 'Accent Color', 'pixie' ),
		'description' => __( 'Used for links', 'pixie' ),
		'default'     => '#96c86e',
	);
	$fields[] = array(
		'section'     => 'styles',
		'type'        => 'select',
		'setting'     => 'font_family_1',
		'label'       => __( 'Primary Font', 'pixie' ),
		'description' => __( 'For normal paragraph text', 'pixie' ),
		'choices'     => Kirki_Fonts::get_font_choices(),
		'default'     => 'PT Serif',
	);
	$fields[] = array(
		'section'     => 'styles',
		'type'        => 'multicheck',
		'setting'     => 'font_subset_1',
		'label'       => __( 'Primary Font Subsets', 'pixie' ),
		'choices'     => Kirki_Fonts::get_google_font_subsets(),
		'default'     => array(),
	);
	$fields[] = array(
		'section'     => 'styles',
		'type'        => 'select',
		'setting'     => 'font_family_2',
		'label'       => __( 'Secondary Font', 'pixie' ),
		'description' => __( 'For headings and other minor elements', 'pixie' ),
		'choices'     => Kirki_Fonts::get_font_choices(),
		'default'     => 'Montserrat',
	);
	$fields[] = array(
		'section'     => 'styles',
		'type'        => 'multicheck',
		'setting'     => 'font_subset_2',
		'label'       => __( 'Secondary Font Subsets', 'pixie' ),
		'choices'     => Kirki_Fonts::get_google_font_subsets(),
		'default'     => array(),
	);

	// Header
	$fields[] = array(
		'section'     => 'header',
		'type'        => 'select',
		'setting'     => 'header_color',
		'label'       => __( 'Header Color', 'pixie' ),
		'choices'     => array(
			'white' => __( 'White', 'pixie' ),
			'black' => __( 'Black', 'pixie' ),
		),
		'default'     => 'white',
	);
	$fields[] = array(
		'section'     => 'header',
		'type'        => 'image',
		'setting'     => 'header_logo',
		'label'       => __( 'Logo', 'pixie' ),
		'description' => __( 'Maximum height 40px', 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'header',
		'type'        => 'checkbox',
		'setting'     => 'header_show_search',
		'label'       => __( 'Show Search Bar', 'pixie' ),
		'default'     => 1,
	);
	$fields[] = array(
		'section'     => 'header',
		'type'        => 'checkbox',
		'setting'     => 'header_show_social_media_links',
		'label'       => __( 'Show Social Media Links', 'pixie' ),
		'default'     => 1,
	);

	// Side Background
	$fields[] = array(
		'section'     => 'side_background',
		'type'        => 'select',
		'setting'     => 'side_background_position',
		'label'       => __( 'Position', 'pixie' ),
		'choices'     => array(
			'left'  => __( 'Left', 'pixie' ),
			'right' => __( 'Right', 'pixie' ),
		),
		'default'     => 'left',
	);
	$fields[] = array(
		'section'     => 'side_background',
		'type'        => 'slider',
		'setting'     => 'side_background_width',
		'label'       => __( 'Width', 'pixie' ),
		'choices'     => array(
			'min'  => 30,
			'max'  => 50,
			'step' => 1,
		),
		'default'     => 50,
	);
	$fields[] = array(
		'section'     => 'side_background',
		'type'        => 'slider',
		'setting'     => 'side_background_overlay_opacity',
		'label'       => __( 'Black Overlay Opacity', 'pixie' ),
		'choices'     => array(
			'min'  => 0,
			'max'  => 90,
			'step' => 1,
		),
		'default'     => 0,
	);
	$fields[] = array(
		'section'     => 'side_background',
		'type'        => 'slider',
		'setting'     => 'side_background_addon_overlay_opacity',
		'label'       => __( 'Black Overlay Opacity for Posts with Addon', 'pixie' ),
		'description' => __( 'For Gallery / Audio / Video post format', 'pixie' ),
		'choices'     => array(
			'min'  => 0,
			'max'  => 90,
			'step' => 1,
		),
		'default'     => 50,
	);
	$fields[] = array(
		'section'     => 'side_background',
		'type'        => 'image',
		'setting'     => 'side_background_image_search',
		'label'       => __( 'Image: Search Results Page', 'pixie' ),
		'description' => __( 'Background Image used for the search results page.', 'pixie' ),
		'default'     => '',
	);

	// Footer
	$fields[] = array(
		'section'     => 'footer',
		'type'        => 'checkbox',
		'setting'     => 'footer_show_widgets_area',
		'label'       => __( 'Show Widgets Area (2 columns)', 'pixie' ),
		'default'     => 1,
	);
	$fields[] = array(
		'section'     => 'footer',
		'type'        => 'checkbox',
		'setting'     => 'footer_show_social_media_links',
		'label'       => __( 'Show Social Media Links', 'pixie' ),
		'default'     => 1,
	);
	$fields[] = array(
		'section'     => 'footer',
		'type'        => 'textarea',
		'setting'     => 'footer_copyright',
		'label'       => __( 'Copyright Text', 'pixie' ),
		'default'     => '',
	);

	// Blog
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'text',
		'setting'     => 'blog_home_intro_heading',
		'label'       => __( 'Home Intro Heading', 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'textarea',
		'setting'     => 'blog_home_intro_text',
		'label'       => __( 'Home Intro Text', 'pixie' ),
		'description' => __( 'You can use HTML tags, double line break will be automatically converted to paragraphs', 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'text',
		'setting'     => 'blog_sticky_text',
		'label'       => __( 'Sticky Post Badge Text', 'pixie' ),
		'description' => __( 'Title (when hovered) of the green star badge on top right of the post', 'pixie' ),
		'default'     => __( 'Sticky Post', 'pixie' ),
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'text',
		'setting'     => 'blog_read_more_text',
		'label'       => __( 'Read More Text', 'pixie' ),
		'description' => __( 'Change "read more" text in index / archive page. How to cut your post with "read more": <a href="https://en.support.wordpress.com/splitting-content/more-tag/">here</a> ', 'pixie' ),
		'default'     => __( 'Read More', 'pixie' ),
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'checkbox',
		'setting'     => 'blog_show_tags',
		'label'       => __( 'Show Tags (Below Content)', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'checkbox',
		'setting'     => 'blog_show_author_bio',
		'label'       => __( 'Show Author Bio (Below Content)', 'pixie' ),
		'description' => __( 'You must fill "Biographical Info" in Your Profile Settings', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'checkbox',
		'setting'     => 'blog_show_author_socmed',
		'label'       => __( 'Show Author Social (Below Content)', 'pixie' ),
		'description' => __( 'You must fill "Contact Info" in Your Profile Settings', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'checkbox',
		'setting'     => 'blog_show_social_share',
		'label'       => __( 'Show Social Share (Below Content)', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'checkbox',
		'setting'     => 'blog_show_prev_next_link',
		'label'       => __( 'Show Prev/Next Post Link (Below Content)', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'blog',
		'type'        => 'slider',
		'setting'     => 'blog_show_related_posts',
		'label'       => __( 'Show Related Posts (Below Content)', 'pixie' ),
		'description' => __( 'Select 0 to disable', 'pixie' ),
		'default'     => 2,
		'choices'     => array(
			'min'  => 0,
			'max'  => 6,
			'step' => 2,
		),
	);

	// Portfolio
	$fields[] = array(
		'section'     => 'portfolio',
		'type'        => 'textarea',
		'setting'     => 'portfolio_archive_footer_text',
		'label'       => __( 'Archive Footer Text', 'pixie' ),
		'description' => __( 'Call to Action text', 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'portfolio',
		'type'        => 'text',
		'setting'     => 'portfolio_archive_footer_button_url',
		'label'       => __( 'Archive Footer Button URL', 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'portfolio',
		'type'        => 'text',
		'setting'     => 'portfolio_archive_footer_button_text',
		'label'       => __( 'Archive Footer Button Text', 'pixie' ),
		'default'     => '',
	);

	// Resume
	$fields[] = array(
		'section'     => 'resume',
		'type'        => 'select',
		'setting'     => 'resume_default',
		'label'       => __( 'Choose The Default Resume', 'pixie' ),
		'description' => __( 'All content in the page editor will be ignored and will display this Default Resume content instead', 'pixie' ),
		'choices'     => pixie_get_posts_array( 'rb_resume' ),
		'default'     => '',
	);

	// Contact
	$fields[] = array(
		'section'     => 'contact',
		'type'        => 'textarea',
		'setting'     => 'contact_map_locations',
		'label'       => __( 'Map Locations (Latitude, Longitude)', 'pixie' ),
		'description' => __( "You can input as many pin as you want, but ideally you only input 1-5 pins to the map. Format:\nlat_1|lon_1|text_1|custom_icon_1\nlat_2|lon_2|text_2|custom_icon_2\nlat_3|lon_3|text_3|custom_icon_3", 'pixie' ),
		'default'     => '',
	);
	$fields[] = array(
		'section'     => 'contact',
		'type'        => 'checkbox',
		'setting'     => 'contact_show_map_pins',
		'label'       => __( 'Show Map Pin Marker', 'pixie' ),
		'description' => __( 'Display map pin marker on each defined locations, will use default google maps pin marker image if no custom icon URL set in the location (defined above)', 'pixie' ),
		'default'     => true,
	);
	$fields[] = array(
		'section'     => 'contact',
		'type'        => 'slider',
		'setting'     => 'contact_map_zoom',
		'label'       => __( 'Zoom Level', 'pixie' ),
		'default'     => 15,
		'choices'     => array(
			'min'  => 0,
			'max'  => 18,
			'step' => 1,
		),
	);
	$fields[] = array(
		'section'     => 'contact',
		'type'        => 'textarea',
		'setting'     => 'contact_map_style',
		'label'       => __( 'Map Style JSON', 'pixie' ),
		'description' => __( 'Custom style JSON. You can create your own or paste the one you like from http://snazzymaps.com/', 'pixie' ),
		'default'     => '',
	);

	// Social Media
	$fields[] = array(
		'section'     => 'social_media',
		'type'        => 'sortable',
		'setting'     => 'social_media_active_links',
		'label'       => __( 'Select Active Links', 'pixie' ),
		'choices'     => $pixie_data['social_media_links'],
		'default'     => array_keys( $pixie_data['social_media_links'] ),
	);
	foreach ( $pixie_data['social_media_links'] as $key => $value ) {

		$p = isset( $p ) ? $p + 1 : 2;

		$fields[] = array(
			'section'     => 'social_media',
			'type'        => 'text',
			'setting'     => 'social_media_' . $key,
			'label'       => $value,
			'default'     => '',
		);
	}

	// Custom Scripts
	$fields[] = array(
		'section'     => 'custom_scripts',
		'type'        => 'textarea',
		'setting'     => 'custom_css',
		'label'       => __( 'Custom CSS', 'pixie' ),
		'default'     => '',
	);

	return $fields;
}
add_filter( 'kirki/fields', 'pixie_kirki_fields' );