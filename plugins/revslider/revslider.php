<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_revslider_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_revslider_theme_setup9', 9 );
	function fcunited_revslider_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_revslider_tgmpa_required_plugins' ) ) {
	
	function fcunited_revslider_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'revslider' ) && fcunited_storage_get_array( 'required_plugins', 'revslider', 'install' ) !== false && fcunited_is_theme_activated() ) {
			$path = fcunited_get_plugin_source_path( 'plugins/revslider/revslider.zip' );
			if ( ! empty( $path ) || fcunited_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => fcunited_storage_get_array( 'required_plugins', 'revslider', 'title' ),
					'slug'     => 'revslider',
					'source'   => ! empty( $path ) ? $path : 'upload://revslider.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( ! function_exists( 'fcunited_exists_revslider' ) ) {
	function fcunited_exists_revslider() {
		return function_exists( 'rev_slider_shortcode' );
	}
}

// Allow loading RevSlider scripts and styles
// if it present in the content of the current page
if (!function_exists('fcunited_revslider_check_revslider_in_content')) {
	add_filter( 'revslider_include_libraries', 'fcunited_revslider_check_revslider_in_content' );
	function fcunited_revslider_check_revslider_in_content( $load ) {
		if ( ! $load && function_exists( 'trx_addons_check_revslider_in_content' ) && fcunited_is_layouts_available() ) {
			// Check slider in the page header
			if ( apply_filters( 'fcunited_filter_check_revslider_in_header', true ) ) {
				$header_type = fcunited_get_theme_option( 'header_type' );
				if ( 'custom' == $header_type ) {
					$header_id = fcunited_get_custom_header_id();
					if ( $header_id > 0 ) {
						$load = trx_addons_check_revslider_in_content( false, $header_id );
					}
				}
			}
			// Check slider in the page footer
			if ( apply_filters( 'fcunited_filter_check_revslider_in_footer', false ) ) {
				$footer_type = fcunited_get_theme_option( 'footer_type' );
				if ( 'custom' == $footer_type ) {
					$footer_id = fcunited_get_custom_footer_id();
					if ( $footer_id > 0 ) {
						$load = trx_addons_check_revslider_in_content( false, $footer_id );
					}
				}
			}
		}
		return $load;
	}
}