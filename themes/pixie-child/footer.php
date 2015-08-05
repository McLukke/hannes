
				<?php get_sidebar(); ?>

				<footer id="footer" class="footer-section">
					<div class="center-wrapper">

						<?php // Social Media
						$show_social_media_links = get_theme_mod( 'footer_show_social_media_links', true );
						if ( $show_social_media_links ) :

							global $pixie_data;

							$social_media_links = unserialize( get_theme_mod( 'social_media_active_links', serialize( array_keys( $pixie_data['social_media_links'] ) ) ) );

							ob_start();
							foreach ( $social_media_links as $s ) :
								$v = get_theme_mod( 'social_media_' . $s );

								if ( ! empty( $v ) ) : $i = isset( $i ) ? $i + 1 : 1; ?>
									<a href="<?php echo esc_url( $v ); ?>">
										<span class="fa fa-<?php echo esc_attr( $s ); ?>"></span>
										<span class="hidden"><?php echo esc_html( $pixie_data['social_media_links'][ $s ] ); ?></span>
									</a>
								<?php endif;
							endforeach;
							$print_social_media_links = ob_get_clean();

							if ( ! empty( $print_social_media_links ) ) : ?>
								<div class="footer-social-media-links social-media-links">
									<?php echo wp_kses_post( $print_social_media_links ); ?>
								</div>
							<?php endif;
						endif; ?>

						<?php // Copyright
						$copyright = get_theme_mod( 'footer_copyright' );

						if ( ! empty( $copyright ) ) : ?>
							<div class="footer-copyright">
								<?php echo apply_filters( 'the_content', html_entity_decode( $copyright ) ); ?>
							</div>
						<?php endif; ?>
						
					</div>
				</footer>

			</div>

		</div>

		<?php wp_footer(); ?>

<!--
		<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript">
			//var d = $(".post-related-meta");
			//d.text(d.text().trim().replace(/July/i, "hello everyone"));
		</script>
-->

	</body>

</html>