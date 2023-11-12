<?php
/* Tribe Events Calendar support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if ( ! function_exists( 'fcunited_tribe_events_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'fcunited_tribe_events_theme_setup1', 1 );
	function fcunited_tribe_events_theme_setup1() {
		add_filter( 'fcunited_filter_list_sidebars', 'fcunited_tribe_events_list_sidebars' );
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'fcunited_tribe_events_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'fcunited_tribe_events_theme_setup3', 3 );
	function fcunited_tribe_events_theme_setup3() {
		if ( fcunited_exists_tribe_events() ) {

			// Section 'Tribe Events'
			fcunited_storage_merge_array(
				'options', '', array_merge(
					array(
						'events' => array(
							'title' => esc_html__( 'Events', 'fcunited' ),
							'desc'  => wp_kses_data( __( 'Select parameters to display the events pages', 'fcunited' ) ),
							'type'  => 'section',
						),
					),
					fcunited_options_get_list_cpt_options( 'events' )
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_tribe_events_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_tribe_events_theme_setup9', 9 );
	function fcunited_tribe_events_theme_setup9() {
		if ( fcunited_exists_tribe_events() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_tribe_events_frontend_scripts', 1100 );
			add_action( 'wp_enqueue_scripts', 'fcunited_tribe_events_responsive_styles', 2000 );
			add_filter( 'fcunited_filter_merge_styles', 'fcunited_tribe_events_merge_styles' );
			add_filter( 'fcunited_filter_merge_styles_responsive', 'fcunited_tribe_events_merge_styles_responsive' );
			add_filter( 'fcunited_filter_post_type_taxonomy', 'fcunited_tribe_events_post_type_taxonomy', 10, 2 );
			if ( ! is_admin() ) {
				add_filter( 'fcunited_filter_detect_blog_mode', 'fcunited_tribe_events_detect_blog_mode' );
				add_filter( 'fcunited_filter_get_post_categories', 'fcunited_tribe_events_get_post_categories' );
				add_filter( 'fcunited_filter_get_post_date', 'fcunited_tribe_events_get_post_date' );
			}
		}
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_tribe_events_tgmpa_required_plugins' );
		}

	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_tribe_events_tgmpa_required_plugins' ) ) {
	
	function fcunited_tribe_events_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'the-events-calendar' ) && fcunited_storage_get_array( 'required_plugins', 'the-events-calendar', 'install' ) !== false ) {
			$list[] = array(
				'name'     => fcunited_storage_get_array( 'required_plugins', 'the-events-calendar', 'title' ),
				'slug'     => 'the-events-calendar',
				'required' => false,
			);
		}
		return $list;
	}
}


// Remove 'Tribe Events' section from Customizer
if ( ! function_exists( 'fcunited_tribe_events_customizer_register_controls' ) ) {
	add_action( 'customize_register', 'fcunited_tribe_events_customizer_register_controls', 100 );
	function fcunited_tribe_events_customizer_register_controls( $wp_customize ) {
		$wp_customize->remove_panel( 'tribe_customizer' );
	}
}


// Check if Tribe Events is installed and activated
if ( ! function_exists( 'fcunited_exists_tribe_events' ) ) {
	function fcunited_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}

// Return true, if current page is any tribe_events page
if ( ! function_exists( 'fcunited_is_tribe_events_page' ) ) {
	function fcunited_is_tribe_events_page() {
		$rez = false;
		if ( fcunited_exists_tribe_events() ) {
			if ( ! is_search() ) {
				$rez = tribe_is_event() || tribe_is_event_query() || tribe_is_event_category() || tribe_is_event_venue() || tribe_is_event_organizer();
			}
		}
		return $rez;
	}
}

// Detect current blog mode
if ( ! function_exists( 'fcunited_tribe_events_detect_blog_mode' ) ) {
	
	function fcunited_tribe_events_detect_blog_mode( $mode = '' ) {
		if ( fcunited_is_tribe_events_page() ) {
			$mode = 'events';
		}
		return $mode;
	}
}

// Return taxonomy for current post type
if ( ! function_exists( 'fcunited_tribe_events_post_type_taxonomy' ) ) {
	
	function fcunited_tribe_events_post_type_taxonomy( $tax = '', $post_type = '' ) {
		if ( fcunited_exists_tribe_events() && Tribe__Events__Main::POSTTYPE == $post_type ) {
			$tax = Tribe__Events__Main::TAXONOMY;
		}
		return $tax;
	}
}

// Show categories of the current event
if ( ! function_exists( 'fcunited_tribe_events_get_post_categories' ) ) {
	
	function fcunited_tribe_events_get_post_categories( $cats = '' ) {
		if ( get_post_type() == Tribe__Events__Main::POSTTYPE ) {
			$cats = fcunited_get_post_terms( ', ', get_the_ID(), Tribe__Events__Main::TAXONOMY );
		}
		return $cats;
	}
}

// Return date of the current event
if ( ! function_exists( 'fcunited_tribe_events_get_post_date' ) ) {
	
	function fcunited_tribe_events_get_post_date( $dt = '' ) {
		if ( get_post_type() == Tribe__Events__Main::POSTTYPE ) {
			$dt = tribe_events_event_schedule_details( get_the_ID(), '', '' );
		}
		return $dt;
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'fcunited_tribe_events_frontend_scripts' ) ) {
	
	function fcunited_tribe_events_frontend_scripts() {
		if ( fcunited_is_tribe_events_page() ) {
			if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
				$fcunited_url = fcunited_get_file_url( 'plugins/the-events-calendar/the-events-calendar.css' );
				if ( '' != $fcunited_url ) {
					wp_enqueue_style( 'fcunited-tribe-events', $fcunited_url, array(), null );
				}
			}
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'fcunited_tribe_events_responsive_styles' ) ) {
	
	function fcunited_tribe_events_responsive_styles() {
		if ( fcunited_is_tribe_events_page() ) {
			if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
				$fcunited_url = fcunited_get_file_url( 'plugins/the-events-calendar/the-events-calendar-responsive.css' );
				if ( '' != $fcunited_url ) {
					wp_enqueue_style( 'fcunited-tribe-events-responsive', $fcunited_url, array(), null );
				}
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'fcunited_tribe_events_merge_styles' ) ) {
	
	function fcunited_tribe_events_merge_styles( $list ) {
		$list[] = 'plugins/the-events-calendar/the-events-calendar.css';
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'fcunited_tribe_events_merge_styles_responsive' ) ) {
	
	function fcunited_tribe_events_merge_styles_responsive( $list ) {
		$list[] = 'plugins/the-events-calendar/the-events-calendar-responsive.css';
		return $list;
	}
}



// Add Tribe Events specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( ! function_exists( 'fcunited_tribe_events_list_sidebars' ) ) {
	
	function fcunited_tribe_events_list_sidebars( $list = array() ) {
		$list['tribe_events_widgets'] = array(
			'name'        => esc_html__( 'Tribe Events Widgets', 'fcunited' ),
			'description' => esc_html__( 'Widgets to be shown on the Tribe Events pages', 'fcunited' ),
		);
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( fcunited_exists_tribe_events() ) {
	require_once FCUNITED_THEME_DIR . 'plugins/the-events-calendar/the-events-calendar-styles.php'; 
}
