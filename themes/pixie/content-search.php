<article id="page-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="center-wrapper">

		<header class="entry-header">

			<h2 class="entry-title typography-title">
				<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
			</h2>
			
		</header>

		<div class="entry-content typography-content">

			<?php // The Excerpt
			the_excerpt(); ?>

		</div>

		<footer class="entry-footer">

			<div class="entry-meta typography-meta">

				<?php // Type
				$pt = get_post_type_object( get_post_type() );
				switch ( $pt->name ) {
					case 'post':
					case 'portfolio':
						printf( '%s &nbsp;&rarr;&nbsp; %s', esc_html( $pt->labels->singular_name ), wp_kses_post( get_the_category_list( ', ' ) ) );
						break;
					
					default:
						printf( '%s', esc_html( $pt->labels->singular_name ) );
						break;
				} ?>
				
				<?php // Edit Link
				edit_post_link( '<span class="fa fa-pencil"></span> ' . __( 'Edit', 'pixie' ), '<span class="edit-link right">', '</span>' ); ?>

			</div>

		</footer>

	</div>

</article>