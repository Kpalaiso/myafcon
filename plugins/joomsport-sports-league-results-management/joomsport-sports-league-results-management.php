<?php
/* Joomsport support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_joomsport_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'fcunited_joomsport_theme_setup9', 9 );
    function fcunited_joomsport_theme_setup9() {

        if (is_admin()) {
            add_theme_support( 'joomsport' );
            add_filter('fcunited_filter_tgmpa_required_plugins', 'fcunited_joomsport_tgmpa_required_plugins');
            add_filter('fcunited_filter_theme_plugins', 'fcunited_joomsport_theme_plugins');
        }

        if(fcunited_exists_joomsport()) {

            if (fcunited_exists_joomsport() && fcunited_is_on(fcunited_get_theme_option('show_style_joomsport'))) {
                add_action('wp_enqueue_scripts', 'fcunited_joomsport_frontend_scripts', 1100);
                add_filter('fcunited_filter_merge_styles', 'fcunited_joomsport_merge_styles');
            }
            if (!is_admin()) {
                add_filter('fcunited_filter_detect_blog_mode', 'fcunited_joomsport_detect_blog_mode');
            }

        }

    }
}


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'fcunited_joomsport_theme_setup3' ) ) {
    add_action( 'after_setup_theme', 'fcunited_joomsport_theme_setup3', 3 );
    function fcunited_joomsport_theme_setup3() {
        if ( fcunited_exists_joomsport() ) {

            fcunited_storage_set_array_before(
                'options', 'fonts', array_merge(
                    array(
                        'joomsport'               => array(
                            'title'      => esc_html__( 'JoomSport', 'fcunited' ),
                            'desc'       => wp_kses_data( __( 'Select theme-specific parameters to display the JoomSport pages', 'fcunited' ) ),
                            'priority'   => 80,
                            'type'       => 'section',
                        ),
                        'single_style_joomsport'        => array(
                            'title' => esc_html__( 'Style JoomSport', 'fcunited' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_style_joomsport'            => array(
                            'title'    => esc_html__( 'Use theme style for JoomSport', 'fcunited' ),
                            'desc'     => wp_kses_data( __( "Use theme style for plugin elements", 'fcunited' ) ),
                            'std'      => 1,
                            'type'     => 'checkbox',
                        ),

                        'single_info_joomsport'        => array(
                            'title' => esc_html__( 'Single JoomSport', 'fcunited' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_related_posts_single_joomsport'            => array(
                            'title'    => esc_html__( 'Show related posts', 'fcunited' ),
                            'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single JoomSport pages", 'fcunited' ) ),
                            'std'      => 0,
                            'type'     => 'checkbox',
                        ),
                        'show_share_links_single_joomsport'              => array(
                            'title' => esc_html__( 'Show share links', 'fcunited' ),
                            'desc'  => wp_kses_data( __( 'Display share links on the single JoomSport', 'fcunited' ) ),
                            'std'   => 0,
                            'type'  => ! fcunited_exists_trx_addons() ? 'hidden' : 'checkbox',
                        ),

                        'posts_navigation_joomsport'           => array(
                            'title'   => esc_html__( 'Show posts navigation', 'fcunited' ),
                            'desc'    => wp_kses_data( __( "Show posts navigation on the single post's pages", 'fcunited' ) ),
                            'std'     => 'none',
                            'options' => array(
                                'none'   => esc_html__('None', 'fcunited'),
                                'links'  => esc_html__('Prev/Next links', 'fcunited'),
                            ),
                            'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
                        ),

                        'show_author_info_single_joomsport'              => array(
                            'title' => esc_html__( 'Show author info', 'fcunited' ),
                            'desc'  => wp_kses_data( __( "Display block with information about post's author", 'fcunited' ) ),
                            'std'   => 0,
                            'type'  => 'checkbox',
                        ),
                    ),                       
                    fcunited_options_get_list_cpt_options( 'joomsport' )
                )
            );

        }
    }
}



// Detect current blog mode
if (!function_exists('fcunited_joomsport_detect_blog_mode')) {
	function fcunited_joomsport_detect_blog_mode($mode = '')
	{
		if ( get_post_type() == 'joomsport_season'
			|| get_post_type() == 'joomsport_team'
			|| get_post_type() == 'joomsport_player'
			|| get_post_type() == 'joomsport_match'
			|| get_post_type() == 'joomsport_person' )
		{
			$mode = 'joomsport';
		}
		return $mode;
	}
}



// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_joomsport_tgmpa_required_plugins' ) ) {
    function fcunited_joomsport_tgmpa_required_plugins( $list = array() ) {
        if ( fcunited_storage_isset( 'required_plugins', 'joomsport-sports-league-results-management' ) && fcunited_storage_get_array( 'required_plugins', 'joomsport-sports-league-results-management', 'install' ) !== false ) {
                $list[] = array(
                    'name'     => fcunited_storage_get_array( 'required_plugins', 'joomsport-sports-league-results-management', 'title' ),
                    'slug'     => 'joomsport-sports-league-results-management',
                    'required' => false,
                );
        }
        return $list;
    }
}

// Filter theme-supported plugins list
if ( ! function_exists( 'fcunited_joomsport_theme_plugins' ) ) {
    
    function fcunited_joomsport_theme_plugins( $list = array() ) {
        if ( ! empty( $list['joomsport']['group'] ) ) {
            foreach ( $list as $k => $v ) {
                if ( substr( $k, 0, 12 ) == 'joomsport-' ) {
                    if ( empty( $v['group'] ) ) {
                        $list[ $k ]['group'] = $list['joomsport']['group'];
                    }
                    if ( ! empty( $list['joomsport']['logo'] ) ) {
                        $list[ $k ]['logo'] = strpos( $list['joomsport']['logo'], '//' ) !== false
                            ? $list['joomsport']['logo']
                            : fcunited_get_file_url( "plugins/joomsport/{$list['joomsport']['logo']}" );
                    }
                }

            }
        }
        return $list;
    }
}



// Check if joomsport installed and activated
if ( ! function_exists( 'fcunited_exists_joomsport' ) ) {
    function fcunited_exists_joomsport() {
        return  function_exists( 'joomsport_activation_redirect' );
    }
}


// Enqueue WooCommerce custom styles
if ( ! function_exists( 'fcunited_joomsport_frontend_scripts' ) ) {
    function fcunited_joomsport_frontend_scripts() {
        if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
            $fcunited_url = fcunited_get_file_url( 'plugins/joomsport/joomsport.css' );
            if ( '' != $fcunited_url ) {
                wp_enqueue_style( 'fcunited-joomsport', $fcunited_url, array(), null );
            }
        }
    }
}

// Merge custom styles
if ( ! function_exists( 'fcunited_joomsport_merge_styles' ) ) {
    function fcunited_joomsport_merge_styles( $list ) {
        $list[] = 'plugins/joomsport/joomsport.css';
        return $list;
    }
}





