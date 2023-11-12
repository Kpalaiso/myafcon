<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */
if ( ! function_exists( 'fcunited_trx_addons_theme_specific_components' ) ) {
	add_filter( 'trx_addons_filter_components_editor', 'fcunited_trx_addons_theme_specific_components' );
	function fcunited_trx_addons_theme_specific_components( $enable = false ) {
		return FCUNITED_THEME_FREE
					? false     // Free version
					: false;     // Pro version or Developer mode
	}
}

if ( ! function_exists( 'fcunited_trx_addons_theme_specific_setup1' ) ) {
	add_action( 'after_setup_theme', 'fcunited_trx_addons_theme_specific_setup1', 1 );
	function fcunited_trx_addons_theme_specific_setup1() {
		if ( fcunited_exists_trx_addons() ) {
			add_filter( 'trx_addons_cv_enable', 'fcunited_trx_addons_cv_enable' );
			add_filter( 'trx_addons_demo_enable', 'fcunited_trx_addons_demo_enable' );
			add_filter( 'trx_addons_filter_edd_themes_market', 'fcunited_trx_addons_edd_themes_market_enable' );
			add_filter( 'trx_addons_api_list', 'fcunited_trx_addons_api_list' );
			add_filter( 'trx_addons_cpt_list', 'fcunited_trx_addons_cpt_list' );
			add_filter( 'trx_addons_sc_list', 'fcunited_trx_addons_sc_list' );
			add_filter( 'trx_addons_widgets_list', 'fcunited_trx_addons_widgets_list' );
		}
	}
}

if ( ! function_exists( 'fcunited_trx_addons_theme_specific_setup' ) ) {
	add_action( 'after_setup_theme', 'fcunited_trx_addons_theme_specific_setup' );
	function fcunited_trx_addons_theme_specific_setup() {
		if ( fcunited_exists_trx_addons() ) {
			if ( ! is_admin() ) {
				add_action( 'fcunited_action_before_post_meta', 'fcunited_trx_addons_action_before_post_meta' );
			}
		}
	}
}


// CV
if ( ! function_exists( 'fcunited_trx_addons_cv_enable' ) ) {
	
	function fcunited_trx_addons_cv_enable( $enable = false ) {
		// To do: return false if theme not use CV functionality
		return FCUNITED_THEME_FREE
					? false     // Free version
					: true;     // Pro version
	}
}

// Demo mode
if ( ! function_exists( 'fcunited_trx_addons_demo_enable' ) ) {
	
	function fcunited_trx_addons_demo_enable( $enable = false ) {
		// To do: return false if theme not use Demo functionality
		return FCUNITED_THEME_FREE
					? false     // Free version
					: true;     // Pro version
	}
}

// EDD Themes market
if ( ! function_exists( 'fcunited_trx_addons_edd_themes_market_enable' ) ) {
	
	function fcunited_trx_addons_edd_themes_market_enable( $enable = false ) {
		// To do: return false if theme not Themes market functionality
		return FCUNITED_THEME_FREE
					? false     // Free version
					: true;     // Pro version
	}
}


