<?php

define( 'PIXIE_CSS_DIR', get_template_directory() . '/css' );
define( 'PIXIE_JS_DIR', get_template_directory() . '/js' );
define( 'PIXIE_MODULES_DIR', get_template_directory() . '/modules' );
define( 'PIXIE_WIDGETS_DIR', get_template_directory() . '/widgets' );
define( 'PIXIE_PLUGINS_DIR', get_template_directory() . '/plugins' );

define( 'PIXIE_CSS', get_template_directory_uri() . '/css' );
define( 'PIXIE_JS', get_template_directory_uri() . '/js' );
define( 'PIXIE_MODULES', get_template_directory_uri() . '/modules' );
define( 'PIXIE_WIDGETS', get_template_directory_uri() . '/widgets' );
define( 'PIXIE_PLUGINS', get_template_directory_uri() . '/plugins' );

/**
 * Pixie Global Variable
 */
global $pixie_data;

/**
 * Functions Customizer
 */
// require_once( get_template_directory() . '/functions-titan.php' );
require_once( get_template_directory() . '/functions-kirki.php' );

/**
 * Functions Resume Builder
 */
require_once( get_template_directory() . '/functions-resume-builder.php' );

/**
 * Functions Zilla Portfolio
 */
require_once( get_template_directory() . '/functions-zilla-portfolio.php' );

/**
 * Include all files in /widgets directory
 */
if ( file_exists( PIXIE_WIDGETS_DIR ) ) {

	$files = glob( PIXIE_WIDGETS_DIR . '/*' );
	if ( ! $files ) $files = array();

	$includes_files = array_filter( $files, 'is_file' );
	foreach ( $includes_files as $file ) {
		require_once( $file );
	}
}

/**
 * TGM Activation
 */
require_once( PIXIE_MODULES_DIR . '/class-tgm-plugin-activation.php' );
function pixie_tgmpa_register() {
	$plugins = array(
		array(
			'name'               => 'Kirki',
			'slug'               => 'kirki',
			'required'           => true,
			'force_activation'   => true,
			'force_deactivation' => true,
		),
		array(
			'name'               => 'Vafpress Post Formats UI',
			'slug'               => 'vafpress-post-formats-ui',
			'source'             => 'https://github.com/vafour/vafpress-post-formats-ui/archive/develop.zip',
			'external_url'       => 'https://github.com/vafour/vafpress-post-formats-ui',
			'required'           => false,
		),
		array(
			'name'               => 'Zilla Portfolio',
			'slug'               => 'zillaportfolio',
			'required'           => false,
		),
		array(
			'name'               => 'Resume Builder',
			'slug'               => 'resume-builder',
			'required'           => false,
		),
		array(
			'name'               => 'Contact Form 7',
			'slug'               => 'contact-form-7',
			'required'           => false,
		),
		array(
			'name'               => 'WP Instagram Widget',
			'slug'               => 'wp-instagram-widget',
			'required'           => false,
		),
	);

	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'pixie_tgmpa_register' );

/**
 * Content Width
 */
if ( ! isset( $content_width ) ) $content_width = 560;

/**
 * Enqueue styles and scripts
 */
