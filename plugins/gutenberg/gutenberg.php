<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'fcunited_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'fcunited_gutenberg_theme_setup9', 9 );
	function fcunited_gutenberg_theme_setup9() {

		// Add wide and full blocks support
		add_theme_support( 'align-wide' );

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if ( fcunited_exists_gutenberg() ) {
			if ( ! fcunited_get_theme_setting( 'gutenberg_add_context' ) ) {
				add_editor_style( fcunited_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ) );
			}
		} else {
			add_editor_style( fcunited_get_file_url( 'css/editor-style.css' ) );
		}

		if ( fcunited_exists_gutenberg() ) {
			add_action( 'wp_enqueue_scripts', 'fcunited_gutenberg_frontend_scripts', 1100 );
			add_action( 'wp_enqueue_scripts', 'fcunited_gutenberg_responsive_styles', 2000 );
			add_filter( 'fcunited_filter_merge_styles', 'fcunited_gutenberg_merge_styles' );
			add_filter( 'fcunited_filter_merge_styles_responsive', 'fcunited_gutenberg_merge_styles_responsive' );
		}
		add_action( 'enqueue_block_editor_assets', 'fcunited_gutenberg_editor_scripts' );
		add_filter( 'fcunited_filter_localize_script_admin',	'fcunited_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'fcunited_gutenberg_add_editor_colors' );
		if ( is_admin() ) {
			add_filter( 'fcunited_filter_tgmpa_required_plugins', 'fcunited_gutenberg_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'fcunited_gutenberg_tgmpa_required_plugins' ) ) {
	
	function fcunited_gutenberg_tgmpa_required_plugins( $list = array() ) {
		if ( fcunited_storage_isset( 'required_plugins', 'gutenberg' ) && fcunited_storage_get_array( 'required_plugins', 'gutenberg', 'install' ) !== false ) {
			if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
				$list[] = array(
					'name'     => fcunited_storage_get_array( 'required_plugins', 'gutenberg', 'title' ),
					'slug'     => 'gutenberg',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if Gutenberg is installed and activated
if ( ! function_exists( 'fcunited_exists_gutenberg' ) ) {
	function fcunited_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'fcunited_gutenberg_is_preview' ) ) {
	function fcunited_gutenberg_is_preview() {
		return fcunited_exists_gutenberg() 
				&& (
					fcunited_gutenberg_is_block_render_action()
					||
					fcunited_is_post_edit()
					);
	}
}

// Return true if current mode is "Block render"
if ( ! function_exists( 'fcunited_gutenberg_is_block_render_action' ) ) {
	function fcunited_gutenberg_is_block_render_action() {
		return fcunited_exists_gutenberg() 
				&& fcunited_check_url( 'block-renderer' ) && ! empty( $_GET['context'] ) && 'edit' == $_GET['context'];
	}
}

// Return true if content built with "Gutenberg"
if ( ! function_exists( 'fcunited_gutenberg_is_content_built' ) ) {
	function fcunited_gutenberg_is_content_built($content) {
		return fcunited_exists_gutenberg() 
				&& has_blocks( $content );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'fcunited_gutenberg_frontend_scripts' ) ) {
	
	function fcunited_gutenberg_frontend_scripts() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/gutenberg/gutenberg.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-gutenberg', $fcunited_url, array(), null );
			}
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'fcunited_gutenberg_responsive_styles' ) ) {
	
	function fcunited_gutenberg_responsive_styles() {
		if ( fcunited_is_on( fcunited_get_theme_option( 'debug_mode' ) ) ) {
			$fcunited_url = fcunited_get_file_url( 'plugins/gutenberg/gutenberg-responsive.css' );
			if ( '' != $fcunited_url ) {
				wp_enqueue_style( 'fcunited-gutenberg-responsive', $fcunited_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'fcunited_gutenberg_merge_styles' ) ) {
	
	function fcunited_gutenberg_merge_styles( $list ) {
		$list[] = 'plugins/gutenberg/gutenberg.css';
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'fcunited_gutenberg_merge_styles_responsive' ) ) {
	
	function fcunited_gutenberg_merge_styles_responsive( $list ) {
		$list[] = 'plugins/gutenberg/gutenberg-responsive.css';
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'fcunited_gutenberg_editor_scripts' ) ) {
	
	function fcunited_gutenberg_editor_scripts() {
		fcunited_admin_scripts(true);
		fcunited_admin_localize_scripts();
		// Editor styles
		if ( fcunited_get_theme_setting( 'gutenberg_add_context' ) ) {
			wp_enqueue_style( 'fcunited-gutenberg-preview', fcunited_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ), array(), null );
		}
		// Editor scripts
		wp_enqueue_script( 'fcunited-gutenberg-preview', fcunited_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );
	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'fcunited_gutenberg_localize_script' ) ) {
	
	function fcunited_gutenberg_localize_script( $arr ) {
		// Color scheme
		$arr['color_scheme'] = fcunited_get_theme_option( 'color_scheme' );
		// Sidebar position on the single posts
		$arr['sidebar_position'] = 'inherit';
		$arr['expand_content'] = 'inherit';
		$post_type = 'post';
		if ( fcunited_gutenberg_is_preview() && ! empty( $_GET['post'] ) ) {
			$post_type = fcunited_get_edited_post_type();
			$meta = get_post_meta( $_GET['post'], 'fcunited_options', true );
			if ( 'page' != $post_type && ! empty( $meta['sidebar_position_single'] ) ) {
				$arr['sidebar_position'] = $meta['sidebar_position_single'];
			} elseif ( 'page' == $post_type && ! empty( $meta['sidebar_position'] ) ) {
				$arr['sidebar_position'] = $meta['sidebar_position'];
			}
			if ( isset( $meta['expand_content'] ) ) {
				$arr['expand_content'] = $meta['expand_content'];
			}
		}
		if ( 'inherit' == $arr['sidebar_position'] ) {
			if ( 'page' != $post_type ) {
				$arr['sidebar_position'] = fcunited_get_theme_option( 'sidebar_position_single' );
				if ( 'inherit' == $arr['sidebar_position'] ) {
					$arr['sidebar_position'] = fcunited_get_theme_option( 'sidebar_position_blog' );
				}
			}
			if ( 'inherit' == $arr['sidebar_position'] ) {
				$arr['sidebar_position'] = fcunited_get_theme_option( 'sidebar_position' );
			}
		}
		if ( 'inherit' == $arr['expand_content'] ) {
			$arr['expand_content'] = fcunited_get_theme_option( 'expand_content_single' );
			if ( 'inherit' == $arr['expand_content'] && 'post' == $post_type ) {
				$arr['expand_content'] = fcunited_get_theme_option( 'expand_content_blog' );
			}
			if ( 'inherit' == $arr['expand_content'] ) {
				$arr['expand_content'] = fcunited_get_theme_option( 'expand_content' );
			}
		}
		$arr['expand_content'] = (int) $arr['expand_content'];
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'fcunited_gutenberg_save_css' ) ) {
	add_action( 'fcunited_action_save_options', 'fcunited_gutenberg_save_css', 30 );
	add_action( 'trx_addons_action_save_options', 'fcunited_gutenberg_save_css', 30 );
	function fcunited_gutenberg_save_css() {

		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'fcunited' )
				. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = fcunited_fgc( fcunited_get_file_dir( 'style.css' ) );

		// Append supported plugins styles
		$css .= fcunited_fgc( fcunited_get_file_dir( 'css/__plugins.css' ) );

		// Append theme-vars styles
		$css .= fcunited_customizer_get_css(
			array(
				'colors' => fcunited_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);
		
		// Append color schemes
		if ( fcunited_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = fcunited_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				foreach ( $schemes as $scheme => $data ) {
					$css .= fcunited_customizer_get_css(
						array(
							'fonts'  => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
				}
			}
		}

		// Append responsive styles
		$css .= fcunited_fgc( fcunited_get_file_dir( 'css/__responsive.css' ) );

		// Add context class to each selector
		if ( fcunited_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css = trx_addons_css_add_context(
						$css,
						array(
							'context' => '.edit-post-visual-editor ',
							'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
							)
					);
		} else {
			$css = apply_filters( 'fcunited_filter_prepare_css', $css );
		}

		// Save styles to the file
		fcunited_fpc( fcunited_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css );
	}
}


// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'fcunited_gutenberg_add_editor_colors' ) ) {
	//Hamdler of the add_action( 'after_setup_theme', 'fcunited_gutenberg_add_editor_colors' );
	function fcunited_gutenberg_add_editor_colors() {
		$scheme = fcunited_get_scheme_colors();
		$groups = fcunited_storage_get( 'scheme_color_groups' );
		$names  = fcunited_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? $n : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if ( fcunited_exists_gutenberg() ) {
	require_once FCUNITED_THEME_DIR . 'plugins/gutenberg/gutenberg-styles.php';
}
