<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_wp_gdpr_compliance_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_wp_gdpr_compliance_theme_setup9', 9 );
	function fcunited_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	
	function fcunited_wp_gdpr_compliance_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'wp-gdpr-compliance' ) && fcunited_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'install' ) !== false ) {
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'title' ),
				'slug'     => 'wp-gdpr-compliance',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'fcunited_exists_wp_gdpr_compliance' ) ) {
	function fcunited_exists_wp_gdpr_compliance() {
		return defined( 'WP_GDPR_C_ROOT_FILE' ) || defined( 'WPGDPRC_ROOT_FILE' );
	}
}