// API
if ( ! function_exists( 'fcunited_trx_addons_api_list' ) ) {
	
	function fcunited_trx_addons_api_list( $list = array() ) {
		// To do: Enable/Disable Third-party plugins API via add/remove it in the list


        $list[ 'sportspress' ] = array(
            'title' => esc_html__('SportsPress – Sports Club & League Manager', 'fcunited'),
            // Always enabled!!!
            'std' => 1,
            'hidden' => false
        );


		// If it's a free version - leave only basic set
		if ( FCUNITED_THEME_FREE ) {
			$free_api = array( 'elementor', 'instagram_feed', 'woocommerce', 'contact-form-7' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_api ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		return $list;
	}
}


// CPT
if ( ! function_exists( 'fcunited_trx_addons_cpt_list' ) ) {
	
	function fcunited_trx_addons_cpt_list( $list = array() ) {
		// To do: Enable/Disable CPT via add/remove it in the list

		// If it's a free version - leave only basic set
		if ( FCUNITED_THEME_FREE ) {
			$free_cpt = array( 'layouts', 'portfolio', 'post', 'services', 'team', 'testimonials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_cpt ) ) {
					unset( $list[ $k ] );
				}
			}
		}

        if(isset($list['team'])) {
            $list['team']['post_type_slug'] = 'manager';
        }

		return $list;
	}
}

// Shortcodes
if ( ! function_exists( 'fcunited_trx_addons_sc_list' ) ) {
	
	function fcunited_trx_addons_sc_list( $list = array() ) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php

		// If it's a free version - leave only basic set
		if ( FCUNITED_THEME_FREE ) {
			$free_shortcodes = array( 'action', 'anchor', 'blogger', 'button', 'form', 'icons', 'price', 'promo', 'socials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_shortcodes ) ) {
					unset( $list[ $k ] );
				}
			}
		}

        $list['blogger']['templates']['line']['default'] = array(
            'title' => esc_html__('Default', 'fcunited'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta'
                )
            )
        );

        $list['blogger']['templates']['default']['classic_meta'] = array(
            'title'  => esc_html__('Classic Grid (meta)', 'fcunited'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'meta', 'title', 'excerpt', 'readmore'
                )
            )
        );

        $list['blogger']['templates']['default']['classic_meta_simple'] = array(
            'title'  => esc_html__('Simple Grid (meta)', 'fcunited'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'meta', 'title'
                )
            )
        );

        $list['blogger']['templates']['default']['over_bottom_meta'] = array(
            'title'  => esc_html__('Info over image (top meta)', 'fcunited'),
            'layout' => array(
                'featured' => array(
                    'bc' => array(
                        'meta', 'title'
                    ),
                ),
            )
        );


		return $list;
	}
}

