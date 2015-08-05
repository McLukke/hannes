<?php $show_related_posts = get_theme_mod( 'blog_show_related_posts', true );

if ( $show_related_posts ) {

	global $wp_query;
	$cat_arr = array();
	foreach ( get_the_category() as $category ) {
		array_push( $cat_arr, $category->term_id );
	}

	$temp = $wp_query;
	$wp_query = new WP_Query( array(
		'orderby'        => 'rand',
		'order'          => 'DESC',
		'post_type'      => 'post',
		'posts_per_page' => $show_related_posts,
		'post__not_in'   => array( get_the_ID() ),
		'category__in'   => $cat_arr,
		'post_status'    => 'publish',
	) );

	if ( have_posts() ) : ?>
			
		<div class="post-related">
			
			<div class="center-wrapper">
				<div class="post-related-index container">

					<header>
						<h3 class="post-related-heading typography-big-heading"><?php _e( 'Relaterede indlæg', 'pixie' ); ?></h3>
					</header>

					<?php while ( have_posts() ) : the_post();

						 $i = isset( $i ) ? $i + 1 : 1; ?>

						<div id="related-post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<a class="post-related-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'grid' ); ?>
							</a>
							<a class="post-related-title typography-heading" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<span class="post-related-meta typography-meta"><?php
							// setlocale(LC_ALL, array('da_DK.UTF-8', 'da_DK.ISO8859-1', 'da_DA@euro', 'da_DA', 'danish', 'Danish', 'Danish_Denmark'));
							// echo esc_html(strftime('%B %d, %Y', strtotime(get_the_date())));

							echo esc_html(get_the_date());
							?></span>
							
						</div>

						<?php if ( $i % 2 == 0 ) : ?>
							<div class="clear"></div>
						<?php endif;

					endwhile; ?>
				</div>
			</div>
			
		</div>

	<?php endif;

	$wp_query = $temp;
	wp_reset_postdata();

}