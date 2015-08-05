<?php get_header(); ?>

<div id="main" class="posts-index loop">

	<?php // Page Heading
	$title = '';

	if ( is_home() ) {
		if ( is_paged() ) {

			$title .= '<h1 class="typography-page-heading">';
			$title .= sprintf( __( 'Latest Blog Posts', 'pixie' ) );
			$title .= ( get_query_var( 'paged' ) ) ? sprintf( __( ' &mdash; Page %s', 'pixie' ), esc_html( get_query_var( 'paged' ) ) ) : '';
			$title .= '</h1>';

		} else {
			ob_start();

			$heading = get_theme_mod( 'blog_home_intro_heading' );
			$text = get_theme_mod( 'blog_home_intro_text' );

			if ( ! empty( $heading ) || ! empty( $text ) ) {

				ob_start(); ?>
				<div class="page-heading-intro">
					<h2 class="page-heading-title"><?php echo wp_kses_post( $heading ); ?></h2>
					<div class="typography-page-heading">
						<?php echo apply_filters( 'the_content', html_entity_decode( $text ) ); ?>
					</div>
				</div>
				<?php $title = ob_get_clean();
				
			}
		}
	} else {

		$title .= '<h1 class="typography-page-heading">';

		if ( is_search() ) {
			$title .= sprintf( __( 'Search results for "%s"', 'pixie' ), esc_html( get_search_query() ) );
		}
		elseif ( is_category() ) {
			$title .= sprintf( __( 'Posts in "%s" Category', 'pixie' ), esc_html( single_cat_title( '', false ) ) );
		}
		elseif ( is_tag() ) {
			$title .= sprintf( __( 'Posts tagged "%s"', 'pixie' ), esc_html( single_tag_title( '', false ) ) );
		}
		elseif ( is_author() ) {
			$title .= sprintf( __( 'Postst by "%s"', 'pixie' ), '<span class="vcard">' . esc_html( get_the_author() ) . '</span>' );
		}
		elseif ( is_year() ) {
			$title .= sprintf( __( 'Posts published in "%s"', 'pixie' ), esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'pixie' ) ) ) );
		}
		elseif ( is_month() ) {
			$title .= sprintf( __( 'Posts published on "%s"', 'pixie' ), esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'pixie' ) ) ) );
		}
		elseif ( is_day() ) {
			$title .= sprintf( __( 'Posts published at "%s"', 'pixie' ), esc_html( get_the_date( _x( 'F j, Y', 'daily archives date format', 'pixie' ) ) ) );
		}
		elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title .= _x( 'Aside Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title .= _x( 'Gallery Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title .= _x( 'Image Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title .= _x( 'Video Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title .= _x( 'Quote Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title .= _x( 'Link Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title .= _x( 'Status Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title .= _x( 'Audio Posts', 'post format archive title', 'pixie' );
			}
			elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title .= _x( 'Chat Posts', 'post format archive title', 'pixie' );
			}
		}
		elseif ( is_post_type_archive() ) {
			$title .= sprintf( __( 'Archives: %s', 'pixie' ), esc_html( post_type_archive_title( '', false ) ) );
		}
		elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title .= sprintf( __( '%1$s: %2$s', 'pixie' ), esc_html( $tax->labels->singular_name ), esc_html( single_term_title( '', false ) ) );
		}
		elseif ( is_archive() ) {
			$title .= __( 'Archives', 'pixie' );
		}

		$title .= ( get_query_var( 'paged' ) ) ? sprintf( __( ' &mdash; Page %s', 'pixie' ), esc_html( get_query_var( 'paged' ) ) ) : '';
		$title .= '</h1>';
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) : ?>
		<header class="page-heading">
			<div class="center-wrapper">
				<?php echo wp_kses_post( $title ); ?>
			</div>
		</header>
	<?php endif; ?>		

	<?php // Loop
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'content' );

		endwhile; ?>

		<?php // Pagination
		$prev = get_previous_posts_link( '<span class="fa fa-angle-left"></span>' . __( 'Preious Post', 'pixie' ) );
		$next = get_next_posts_link( __( 'Next Post', 'pixie' ) . '<span class="fa fa-angle-right"></span>' );
		?>

		<?php if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
			<div class="posts-pagination pagination container typography-meta">
				<span class="screen-reader-text"><?php _e( 'Posts Navigation', 'pixie' ); ?></span>
				<span class="left"><?php echo wp_kses_post( $prev ); ?></span>
				<span class="right"><?php echo wp_kses_post( $next ); ?></span>
			</div>
		<?php endif;

	else :

		// No Posts Found
		get_template_part( 'content', 'none' );

	endif; ?>

</div>

<?php get_footer(); ?>