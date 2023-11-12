<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_essential_grid_theme_setup9', 9 );
	function fcunited_essential_grid_theme_setup9() {
		if ( fcunited_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_essential_grid_frontend_scripts', 1100 );
			add_filter( 'fcunited_filter_merge_styles', 'fcunited_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_essential_grid_tgmpa_required_plugins' ) ) {
	
	function fcunited_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'essential-grid' ) && fcunited_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && fcunited_is_theme_activated() ) {
			$path = fcunited_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || fcunited_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => fcunited_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'fcunited_exists_essential_grid' ) ) {
	function fcunited_exists_essential_grid() {
        return defined( 'ESG_PLUGIN_PATH' ) || defined( 'EG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'fcunited_essential_grid_frontend_scripts' ) ) {
	
	function fcunited_essential_grid_frontend_scripts() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/essential-grid/essential-grid.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-essential-grid', $fcunited_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'fcunited_essential_grid_merge_styles' ) ) {
	
	function fcunited_essential_grid_merge_styles( $list ) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}

