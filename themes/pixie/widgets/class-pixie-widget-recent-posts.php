<?php

class Pixie_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'pixie_recent_posts',
			__( 'Pixie: Recent Posts', 'pixie' ),
			array( 'description' => __( 'Recent Posts list with thumbnail images', 'pixie' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_pixie_recent_posts', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo wp_kses_post( $cache[ $args['widget_id'] ] );
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) $number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		global $wp_query; $temp = $wp_query;
		$wp_query = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => 1,
		) );

		if ( have_posts() ) :

			ob_start();

			echo wp_kses_post( $args['before_widget'] );
			echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>

			<ul>
				<?php while ( have_posts() ) : the_post(); ?>

					<li>

						<a class="widget-post-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							<?php endif; ?>
						</a>

						<a class="widget-post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

						<?php if ( $show_date ) : ?>
							<small class="widget-post-date"><?php echo get_the_date(); ?></small>
						<?php endif; ?>

					</li>

				<?php endwhile; ?>
			</ul>

			<?php echo wp_kses_post( $args['after_widget'] );

			$cache[ $args['widget_id'] ] = ob_get_flush();

			$wp_query = $temp; wp_reset_postdata();

			wp_cache_set( 'widget_pixie_recent_posts', $cache, 'widget' );

		endif;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$number    = isset( $instance['number']) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date']) ? (bool) $instance['show_date'] : false;
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'pixie' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'pixie' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>">
				<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" type="checkbox" <?php checked( $show_date ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>">
				<?php _e( 'Display post date?', 'pixie' ); ?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (bool) $new_instance['show_date'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'pixie_recent_posts', 'widget' );
	}

}

// register
function register_widget_pixie_recent_posts() {
    register_widget( 'Pixie_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'register_widget_pixie_recent_posts' );