// Widgets
if ( ! function_exists( 'fcunited_trx_addons_widgets_list' ) ) {
	
	function fcunited_trx_addons_widgets_list( $list = array() ) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php

        $list['recent_news']['layouts_sc']['news-plain'] = esc_html__('Plain',	'fcunited');
        $list['recent_news']['layouts_sc']['news-line'] = esc_html__('Line',	'fcunited');

		// If it's a free version - leave only basic set
		if ( FCUNITED_THEME_FREE ) {
			$free_widgets = array( 'aboutme', 'banner', 'contacts', 'flickr', 'popular_posts', 'recent_posts', 'slider', 'socials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_widgets ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		return $list;
	}
}

// Add mobile menu to the plugin's cached menu list
if ( ! function_exists( 'fcunited_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'fcunited_trx_addons_menu_cache' );
	function fcunited_trx_addons_menu_cache( $list = array() ) {
		if ( in_array( '#menu_main', $list ) ) {
			$list[] = '#menu_mobile';
		}
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add theme-specific vars into localize array
if ( ! function_exists( 'fcunited_trx_addons_localize_script' ) ) {
	add_filter( 'fcunited_filter_localize_script', 'fcunited_trx_addons_localize_script' );
	function fcunited_trx_addons_localize_script( $arr ) {
		$arr['alter_link_color'] = fcunited_get_scheme_color( 'alter_link' );
		return $arr;
	}
}


// Shortcodes support
//------------------------------------------------------------------------

// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'fcunited_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'fcunited_trx_addons_sc_type', 10, 2 );
	function fcunited_trx_addons_sc_type( $list, $sc ) {
		// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
		if ( 'trx_sc_blogger' == $sc ) {
			$list = fcunited_array_merge( $list, fcunited_get_list_blog_styles( false, 'sc' ) );

		}

        if ( 'trx_sc_blogger' == $sc ) {
            $list['line'] = esc_html__('Line-up', 'fcunited');
        }
        if ( 'trx_sc_button' == $sc ) {
            $list['default circle'] = esc_html__('No title, circle', 'fcunited');
        }

		return $list;
	}
}

// Add params values to the shortcode's atts
if ( ! function_exists( 'fcunited_trx_addons_sc_prepare_atts' ) ) {
	add_filter( 'trx_addons_filter_sc_prepare_atts', 'fcunited_trx_addons_sc_prepare_atts', 10, 2 );
	function fcunited_trx_addons_sc_prepare_atts( $atts, $sc ) {
		if ( 'trx_sc_blogger' == $sc ) {
			$list = fcunited_get_list_blog_styles( false, 'sc' );
			if ( isset( $list[ $atts['type'] ] ) ) {
				$custom_type = '';
				if ( strpos( $atts['type'], 'blog-custom-' ) === 0 ) {
					$blog_id = fcunited_get_custom_blog_id( $atts['type'] );
					$blog_meta = fcunited_get_custom_layout_meta( $blog_id );
					$custom_type = ! empty( $blog_meta['scripts_required'] ) ? $blog_meta['scripts_required'] : 'custom';
				}
				// Classes for the container with posts
				$columns = $atts['columns'] > 0
								? $atts['columns']
								: ( 1 < $atts['count']
									? $atts['count']
									: ( -1 == $atts['count']
										? 3
										: 1
										)
									);
				$atts['posts_container'] = 'posts_container'
					. ' ' . esc_attr( $atts['type'] ) . '_wrap'
					. ( $columns > 1
							? ' ' . esc_attr( $atts['type'] ) . '_' . $columns 
							: '' )
					. ( in_array( $atts['type'], array( 'portfolio', 'gallery' ) )
							? ' masonry_wrap' . ( $columns > 1 ? ' masonry_' . $columns : '' )
							: '' )
					. ( 'gallery' == $atts['type']
							? ' portfolio_wrap' . ( $columns > 1 ? ' portfolio_' . $columns : '' )
							: '' )
					. ( in_array( $atts['type'], array( 'classic', 'excerpt' ) ) && $columns > 1
							? ' columns_wrap columns_padding_bottom' 
							: '' )
					. ( ! empty( $custom_type )
							? ( in_array( $custom_type, array( 'gallery', 'portfolio', 'masonry' ) )
								? ' ' . esc_attr( $custom_type ) . '_wrap' . ( $columns > 1 ? ' ' . esc_attr( $custom_type . '_' . $columns ) : '' )
								: ' columns_wrap columns_padding_bottom' )
							: '' )
					;
				// Scripts for masonry and portfolio
				if ( in_array( $atts['type'], array( 'gallery', 'portfolio', 'masonry' ) ) || in_array( $custom_type, array( 'gallery', 'portfolio', 'masonry' ) ) ) {
					fcunited_lazy_load_off();
					fcunited_load_masonry_scripts();
				}
			}
            $atts['slider_pagination_type'] = 'progressbar';



		}
		return $atts;
	}
}


// Add new params to the default shortcode's atts
if ( ! function_exists( 'fcunited_trx_addons_sc_atts' ) ) {
	add_filter( 'trx_addons_sc_atts', 'fcunited_trx_addons_sc_atts', 10, 2 );
	function fcunited_trx_addons_sc_atts( $atts, $sc ) {

		// Param 'scheme'
		if ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_layouts',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter',
				'trx_sc_layouts_container',
			)
		) ) {
			$atts['scheme'] = 'inherit';
		}
		// Param 'color_style'
		if ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_icons',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter'
			)
		) ) {
			$atts['color_style'] = 'default';
		}
		if ( in_array(
			$sc, array(
				'trx_sc_button',
			)
		) ) {
			if ( is_array( $atts['buttons'] ) ) {
				foreach( $atts['buttons'] as $k => $v ) {
					$atts['buttons'][ $k ]['color_style'] = 'default';
				}
			}
		}
		// Param 'hover'
		if ( 'trx_sc_blogger' == $sc ) {
			$atts['hover'] = 'inherit';
		}
		return $atts;
	}
}

