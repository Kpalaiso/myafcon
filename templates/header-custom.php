<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.06
 */

$fcunited_header_css   = '';
$fcunited_header_image = get_header_image();
$fcunited_header_video = fcunited_get_header_video();
if ( ! empty( $fcunited_header_image ) && fcunited_trx_addons_featured_image_override( is_singular() || fcunited_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$fcunited_header_image = fcunited_get_current_mode_image( $fcunited_header_image );
}

$fcunited_header_id = fcunited_get_custom_header_id();
$fcunited_header_meta = get_post_meta( $fcunited_header_id, 'trx_addons_options', true );
if ( ! empty( $fcunited_header_meta['margin'] ) ) {
	fcunited_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( fcunited_prepare_css_value( $fcunited_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $fcunited_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $fcunited_header_id ) ) ); ?>
				<?php
				echo ! empty( $fcunited_header_image ) || ! empty( $fcunited_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $fcunited_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $fcunited_header_image ) {
					echo ' ' . esc_attr( fcunited_add_inline_css_class( 'background-image: url(' . esc_url( $fcunited_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( fcunited_is_on( fcunited_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight fcunited-full-height';
				}
				if ( ! fcunited_is_inherit( fcunited_get_theme_option( 'header_scheme' ) ) ) {
					echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'header_scheme' ) );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $fcunited_header_video ) ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'fcunited_action_show_layout', $fcunited_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
