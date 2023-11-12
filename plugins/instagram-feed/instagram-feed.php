<?php
/* Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_instagram_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_instagram_feed_theme_setup9', 9 );
	function fcunited_instagram_feed_theme_setup9() {
		if ( fcunited_exists_instagram_feed() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_instagram_responsive_styles', 2000 );
			add_filter( 'fcunited_filter_merge_styles_responsive', 'fcunited_instagram_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_instagram_feed_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('fcunited_filter_tgmpa_required_plugins',	'fcunited_instagram_feed_tgmpa_required_plugins');
	function fcunited_instagram_feed_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'instagram-feed' ) && fcunited_storage_get_array( 'required_plugins', 'instagram-feed', 'install' ) !== false ) {
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'instagram-feed', 'title' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Instagram Feed installed and activated
if ( ! function_exists( 'fcunited_exists_instagram_feed' ) ) {
	function fcunited_exists_instagram_feed() {
		return defined( 'SBIVER' );
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'fcunited_instagram_responsive_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'fcunited_instagram_responsive_styles', 2000 );
	function fcunited_instagram_responsive_styles() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/instagram/instagram-responsive.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-instagram-responsive', $fcunited_url, array(), null );
			}
		}
	}
}

// Merge responsive styles
if ( ! function_exists( 'fcunited_instagram_merge_styles_responsive' ) ) {
	//Handler of the add_filter('fcunited_filter_merge_styles_responsive', 'fcunited_instagram_merge_styles_responsive');
	function fcunited_instagram_merge_styles_responsive( $list ) {
		$list[] = 'plugins/instagram/instagram-responsive.css';
		return $list;
	}
}

