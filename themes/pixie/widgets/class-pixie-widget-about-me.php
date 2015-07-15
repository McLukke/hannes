<?php

class Pixie_Widget_About_Me extends WP_Widget {

	function __construct() {
		parent::__construct(
			'pixie_about_me',
			__( 'Pixie: About Me', 'pixie' ),
			array( 'description' => __( 'About Me with image', 'pixie' ) )
		);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_pixie_about_me', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo wp_kses_post( $cache[ $args['widget_id'] ] );
			return;
		}

		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$image = isset( $instance['image'] ) ? $instance['image'] : '';
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : false;

		echo wp_kses_post( $args['before_widget'] );
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>

		<div class="textwidget">
			<?php if ( ! empty( $image ) ) : ?>
				<div class="image">
					<img src="<?php echo esc_url( $image ); ?>" alt="">
				</div>
			<?php endif; ?>
			<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
		</div>

		<?php echo wp_kses_post( $args['after_widget'] );
	}

	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$image  = isset( $instance['image']) ? strip_tags( $instance['image'] ) : '';
		$text   = isset( $instance['text']) ? esc_textarea( $instance['text'] ) : '';
		$filter = isset( $instance['filter']) ? (bool) $instance['filter'] : false;
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'pixie' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Image URL', 'pixie' ); ?> <small>(Recommended size: square, sized into 60x60px)</small></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text', 'pixie' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter' ) ); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>"><?php _e( 'Automatically add paragraphs', 'pixie' ); ?></label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['text'] = esc_textarea( $new_instance['text'] );
		$instance['filter'] = (bool) $new_instance['filter'];
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'pixie_about_me', 'widget' );
	}

}

// register
function register_widget_pixie_about_me() {
    register_widget( 'Pixie_Widget_About_Me' );
}
add_action( 'widgets_init', 'register_widget_pixie_about_me' );