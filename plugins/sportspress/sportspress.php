<?php
/* SportsPress support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_sportspress_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'fcunited_sportspress_theme_setup9', 9 );
    function fcunited_sportspress_theme_setup9() {

        if (is_admin()) {
            add_theme_support( 'sportspress' );
            add_filter('fcunited_filter_tgmpa_required_plugins', 'fcunited_sportspress_tgmpa_required_plugins');
            add_filter('fcunited_filter_theme_plugins', 'fcunited_sportspress_theme_plugins');
        }

        if(fcunited_exists_sportspress()) {

            if (fcunited_exists_sportspress() && fcunited_is_on(fcunited_get_theme_option('show_style_sportspress'))) {
                add_action('wp_enqueue_scripts', 'fcunited_sportspress_frontend_scripts', 1100);
                add_filter('fcunited_filter_merge_styles', 'fcunited_sportspress_merge_styles');
            }
            if (!is_admin()) {
                add_filter('fcunited_filter_detect_blog_mode', 'fcunited_sportspress_detect_blog_mode');
            }

            // Add plugin-specific colors and fonts to the custom CSS
            if (fcunited_is_on(fcunited_get_theme_option('show_style_sportspress'))) {
                if (fcunited_exists_sportspress()) {
                    require_once FCUNITED_THEME_DIR . 'plugins/sportspress/sportspress-styles.php';
                }
            }
        }

    }
}


// Register sidebars
add_action( 'init', 'fcunited_register_size_sportspress' );
function fcunited_register_size_sportspress(){
    // Reassigning the size of the cutting images of the plugin "SportsPress" - sportspress - prefix of the plugin itself
    add_image_size( 'sportspress-crop-medium',  500, 500, true );
    add_image_size( 'sportspress-fit-medium', 500, 500, false );
    add_image_size( 'sportspress-fit-icon',  400, 400, false );
    add_image_size( 'sportspress-fit-mini',  32, 32, false );
}



// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'fcunited_sportspress_theme_setup3' ) ) {
    add_action( 'after_setup_theme', 'fcunited_sportspress_theme_setup3', 3 );
    function fcunited_sportspress_theme_setup3() {
        if ( fcunited_exists_sportspress() ) {

            fcunited_storage_set_array_before(
                'options', 'fonts', array_merge(
                    array(
                        'sportspress'               => array(
                            'title'      => esc_html__( 'SportsPress', 'fcunited' ),
                            'desc'       => wp_kses_data( __( 'Select theme-specific parameters to display the SportsPress pages', 'fcunited' ) ),
                            'priority'   => 80,
                            'type'       => 'section',
                        ),
                        'single_style_sportspress'        => array(
                            'title' => esc_html__( 'Style SportsPress', 'fcunited' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_style_sportspress'            => array(
                            'title'    => esc_html__( 'Use theme style for SportsPress', 'fcunited' ),
                            'desc'     => wp_kses_data( __( "Use theme style for plugin elements", 'fcunited' ) ),
                            'std'      => 1,
                            'type'     => 'checkbox',
                        ),

                        'single_info_sportspress'        => array(
                            'title' => esc_html__( 'Single SportsPress', 'fcunited' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_related_posts_single_sportspress'            => array(
                            'title'    => esc_html__( 'Show related posts', 'fcunited' ),
                            'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single SportsPress pages", 'fcunited' ) ),
                            'std'      => 0,
                            'type'     => 'checkbox',
                        ),
                        'show_share_links_single_sportspress'              => array(
                            'title' => esc_html__( 'Show share links', 'fcunited' ),
                            'desc'  => wp_kses_data( __( 'Display share links on the single SportsPress', 'fcunited' ) ),
                            'std'   => 0,
                            'type'  => ! fcunited_exists_trx_addons() ? 'hidden' : 'checkbox',
                        ),
                        'show_author_info_single_sportspress'              => array(
                            'title' => esc_html__( 'Show author info', 'fcunited' ),
                            'desc'  => wp_kses_data( __( "Display block with information about post's author", 'fcunited' ) ),
                            'std'   => 0,
                            'type'  => 'checkbox',
                        ),
                    ),                       
                    fcunited_options_get_list_cpt_options( 'sportspress' )
                )
            );

        }
    }
}



// Detect current blog mode
if ( ! function_exists( 'fcunited_sportspress_detect_blog_mode' ) ) {
    function fcunited_sportspress_detect_blog_mode( $mode = '' ) {
        if ( is_sportspress() ) {
            $mode = 'sportspress';
        }
        return $mode;
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_sportspress_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('fcunited_filter_tgmpa_required_plugins',	'fcunited_sportspress_tgmpa_required_plugins');
	function fcunited_sportspress_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'sportspress' ) && fcunited_storage_get_array( 'required_plugins', 'sportspress', 'install' ) !== false && fcunited_is_theme_activated() ) {
			$path = fcunited_get_plugin_source_path( 'plugins/sportspress/sportspress.zip' );
			if ( ! empty( $path ) || fcunited_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => fcunited_storage_get_array( 'required_plugins', 'sportspress', 'title' ),
					'slug'     => 'sportspress',
					'source'   => ! empty( $path ) ? $path : 'upload://sportspress.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'fcunited_sportspress_theme_plugins' ) ) {
    
    function fcunited_sportspress_theme_plugins( $list = array() ) {
        if ( ! empty( $list['sportspress']['group'] ) ) {
            foreach ( $list as $k => $v ) {
                if ( substr( $k, 0, 12 ) == 'sportspress-' ) {
                    if ( empty( $v['group'] ) ) {
                        $list[ $k ]['group'] = $list['sportspress']['group'];
                    }
                    if ( ! empty( $list['sportspress']['logo'] ) ) {
                        $list[ $k ]['logo'] = strpos( $list['sportspress']['logo'], '//' ) !== false
                            ? $list['sportspress']['logo']
                            : fcunited_get_file_url( "plugins/sportspress/{$list['sportspress']['logo']}" );
                    }
                }

            }
        }
        return $list;
    }
}



// Check if sportspress installed and activated
if ( ! function_exists( 'fcunited_exists_sportspress' ) ) {
    function fcunited_exists_sportspress() {
        return  class_exists( 'SportsPress' );
    }
}


// Enqueue WooCommerce custom styles
if ( ! function_exists( 'fcunited_sportspress_frontend_scripts' ) ) {
    function fcunited_sportspress_frontend_scripts() {
        if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
            $fcunited_url = fcunited_get_file_url( 'plugins/sportspress/sportspress.css' );
            if ( '' != $fcunited_url ) {
                wp_enqueue_style( 'fcunited-sportspress', $fcunited_url, array(), null );
            }
        }
    }
}

// Merge custom styles
if ( ! function_exists( 'fcunited_sportspress_merge_styles' ) ) {
    function fcunited_sportspress_merge_styles( $list ) {
        $list[] = 'plugins/sportspress/sportspress.css';
        return $list;
    }
}


// Disable Cryptocurrency Rocket tools plugin updates
if ( !function_exists( 'fcunited_sportspress_plugin_updates' ) ) {
    add_filter('site_transient_update_plugins', 'fcunited_sportspress_plugin_updates');
    function fcunited_sportspress_plugin_updates($value) {
        if (isset($value->response['sportspress/sportspress.php'])) {
            unset($value->response['sportspress/sportspress.php']);
        }
        return $value;
    }
}

