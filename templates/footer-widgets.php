<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */

// Footer sidebar
$fcunited_footer_name    = fcunited_get_theme_option( 'footer_widgets' );
$fcunited_footer_present = ! fcunited_is_off( $fcunited_footer_name ) && is_active_sidebar( $fcunited_footer_name );
if ( $fcunited_footer_present ) {
	fcunited_storage_set( 'current_sidebar', 'footer' );
	$fcunited_footer_wide = fcunited_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $fcunited_footer_name ) ) {
		dynamic_sidebar( $fcunited_footer_name );
	}
	$fcunited_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $fcunited_out ) ) {
		$fcunited_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $fcunited_out );
		$fcunited_need_columns = true;
		if ( $fcunited_need_columns ) {
			$fcunited_columns = max( 0, (int) fcunited_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $fcunited_columns ) {
				$fcunited_columns = min( 4, max( 1, fcunited_tags_count( $fcunited_out, 'aside' ) ) );
			}
			if ( $fcunited_columns > 1 ) {
				$fcunited_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $fcunited_columns ) . ' widget', $fcunited_out );
			} else {
				$fcunited_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $fcunited_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $fcunited_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $fcunited_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'fcunited_action_before_sidebar' );
				fcunited_show_layout( $fcunited_out );
				do_action( 'fcunited_action_after_sidebar' );
				if ( $fcunited_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $fcunited_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
