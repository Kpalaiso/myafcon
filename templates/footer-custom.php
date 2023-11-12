<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */

$fcunited_footer_id = fcunited_get_custom_footer_id();
$fcunited_footer_meta = get_post_meta( $fcunited_footer_id, 'trx_addons_options', true );
if ( ! empty( $fcunited_footer_meta['margin'] ) ) {
	fcunited_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( fcunited_prepare_css_value( $fcunited_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $fcunited_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $fcunited_footer_id ) ) ); ?>
						<?php
						if ( ! fcunited_is_inherit( fcunited_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'fcunited_action_show_layout', $fcunited_footer_id );
	?>
</footer><!-- /.footer_wrap -->
