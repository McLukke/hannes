<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<title><?php wp_title( '|', true, 'right' ); ?></title>
		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php global $pixie_data; ?>

		<div id="document" class="document">

			<header id="header" class="header-section header-color-<?php echo esc_attr( get_theme_mod( 'header_color', 'white' ) ); ?>">

				<?php // Logo
				ob_start(); ?>
				<a href="<?php echo esc_url( home_url() ); ?>">

					<?php $logo = get_theme_mod( 'header_logo' );

					if ( ! is_integer( $logo ) ) {
						$logo = get_attachment_id_by_url( $logo );
					}

					if ( ! empty( $logo ) ) :
						?><?php echo wp_kses_post( wp_get_attachment_image( $logo , 'full', 0, array( 'alt' => esc_attr( get_bloginfo( 'name' ) ) ) ) ); ?><?php
					else :
						?><span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span><?php
					endif; ?>
				</a>
				<?php $logo = ob_get_clean();

				if ( is_home() && ! is_paged() ) :
					 ?><h1 id="logo" class="header-logo typography-title"><?php echo wp_kses_post( $logo ); ?></h1><?php
				else :
					 ?><h2 id="logo" class="header-logo typography-title"><?php echo wp_kses_post( $logo ); ?></h2><?php
				endif; ?>

				<?php // Content ?>
				<div id="header-content" class="header-content container">

					<?php // Search Toggle
					$show_search = get_theme_mod( 'header_show_search', true );
					if ( $show_search ) : ?>
						<a href="#" class="header-search-toggle header-search-open"><span class="fa fa-search"></span></a>
						<div id="header-search" class="header-search <?php echo is_search() ? '' : 'hidden'; ?>">
							<a href="#" class="header-search-toggle header-search-close"><span class="fa fa-close"></span></a>
							<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="header-search-form">
								<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'pixie' ); ?>" />
								<span class="icon fa fa-search"></span>
								<button style="display: none;" type="submit"><?php _e( 'Search', 'pixie' ); ?></button>
							</form>
						</div>
					<?php endif; ?>

					<a href="#" class="header-collapse-toggle"><span class="fa fa-navicon"></span></a>
					<div id="header-collapse" class="header-collapse">

						<?php // Navigation
						wp_nav_menu( array(
							'theme_location' => 'header-navigation',
							'depth'          => 0,
							'container'      => false,
							'menu_class'     => 'header-navigation typography-meta',
							'fallback_cb'    => 'pixie_wp_nav_menu_fallback_cb',
						) ); ?>

						<?php // Social Media
						$show_social_media_links = get_theme_mod( 'header_show_social_media_links', true );

						if ( $show_social_media_links ) :

							$social_media_links = unserialize( get_theme_mod( 'social_media_active_links', serialize( array_keys( $pixie_data['social_media_links'] ) ) ) );

							ob_start();
							foreach ( $social_media_links as $s ) :
								$v = get_theme_mod( 'social_media_' . $s );

								if ( ! empty( $v ) ) : $i = isset( $i ) ? $i + 1 : 1; ?>
									<a href="<?php echo esc_url( $v ); ?>">
										<span class="fa fa-<?php echo esc_attr( $s ); ?>"></span>
										<span class="hidden"><?php echo esc_attr( $pixie_data['social_media_links'][ $s ] ); ?></span>
									</a>
								<?php endif;
							endforeach;
							$print_social_media_links = ob_get_clean();

							if ( ! empty( $print_social_media_links ) ) : ?>
								<div class="header-social-media-links social-media-links">
									<?php echo wp_kses_post( $print_social_media_links ); ?>
								</div>
							<?php endif;
						endif; ?>
						
					</div>

					<div class="header-collapse-overlay"></div>

				</div>					

			</header>

			<div id="content" class="content-section side-background-<?php echo esc_attr( get_theme_mod( 'side_background_position', 'left' ) ); ?>">