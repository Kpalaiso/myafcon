<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

						// Widgets area inside page content
						fcunited_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$fcunited_body_style = fcunited_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $fcunited_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$fcunited_widgets_name = fcunited_get_theme_option( 'widgets_below_page' );
					$fcunited_show_widgets = ! fcunited_is_off( $fcunited_widgets_name ) && is_active_sidebar( $fcunited_widgets_name );
					$fcunited_show_related = is_single() && fcunited_get_theme_option( 'related_position' ) == 'below_page';

					if ( $fcunited_show_widgets || $fcunited_show_related ) {
						if ( 'fullscreen' != $fcunited_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $fcunited_show_related ) {
							do_action( 'fcunited_action_related_posts' );
						}

						// Widgets area below page content
						if ( $fcunited_show_widgets ) {
							fcunited_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $fcunited_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				fcunited_show_post_banner('footer');
			}
			// Footer
			$fcunited_footer_type = fcunited_get_theme_option( 'footer_type' );
			if ( 'custom' == $fcunited_footer_type && ! fcunited_is_layouts_available() ) {
				$fcunited_footer_type = 'default';
			}
			get_template_part( apply_filters( 'fcunited_filter_get_template_part', "templates/footer-{$fcunited_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>