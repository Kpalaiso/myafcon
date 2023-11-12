<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_elegro_payment_theme_setup9', 9 );
	function fcunited_elegro_payment_theme_setup9() {
		if ( fcunited_exists_elegro_payment() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_elegro_payment_frontend_scripts', 1100 );
			add_filter( 'fcunited_filter_merge_styles', 'fcunited_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_elegro_payment_tgmpa_required_plugins' ) ) {
	
	function fcunited_elegro_payment_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'woocommerce' ) && fcunited_storage_isset( 'required_plugins', 'elegro-payment' ) && fcunited_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'elegro-payment', 'title' ),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'fcunited_exists_elegro_payment' ) ) {
	function fcunited_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'fcunited_elegro_payment_frontend_scripts' ) ) {
	
	function fcunited_elegro_payment_frontend_scripts() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/elegro-payment/elegro-payment.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-elegro-payment', $fcunited_url, array(), null );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'fcunited_elegro_payment_merge_styles' ) ) {
	
	function fcunited_elegro_payment_merge_styles( $list ) {
		$list[] = 'plugins/elegro-payment/elegro-payment.css';
		return $list;
	}
}

