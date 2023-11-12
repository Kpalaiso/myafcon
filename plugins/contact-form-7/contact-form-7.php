<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_cf7_theme_setup9', 9 );
	function fcunited_cf7_theme_setup9() {
		if ( fcunited_exists_cf7() ) {
			add_filter('wpcf7_autop_or_not', '__return_false');
			add_action( 'wp_enqueue_scripts', 'fcunited_cf7_frontend_scripts', 1100 );
			add_filter( 'fcunited_filter_merge_scripts', 'fcunited_cf7_merge_scripts' );
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_cf7_tgmpa_required_plugins' );
			add_filter( 'fcunited_filter_theme_plugins', 'fcunited_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_cf7_tgmpa_required_plugins' ) ) {
	
	function fcunited_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'contact-form-7' ) && fcunited_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'fcunited_cf7_theme_plugins' ) ) {
	
	function fcunited_cf7_theme_plugins( $list = array() ) {
		if ( ! empty( $list['contact-form-7']['group'] ) ) {
			foreach ( $list as $k => $v ) {
				if ( substr( $k, 0, 15 ) == 'contact-form-7-' ) {
					if ( empty( $v['group'] ) ) {
						$list[ $k ]['group'] = $list['contact-form-7']['group'];
					}
					if ( ! empty( $list['contact-form-7']['logo'] ) ) {
						$list[ $k ]['logo'] = strpos( $list['contact-form-7']['logo'], '//' ) !== false
												? $list['contact-form-7']['logo']
												: fcunited_get_file_url( "plugins/contact-form-7/{$list['contact-form-7']['logo']}" );
					}
				}
			}
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'fcunited_exists_cf7' ) ) {
	function fcunited_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'fcunited_cf7_frontend_scripts' ) ) {
	
	function fcunited_cf7_frontend_scripts() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_script( 'fcunited-cf7', $fcunited_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'fcunited_cf7_merge_scripts' ) ) {
	
	function fcunited_cf7_merge_scripts( $list ) {
		$list[] = 'plugins/contact-form-7/contact-form-7.js';
		return $list;
	}
}