function pixie_wp_enqueue_scripts() {

	global $pixie_data;
	$theme_data = wp_get_theme();

	/**
	 * CSS
	 */
	// Google Fonts
	$font_family_1 = get_theme_mod( 'font_family_1', 'PT Serif' );
	$font_subset_1 = implode( ',', get_theme_mod( 'font_subset_1', array() ) );
	wp_register_style( 'font-1', '//fonts.googleapis.com/css?family=' . $font_family_1 . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic' . ( empty( $font_subset_1 ) ? '' : '&subset=' . $font_subset_1 ) );
	wp_enqueue_style( 'font-1' );

	$font_family_2 = get_theme_mod( 'font_family_2', 'Montserrat' );
	$font_subset_2 = implode( ',', get_theme_mod( 'font_subset_2', array() ) );
	wp_register_style( 'font-2', '//fonts.googleapis.com/css?family=' . $font_family_2 . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic' . ( empty( $font_subset_2 ) ? '' : '&subset=' . $font_subset_2 ) );
	wp_enqueue_style( 'font-2' );

	// Theme CSS Files
	wp_register_style( 'normalize', PIXIE_CSS . '/normalize.min.css', '3.0.2' );
	wp_register_style( 'font-awesome', PIXIE_CSS . '/font-awesome.min.css', '4.3.0' );
	wp_register_style( 'main', PIXIE_CSS . '/main.css', array(
		'normalize',
		'font-awesome',
	), $theme_data->get( 'Version' ) );
	wp_enqueue_style( 'main' );

	// CSS from Options
	ob_start(); include( PIXIE_CSS_DIR . '/custom.php' ); $style_custom = ob_get_clean();
	wp_add_inline_style( 'main', $style_custom );
	wp_add_inline_style( 'main', get_theme_mod( 'custom_css' ) );

	// WP Default Stylesheet (required)
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	/**
	 * JS
	 */
	// Theme JS Files
	wp_register_script( 'jquery-waypoints', PIXIE_JS . '/jquery.waypoints.min.js', array( 'jquery' ), '3.1.1', true );
	wp_register_script( 'responsiveslides', PIXIE_JS . '/responsiveslides.min.js', array( 'jquery' ), '1.5.4', true );
	wp_register_script( 'main', PIXIE_JS . '/main.js', array(
		'jquery',
		'jquery-waypoints',
		'responsiveslides',
	), $theme_data->get( 'Version' ), true );
	wp_enqueue_script( 'main' );
	
}
add_action( 'wp_enqueue_scripts', 'pixie_wp_enqueue_scripts' );

function pixie_lt_ie9_scripts() {
	?><!--[if lt IE 9]>
	<script type="text/javascript" src="<?php echo esc_url( PIXIE_JS . '/html5shiv.min.js?ver=3.7.2' ); ?>"></script>
	<script type="text/javascript" src="<?php echo esc_url( PIXIE_JS . '/respond.min.js?ver=1.4.2' ); ?>"></script>
	<![endif]-->
	<?php
};
add_action( 'wp_head', 'pixie_lt_ie9_scripts', 0 );

/**
 * Setup Theme
 */
function pixie_after_setup_theme() {
	global $pixie_data;

	// add_theme_support( 'title-tag' ); // New WP 4.1
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

	add_theme_support( 'infinite-scroll', array( 'container' => 'main' ) );

	/**
	 * Image Sizes
	 */
	add_image_size( 'content-width', 600 );
	add_image_size( 'grid', 280, 280, true );

	/**
	 * Editor Styles
	 */
	if ( is_admin() ) {
		$font_family_1 = get_theme_mod( 'font_family_1', 'PT Serif' );
		$font_subset_1 = implode( ',', get_theme_mod( 'font_subset_1', array() ) );
		add_editor_style( str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font_family_1 ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic' . ( empty( $font_subset_1 ) ? '' : '&subset=' . $font_subset_1 ) ) );

		$font_family_2 = get_theme_mod( 'font_family_2', 'Montserrat' );
		$font_subset_2 = implode( ',', get_theme_mod( 'font_subset_2', array() ) );
		add_editor_style( str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font_family_2 ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic' . ( empty( $font_subset_2 ) ? '' : '&subset=' . $font_subset_2 ) ) );

		add_editor_style( add_query_arg( array(
			'font_family_1' => urlencode( get_theme_mod( 'font_family_1', 'PT Serif' ) ),
			'font_family_2' => urlencode( get_theme_mod( 'font_family_2', 'Montserrat' ) ),
			'color_accent' => urlencode( get_theme_mod( 'color_accent', '#96c86e' ) ),
		), PIXIE_CSS . '/editor.php' ) );
	}

	/**
	 * Languages
	 */
	load_theme_textdomain( 'pixie', get_template_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'pixie_after_setup_theme' );

/**
 * Change WP Title format for better SEO
 */
// Backward Compatibility for less than WP 4.1
	
function pixie_wp_title( $title, $sep ) {
	if ( is_feed() ) return $title;
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'pixie_wp_title', 10, 2 );

/**
 * Body Class
 */
function pixie_body_class( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'pixie_body_class' );

/**
 * Register Sidebars
 */
function pixie_widgets_init() {
	for ( $i = 1; $i <= 2; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Widgets Area %s', 'pixie' ), $i ),
			'id'            => 'footer-widgets-' . $i,
			'description'   => '',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title typography-heading">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'pixie_widgets_init' );

/**
 * Register WP Nav Menu
 */
function pixie_register_nav_menus() {
	register_nav_menus( array(
		'header-navigation' => __( 'Header Navigation', 'pixie' ),
	) );
}
add_action( 'init', 'pixie_register_nav_menus' );

/**
 * Add author social media
 */
function pixie_user_contactmethods( $contactmethods ) {
	$contactmethods['facebook'] = __( 'Facebook Username', 'pixie' );
	$contactmethods['twitter'] = __( 'Twitter Username (without @)', 'pixie' );
	$contactmethods['instagram'] = __( 'Instagram Username', 'pixie' );
	$contactmethods['pinterest'] = __( 'Pinterest Username', 'pixie' );
	$contactmethods['googleplus'] = __( 'Google Plus ID', 'pixie' );
	$contactmethods['dribbble'] = __( 'Dribbble Username', 'pixie' );
	$contactmethods['behance'] = __( 'Behance Username', 'pixie' );
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'pixie_user_contactmethods' );

/**
 * Callback comment item html
 */
function pixie_wp_list_comments_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php' ) );
}

/**
 * Change excerpt length
 */
function pixie_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'pixie_excerpt_length', 999 );

/**
 * Change read more
 */
function pixie_the_content_more_link() {
	ob_start(); ?>
	</p><p>
		<a class="more-link button button-accent" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_theme_mod( 'blog_read_more_text', __( 'Read More', 'pixie' ) ) ); ?></a><?php
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			comments_popup_link( __( '0', 'pixie' ), __( '1', 'pixie' ), __( '%', 'pixie' ), 'comments-link right typography-meta' );
		}
	?></p>
	<?php return ob_get_clean();
}
add_filter( 'the_content_more_link', 'pixie_the_content_more_link' );

/**
 * WP Nav Menu Fallback
 */
function pixie_wp_nav_menu_fallback_cb() {
	echo '<ul id="menu-header-navigation" class="header-navigation typography-meta"></ul>';
}

/**
 * Change Widget Search
 */
function pixie_get_search_form( $html ) {
	ob_start(); ?>
	<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="search-form">
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'pixie' ); ?>" />
		<span class="icon fa fa-search"></span>
		<button style="display: none;" type="submit"><?php _e( 'Search', 'pixie' ); ?></button>
	</form>
	<?php return ob_get_clean();
}
add_filter( 'get_search_form', 'pixie_get_search_form' );

/**
 * Helper Class: Get Attachment ID by URL
 */
function get_attachment_id_by_url( $url ) {
	$post_id = attachment_url_to_postid( $url );

	if ( ! $post_id ){
		$dir = wp_upload_dir();
		$path = $url;
		if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
			$path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
		}

		if ( preg_match( '/^(.*)(\-\d*x\d*)(\.\w{1,})/i', $path, $matches ) ){
			$url = $dir['baseurl'] . '/' . $matches[1] . $matches[3];
			$post_id = attachment_url_to_postid( $url );
		}
	}

	return (int) $post_id;
}