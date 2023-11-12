<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

// Header sidebar
$fcunited_header_name    = fcunited_get_theme_option( 'header_widgets' );
$fcunited_header_present = ! fcunited_is_off( $fcunited_header_name ) && is_active_sidebar( $fcunited_header_name );
if ( $fcunited_header_present ) {
	fcunited_storage_set( 'current_sidebar', 'header' );
	$fcunited_header_wide = fcunited_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $fcunited_header_name ) ) {
		dynamic_sidebar( $fcunited_header_name );
	}
	$fcunited_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $fcunited_widgets_output ) ) {
		$fcunited_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $fcunited_widgets_output );
		$fcunited_need_columns   = strpos( $fcunited_widgets_output, 'columns_wrap' ) === false;
		if ( $fcunited_need_columns ) {
			$fcunited_columns = max( 0, (int) fcunited_get_theme_option( 'header_columns' ) );
			if ( 0 == $fcunited_columns ) {
				$fcunited_columns = min( 6, max( 1, fcunited_tags_count( $fcunited_widgets_output, 'aside' ) ) );
			}
			if ( $fcunited_columns > 1 ) {
				$fcunited_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $fcunited_columns ) . ' widget', $fcunited_widgets_output );
			} else {
				$fcunited_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $fcunited_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $fcunited_header_wide ) {
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
				fcunited_show_layout( $fcunited_widgets_output );
				do_action( 'fcunited_action_after_sidebar' );
				if ( $fcunited_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $fcunited_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
