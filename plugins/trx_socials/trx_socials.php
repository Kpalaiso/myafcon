<?php
/* TRX Socials support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('fcunited_trx_socials_theme_setup9')) {
	add_action( 'after_setup_theme', 'fcunited_trx_socials_theme_setup9', 9 );
	function fcunited_trx_socials_theme_setup9() {
		
		if (is_admin()) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins',	'fcunited_trx_socials_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'fcunited_trx_socials_tgmpa_required_plugins' ) ) {

    function fcunited_trx_socials_tgmpa_required_plugins($list=array()) {
        if ( fcunited_storage_isset( 'required_plugins', 'trx_socials' ) && fcunited_storage_get_array( 'required_plugins', 'trx_socials', 'install' ) !== false && fcunited_is_theme_activated() ) {
            $path = fcunited_get_plugin_source_path('plugins/trx_socials/trx_socials.zip');
            if ( ! empty( $path ) || fcunited_get_theme_setting( 'tgmpa_upload' ) ) {
            $list[] = array(
                'name'     => fcunited_storage_get_array( 'required_plugins', 'trx_socials', 'title' ),
                'slug' 		=> 'trx_socials',
                'source'	=> !empty($path) ? $path : 'upload://trx_socials.zip',
                'version'   => '1.3.6',
                'required' 	=> false
            );
        }
        }
        return $list;
    }
}

// Check if TRX Socials installed and activated
if ( !function_exists( 'fcunited_exists_trx_socials' ) ) {
	function fcunited_exists_trx_socials() {
        return function_exists( 'trx_socials_load_plugin_textdomain' );
	}
}
?>