// Add new params to the shortcodes VC map
if ( ! function_exists( 'fcunited_trx_addons_sc_map' ) ) {
	add_filter( 'trx_addons_sc_map', 'fcunited_trx_addons_sc_map', 10, 2 );
	function fcunited_trx_addons_sc_map( $params, $sc ) {

		// Param 'scheme'
		if ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_layouts',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter',
				'trx_sc_layouts_container',
			)
		) ) {
			if ( empty( $params['params'] ) || ! is_array( $params['params'] ) ) {
				$params['params'] = array();
			}
			$params['params'][] = array(
				'param_name'  => 'scheme',
				'heading'     => esc_html__( 'Color scheme', 'fcunited' ),
				'description' => wp_kses_data( __( 'Select color scheme to decorate this block', 'fcunited' ) ),
				'group'       => esc_html__( 'Colors', 'fcunited' ),
				'admin_label' => true,
				'value'       => array_flip( fcunited_get_list_schemes( true ) ),
				'type'        => 'dropdown',
			);
		}
		// Param 'color_style'
		$param = array(
			'param_name'       => 'color_style',
			'heading'          => esc_html__( 'Color style', 'fcunited' ),
			'description'      => wp_kses_data( __( 'Select color style to decorate this block', 'fcunited' ) ),
			'edit_field_class' => 'vc_col-sm-4',
			'admin_label'      => true,
			'value'            => array_flip( fcunited_get_list_sc_color_styles() ),
			'type'             => 'dropdown',
		);
		if ( in_array( $sc, array( 'trx_sc_button' ) ) ) {
			if ( empty( $params['params'] ) || ! is_array( $params['params'] ) ) {
				$params['params'] = array();
			}
			foreach ( $params['params'] as $k => $p ) {
				if ( 'buttons' == $p['param_name'] ) {
					if ( ! empty( $p['params'] ) ) {
						$new_params = array();
						foreach ( $p['params'] as $v ) {
							$new_params[] = $v;
							if ( 'size' == $v['param_name'] ) {
								$new_params[] = $param;
							}
						}
						$params['params'][ $k ]['params'] = $new_params;
					}
				}
			}
		} elseif ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_icons',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter',
			)
		) ) {
			if ( empty( $params['params'] ) || ! is_array( $params['params'] ) ) {
				$params['params'] = array();
			}
			$new_params = array();
			foreach ( $params['params'] as $v ) {
				if ( in_array( $v['param_name'], array( 'title_style', 'title_tag', 'title_align' ) ) ) {
					$v['edit_field_class'] = 'vc_col-sm-6';
				}
				$new_params[] = $v;
				if ( 'title_align' == $v['param_name'] ) {
					if ( ! empty( $v['group'] ) ) {
						$param['group'] = $v['group'];
					}
					$param['edit_field_class'] = 'vc_col-sm-6';
					$new_params[]              = $param;
				}
			}
			$params['params'] = $new_params;
		}
		// Param 'hover'
		if ( 'trx_sc_blogger' == $sc ) {
			if ( empty( $params['params'] ) || ! is_array( $params['params'] ) ) {
				$params['params'] = array();
			}
			$styles = fcunited_storage_get( 'blog_styles' );
			unset( $styles['gallery'] );  // On gallery hover is 'icon' always
			$param      = array(
				'param_name'       => 'hover',
				'heading'          => esc_html__( 'Image hover', 'fcunited' ),
				'description'      => wp_kses_data( __( 'Select hover effect for the featured image', 'fcunited' ) ),
				'edit_field_class' => 'vc_col-sm-4',
				'value'            => array_flip( fcunited_get_list_hovers( true ) ),
				'dependency'       => array(
					'element' => 'type',
					'value'   => array_keys( $styles ),
				),
				'type'             => 'dropdown',
			);
			$new_params = array();
			foreach ( $params['params'] as $v ) {
				$new_params[] = $v;
				if ( 'more_text' == $v['param_name'] ) {
					$new_params[] = $param;
				}
			}
			$params['params'] = $new_params;
		}
		return $params;
	}
}



