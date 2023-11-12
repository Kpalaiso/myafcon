<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

if ( fcunited_sidebar_present() ) {
	ob_start();
	$fcunited_sidebar_name = fcunited_get_theme_option( 'sidebar_widgets' );
	fcunited_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $fcunited_sidebar_name ) ) {
		dynamic_sidebar( $fcunited_sidebar_name );
	}
	$fcunited_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $fcunited_out ) ) {
		$fcunited_sidebar_position    = fcunited_get_theme_option( 'sidebar_position' );
		$fcunited_sidebar_position_ss = fcunited_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $fcunited_sidebar_position );
			echo ' sidebar_' . esc_attr( $fcunited_sidebar_position_ss );

			if ( 'float' == $fcunited_sidebar_position_ss ) {
				echo ' sidebar_float';
			}

			if ( ! fcunited_is_inherit( fcunited_get_theme_option( 'sidebar_scheme' ) ) && !empty(fcunited_get_theme_option( 'sidebar_scheme' )) ) {
				echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
			<?php
			// Single posts banner before sidebar
			fcunited_show_post_banner( 'sidebar' );
			// Button to show/hide sidebar on mobile
			if ( in_array( $fcunited_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$fcunited_title = apply_filters( 'fcunited_filter_sidebar_control_title', 'float' == $fcunited_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'fcunited' ) : '' );
				$fcunited_text  = apply_filters( 'fcunited_filter_sidebar_control_text', 'above' == $fcunited_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'fcunited' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $fcunited_title ); ?>"><?php echo esc_html( $fcunited_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'fcunited_action_before_sidebar' );
				fcunited_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $fcunited_out ) );
				do_action( 'fcunited_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
