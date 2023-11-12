<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_header_css   = '';
$fcunited_header_image = get_header_image();
$fcunited_header_video = fcunited_get_header_video();
if ( ! empty( $fcunited_header_image ) && fcunited_trx_addons_featured_image_override( is_singular() || fcunited_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$fcunited_header_image = fcunited_get_current_mode_image( $fcunited_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $fcunited_header_image ) || ! empty( $fcunited_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	if ( fcunited_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( fcunited_is_on( fcunited_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-mobile' ) );
	}

	if ( !is_single() || ( fcunited_get_theme_option( 'post_header_position' ) == 'default' && fcunited_get_theme_option( 'post_thumbnail_type' ) == 'default' ) ) {
		// Page title and breadcrumbs area
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-title' ) );
	}

	?>
</header>