// Add classes to the shortcode's output from new params
if ( ! function_exists( 'fcunited_trx_addons_sc_output' ) ) {
	add_filter( 'trx_addons_sc_output', 'fcunited_trx_addons_sc_output', 10, 4 );
	function fcunited_trx_addons_sc_output( $output, $sc, $atts, $content ) {

		if ( in_array( $sc, array( 'trx_sc_action' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_action ', 'class="sc_action scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_action ', 'class="sc_action color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_blogger' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_blogger ', 'class="sc_blogger scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_blogger ', 'class="sc_blogger color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_cars' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_cars ', 'class="sc_cars scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_cars ', 'class="sc_cars color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_courses' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_courses ', 'class="sc_courses scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_courses ', 'class="sc_courses color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_content' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_content ', 'class="sc_content scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_content ', 'class="sc_content color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_dishes' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_dishes ', 'class="sc_dishes scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_dishes ', 'class="sc_dishes color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_events' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_events ', 'class="sc_events scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_events ', 'class="sc_events color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_form' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_form ', 'class="sc_form scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_form ', 'class="sc_form color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_icons' ) ) ) {
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_icons ', 'class="sc_icons color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_googlemap' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_googlemap_content', 'class="sc_googlemap_content scheme_' . esc_attr( $atts['scheme'] ), $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_googlemap_content ', 'class="sc_googlemap_content color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_yandexmap' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_yandexmap_content', 'class="sc_yandexmap_content scheme_' . esc_attr( $atts['scheme'] ), $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_yandexmap_content ', 'class="sc_yandexmap_content color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_layouts' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_layouts ', 'class="sc_layouts scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_portfolio' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_portfolio ', 'class="sc_portfolio scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_portfolio ', 'class="sc_portfolio color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_price' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_price ', 'class="sc_price scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_price ', 'class="sc_price color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_promo' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_promo ', 'class="sc_promo scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_promo ', 'class="sc_promo color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_properties' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_properties ', 'class="sc_properties scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_properties ', 'class="sc_properties color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_services' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_services ', 'class="sc_services scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_services ', 'class="sc_services color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_team' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_team ', 'class="sc_team scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_team ', 'class="sc_team color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_testimonials' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_testimonials ', 'class="sc_testimonials scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_testimonials ', 'class="sc_testimonials color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_title' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'class="sc_title ', 'class="sc_title scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_title ', 'class="sc_title color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_widget_audio' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'sc_widget_audio', 'sc_widget_audio scheme_' . esc_attr( $atts['scheme'] ), $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_widget_audio ', 'class="sc_widget_audio color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_widget_twitter' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'sc_widget_twitter', 'sc_widget_twitter scheme_' . esc_attr( $atts['scheme'] ), $output );
			}
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="sc_widget_twitter ', 'class="sc_widget_twitter color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}
		} elseif ( in_array( $sc, array( 'trx_sc_layouts_container' ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! fcunited_is_inherit( $atts['scheme'] ) ) {
				$output = str_replace( 'sc_layouts_container', 'sc_layouts_container scheme_' . esc_attr( $atts['scheme'] ), $output );
			}
		}
		return $output;
	}
}

// Add color_style to the button items
if ( ! function_exists( 'fcunited_trx_addons_sc_item_link_classes' ) ) {
	add_filter( 'trx_addons_filter_sc_item_link_classes', 'fcunited_trx_addons_sc_item_link_classes', 10, 3 );
	function fcunited_trx_addons_sc_item_link_classes( $class, $sc, $atts=array() ) {
		if ( 'sc_button' == $sc ) {
			if ( ! empty( $atts['color_style'] ) && ! fcunited_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$class .= ' color_style_' . esc_attr( $atts['color_style'] );
			}
		}
		return $class;
	}
}



