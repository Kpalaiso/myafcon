<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.46
 */


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'fcunited_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'fcunited_skin_theme_setup3', 3 );
	function fcunited_skin_theme_setup3() {
		// ToDo: Add / Modify theme options, color schemes, required plugins, etc.
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_skin_tgmpa_required_plugins', 100);
	function fcunited_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( fcunited_storage_isset( 'required_plugins', 'sportspress' ) && fcunited_storage_get_array( 'required_plugins', 'sportspress', 'install' ) !== false ) {
			$list[] = array(
                'name'     => fcunited_storage_get_array( 'required_plugins', 'sportspress-for-soccer', 'title' ),
                'slug'     => 'sportspress-for-soccer',
                'required' => false,
            );
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
// Priority 1150 - after plugins-specific (1100), but before child theme (1200)
if ( ! function_exists( 'fcunited_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'fcunited_skin_frontend_scripts', 1150 );
	function fcunited_skin_frontend_scripts() {
		$fcunited_url = fcunited_get_file_url( FCUNITED_SKIN_DIR . 'skin.css' );
		if ( '' != $fcunited_url ) {
			wp_enqueue_style( 'fcunited-skin-' . esc_attr( FCUNITED_SKIN_NAME ), $fcunited_url, array(), null );
		}
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( FCUNITED_SKIN_DIR . 'skin.js' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_script( 'fcunited-skin-' . esc_attr( FCUNITED_SKIN_NAME ), $fcunited_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Enqueue skin-specific responsive styles
// Priority 2050 - after theme responsive 2000
if ( ! function_exists( 'fcunited_skin_styles_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'fcunited_skin_styles_responsive', 2050 );
	function fcunited_skin_styles_responsive() {
		$fcunited_url = fcunited_get_file_url( FCUNITED_SKIN_DIR . 'skin-responsive.css' );
		if ( '' != $fcunited_url ) {
			wp_enqueue_style( 'fcunited-skin-' . esc_attr( FCUNITED_SKIN_NAME ) . '-responsive', $fcunited_url, array(), null );
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'fcunited_skin_merge_scripts' ) ) {
	add_filter( 'fcunited_filter_merge_scripts', 'fcunited_skin_merge_scripts' );
	function fcunited_skin_merge_scripts( $list ) {
		if ( fcunited_get_file_dir( FCUNITED_SKIN_DIR . 'skin.js' ) != '' ) {
			$list[] = FCUNITED_SKIN_DIR . 'skin.js';
		}
		return $list;
	}
}

// Set theme specific importer options
if ( ! function_exists( 'fcunited_skin_importer_set_options' ) ) {
	add_filter('trx_addons_filter_importer_options', 'fcunited_skin_importer_set_options', 9);
	function fcunited_skin_importer_set_options($options = array()) {
		if ( is_array( $options ) ) {
			$rtl_url = is_rtl() ? 'rtl.' : '';
			$options['demo_type'] = 'default';
			$options['files']['default'] = $options['files']['default'];
			$options['files']['default']['title'] = esc_html__('Default', 'fcunited');
			$options['files']['default']['domain_demo'] = esc_url( 'https://' . $rtl_url . 'fc-united.axiomthemes.com' );   // Demo-site domain
		}
		return $options;
	}
}
unset ($GLOBALS['FCUNITED_STORAGE']['required_plugins']['joomsport-sports-league-results-management']);
unset ($GLOBALS['FCUNITED_STORAGE']['required_plugins']['sportspress-for-basketball']);
unset ($GLOBALS['FCUNITED_STORAGE']['required_plugins']['sportspress-for-golf']);


/* Deactivate "Sportpress for Basketball" for default skin */
if ( ! function_exists( 'fcunited_skin_plugin_off_in_theme' ) ) { 
	add_action( 'admin_init', 'fcunited_skin_plugin_off_in_theme' );
 
	function fcunited_skin_plugin_off_in_theme() {
		deactivate_plugins( 'sportspress-for-basketball/sportspress-for-basketball.php' );
        deactivate_plugins( 'joomsport-sports-league-results-management/joomsport-sports-league-results-management.php' );
	}
}
// Add slin-specific colors and fonts to the custom CSS
require_once FCUNITED_THEME_DIR . FCUNITED_SKIN_DIR . 'skin-styles.php';
