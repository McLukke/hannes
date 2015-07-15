<?php if ( get_theme_mod( 'footer_show_widgets_area', true ) ) : ?>

	<aside id="widgets" class="widgets-section" role="complementary">
		<div class="center-wrapper">

			<div class="widgets-row container">

				<div class="widgets-col">
					<?php if ( is_active_sidebar( 'footer-widgets-1' ) ) dynamic_sidebar( 'footer-widgets-1' ); ?>
				</div>

				<div class="widgets-col">
					<?php if ( is_active_sidebar( 'footer-widgets-2' ) ) dynamic_sidebar( 'footer-widgets-2' ); ?>
				</div>

			</div>

		</div>
	</aside>

<?php endif; ?>