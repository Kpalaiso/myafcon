<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_mailchimp_theme_setup9', 9 );
	function fcunited_mailchimp_theme_setup9() {
		if ( fcunited_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_mailchimp_frontend_scripts', 1100 );
			add_filter( 'fcunited_filter_merge_styles', 'fcunited_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_mailchimp_tgmpa_required_plugins' ) ) {
	
	function fcunited_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && fcunited_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'fcunited_exists_mailchimp' ) ) {
	function fcunited_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'fcunited_mailchimp_frontend_scripts' ) ) {
	
	function fcunited_mailchimp_frontend_scripts() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-mailchimp', $fcunited_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'fcunited_mailchimp_merge_styles' ) ) {
	
	function fcunited_mailchimp_merge_styles( $list ) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( fcunited_exists_mailchimp() ) {
	require_once FCUNITED_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp-styles.php'; }