// Return tag for the item's title
if ( ! function_exists( 'fcunited_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'fcunited_trx_addons_sc_item_title_tag' );
	function fcunited_trx_addons_sc_item_title_tag( $tag = '' ) {
		return 'h1' == $tag ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( ! function_exists( 'fcunited_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'fcunited_trx_addons_sc_item_button_args', 10, 3 );
	function fcunited_trx_addons_sc_item_button_args( $args, $sc, $sc_args ) {
		if ( ! empty( $sc_args['color_style'] ) ) {
			$args['color_style'] = $sc_args['color_style'];
		}
		return $args;
	}
}

// Return theme specific title layout for the slider
if ( ! function_exists( 'fcunited_trx_addons_slider_title' ) ) {
	add_filter( 'trx_addons_filter_slider_title', 'fcunited_trx_addons_slider_title', 10, 2 );
	function fcunited_trx_addons_slider_title( $title, $data ) {
		$title = '';
		if ( ! empty( $data['title'] ) ) {
			$title .= '<h3 class="slide_title">'
						. ( ! empty( $data['link'] ) ? '<a href="' . esc_url( $data['link'] ) . '">' : '' )
						. esc_html( $data['title'] )
						. ( ! empty( $data['link'] ) ? '</a>' : '' )
						. '</h3>';
		}
		if ( ! empty( $data['cats'] ) ) {
			$title .= sprintf( '<div class="slide_cats">%s</div>', $data['cats'] );
		}
		return $title;
	}
}

// Add new styles to the Google map
if ( ! function_exists( 'fcunited_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles', 'fcunited_trx_addons_sc_googlemap_styles' );
	function fcunited_trx_addons_sc_googlemap_styles( $list ) {
		$list['dark'] = esc_html__( 'Dark', 'fcunited' );
		return $list;
	}
}

// Show reactions in the single posts
if ( ! function_exists( 'fcunited_trx_addons_action_before_post_meta' ) ) {
	
	function fcunited_trx_addons_action_before_post_meta() {
		if ( fcunited_exists_trx_addons() ) {
			if ( is_single() && ! is_attachment() && ! trx_addons_sc_stack_check() ) {
				// Emotions
				if ( trx_addons_is_on( trx_addons_get_option( 'emotions_allowed' ) ) ) {
					trx_addons_get_post_reactions( true );
				}
			}
		}
	}
}

// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( ! function_exists( 'fcunited_trx_addons_tiny_mce_style_formats' ) ) {
	add_filter( 'trx_addons_filter_tiny_mce_style_formats', 'fcunited_trx_addons_tiny_mce_style_formats' );
	function fcunited_trx_addons_tiny_mce_style_formats( $style_formats ) {
		// Add style 'Arrow' to the 'List styles'
		// Remove 'false &&' from the condition below to add new style to the list
		if ( false && is_array( $style_formats ) && count( $style_formats ) > 0 ) {
			foreach ( $style_formats as $k => $v ) {
				if ( esc_html__( 'List styles', 'fcunited' ) == $v['title'] ) {
					$style_formats[ $k ]['items'][] = array(
						'title'    => esc_html__( 'Arrow', 'fcunited' ),
						'selector' => 'ul',
						'classes'  => 'trx_addons_list trx_addons_list_arrow',
					);
				}
			}
		}
		return $style_formats;
	}
}


// Setup team and portflio pages
//------------------------------------------------------------------------

// Disable override header image on team and portfolio pages
if ( ! function_exists( 'fcunited_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'fcunited_filter_allow_override_header_image', 'fcunited_trx_addons_allow_override_header_image' );
	function fcunited_trx_addons_allow_override_header_image( $allow ) {
		return is_single()
				&& (
					fcunited_is_team_page()
					|| fcunited_is_cars_page()
					|| fcunited_is_cars_agents_page()
					|| fcunited_is_properties_agents_page()
					)
				? false
				: $allow;
	}
}

// Get thumb size for the team items
if ( ! function_exists( 'fcunited_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size', 'fcunited_trx_addons_thumb_size', 10, 2 );
	function fcunited_trx_addons_thumb_size( $thumb_size = '', $type = '' ) {
		      //Uncomment next lines to change team members images (default is 'avatar')
		      if ($type == 'team-short')
		          $thumb_size = fcunited_get_thumb_size('alternate');
		return $thumb_size;
	}
}

// Add fields to the override options for the team members
// All other CPT override options may be modified in the same method
if ( ! function_exists( 'fcunited_trx_addons_override_options_fields' ) ) {
	add_filter( 'trx_addons_filter_meta_box_fields', 'fcunited_trx_addons_override_options_fields', 10, 2 );
	function fcunited_trx_addons_override_options_fields( $mb, $post_type ) {
		if ( defined( 'TRX_ADDONS_CPT_TEAM_PT' ) && TRX_ADDONS_CPT_TEAM_PT == $post_type ) {
			if ( ! isset( $mb['email'] ) ) {
				$mb['email'] = array(
					'title'   => esc_html__( 'E-mail', 'fcunited' ),
					'desc'    => wp_kses_data( __( "Team member's email", 'fcunited' ) ),
					'std'     => '',
					'details' => true,
					'type'    => 'text',
				);
			}
		}
		return $mb;
	}
}


if ( ! function_exists( 'fcunited_filter_get_list_menu_hover' ) ) {
    add_filter( 'trx_addons_filter_get_list_menu_hover', 'fcunited_filter_get_list_menu_hover' );
    function fcunited_filter_get_list_menu_hover( $list ) {
        unset( $list['fade_box'] );
        unset( $list['slide_line'] );
        unset( $list['slide_box'] );
        unset( $list['zoom_line'] );
        unset( $list['path_line'] );
        unset( $list['roll_down'] );
        unset( $list['color_line'] );
        return $list;
    }
}

if ( ! function_exists( 'fcunited_filter_get_list_input_hover' ) ) {
    add_filter( 'trx_addons_filter_get_list_input_hover', 'fcunited_filter_get_list_input_hover' );
    function fcunited_filter_get_list_input_hover( $list ) {
        unset( $list['accent'] );
        unset( $list['path'] );
        unset( $list['jump'] );
        unset( $list['underline'] );
        unset( $list['iconed'] );
        return $list;
    }
}
