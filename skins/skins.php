<?php
/**
 * Skins support
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.46
 */

if ( ! defined( 'FCUNITED_SKIN_NAME' ) ) {
	define( 'FCUNITED_SKIN_NAME', get_option( sprintf( 'theme_skin_%s', get_option( 'stylesheet' ) ), FCUNITED_DEFAULT_SKIN ) );
}
if ( ! defined( 'FCUNITED_SKIN_DIR' ) ) {
	define( 'FCUNITED_SKIN_DIR', 'skins/' . trailingslashit( FCUNITED_SKIN_NAME ) );
}

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
if ( ! function_exists( 'fcunited_skins_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'fcunited_skins_theme_setup1', 1 );
	function fcunited_skins_theme_setup1() {
		fcunited_storage_set( 'skins', apply_filters( 'fcunited_filter_skins_list', array() ) );
    }
}


// Retrieve available skins from the demo-server every 24 hours
if ( ! function_exists( 'fcunited_skins_get_available_skins' ) ) {
    add_filter( 'fcunited_filter_skins_list', 'fcunited_skins_get_available_skins' );
    function fcunited_skins_get_available_skins( $skins = array() ) {
        $skins_file      = fcunited_get_file_dir( 'skins/skins.json' );
        $skins_installed = json_decode( fcunited_fgc( $skins_file ), true );
        $skins           = get_transient( 'fcunited_list_skins' );
        if ( ! is_array( $skins ) || count( $skins ) == 0 ) {
            $skins = fcunited_retrieve_json( trailingslashit( fcunited_storage_get( 'theme_upgrade_url' ) ) . 'skins/fcunited/skins.json' );
            if ( ! is_array( $skins ) || count( $skins ) == 0 ) {
                $skins = $skins_installed;
        }
            set_transient( 'fcunited_list_skins', $skins, 24 * 60 * 60 );       // Store to the cache for 24 hours
        }

        // Check if new skins appears
        if ( is_array( $skins_installed ) && count( $skins_installed ) > 0 ) {
            foreach( $skins_installed as $k => $v ) {
                if ( ! isset( $skins[ $k ] ) ) {
                    $skins[ $k ] = $v;
                }
            }
        }

        // Check state of each skin
        if ( is_array( $skins ) && count( $skins ) > 0 ) {
            foreach( $skins as $k => $v ) {
                if ( ! isset( $skins[ $k ]) ) {
                    $skins[ $k ] = $skins_installed[ $k ];
                }
                $skins[ $k ][ 'installed' ] = fcunited_skins_get_file_dir( "skin.php", $k ) != '' && ! empty( $skins_installed[ $k ][ 'version' ] )
                    ? $skins_installed[ $k ][ 'version' ]
                    : '';
            }
        }
        return $skins;
	}
}




// Add skins folder to the theme-specific file search
//------------------------------------------------------------

// Check if file exists in the skin folder and return its path or empty string if file is not found
if ( ! function_exists( 'fcunited_skins_get_file_dir' ) ) {
	function fcunited_skins_get_file_dir( $file, $skin = FCUNITED_SKIN_NAME, $return_url = false ) {
		if ( strpos( $file, '//' ) !== false ) {
			$dir = $file;
		} else {
		$dir      = '';
		if ( FCUNITED_ALLOW_SKINS ) {
			$skin_dir = 'skins/' . trailingslashit( $skin );
			if ( FCUNITED_CHILD_DIR != FCUNITED_THEME_DIR && file_exists( FCUNITED_CHILD_DIR . ( $skin_dir ) . ( $file ) ) ) {
				$dir = ( $return_url ? FCUNITED_CHILD_URL : FCUNITED_CHILD_DIR ) . ( $skin_dir ) . fcunited_check_min_file( $file, FCUNITED_CHILD_DIR . ( $skin_dir ) );
			} elseif ( file_exists( FCUNITED_THEME_DIR . ( $skin_dir ) . ( $file ) ) ) {
				$dir = ( $return_url ? FCUNITED_THEME_URL : FCUNITED_THEME_DIR ) . ( $skin_dir ) . fcunited_check_min_file( $file, FCUNITED_THEME_DIR . ( $skin_dir ) );
			}
		}
             }
	    return $dir;
	}
}

// Check if file exists in the skin folder and return its url or empty string if file is not found
if ( ! function_exists( 'fcunited_skins_get_file_url' ) ) {
	function fcunited_skins_get_file_url( $file, $skin = FCUNITED_SKIN_NAME ) {
		return fcunited_skins_get_file_dir( $file, $skin, true );
	}
}


// Add skins folder to the theme-specific files search
if ( ! function_exists( 'fcunited_skins_get_theme_file_dir' ) ) {
	add_filter( 'fcunited_filter_get_theme_file_dir', 'fcunited_skins_get_theme_file_dir', 10, 3 );
	function fcunited_skins_get_theme_file_dir( $dir, $file, $return_url = false ) {
		return fcunited_skins_get_file_dir( $file, FCUNITED_SKIN_NAME, $return_url );
	}
}


// Check if folder exists in the current skin folder and return its path or empty string if the folder is not found
if ( ! function_exists( 'fcunited_skins_get_folder_dir' ) ) {
	function fcunited_skins_get_theme_folder_dir( $folder, $skin = FCUNITED_SKIN_NAME, $return_url = false ) {
		$dir      = '';
		if ( FCUNITED_ALLOW_SKINS ) {
			$skin_dir = 'skins/' . trailingslashit( $skin );
			if ( FCUNITED_CHILD_DIR != FCUNITED_THEME_DIR && is_dir( FCUNITED_CHILD_DIR . ( $skin_dir ) . ( $folder ) ) ) {
				$dir = ( $return_url ? FCUNITED_CHILD_URL : FCUNITED_CHILD_DIR ) . ( $skin_dir ) . ( $folder );
			} elseif ( is_dir( FCUNITED_THEME_DIR . ( $skin_dir ) . ( $folder ) ) ) {
				$dir = ( $return_url ? FCUNITED_THEME_URL : FCUNITED_THEME_DIR ) . ( $skin_dir ) . ( $folder );
			}
		}
		return $dir;
	}
}

// Check if folder exists in the skin folder and return its url or empty string if folder is not found
if ( ! function_exists( 'fcunited_skins_get_folder_url' ) ) {
	function fcunited_skins_get_folder_url( $folder, $skin = FCUNITED_SKIN_NAME ) {
		return fcunited_skins_get_folder_dir( $folder, $skin, true );
	}
}

// Add skins folder to the theme-specific folders search
if ( ! function_exists( 'fcunited_skins_get_theme_folder_dir' ) ) {
	add_filter( 'fcunited_filter_get_theme_folder_dir', 'fcunited_skins_get_theme_folder_dir', 10, 3 );
	function fcunited_skins_get_theme_folder_dir( $dir, $folder, $return_url = false ) {
		return fcunited_skins_get_folder_dir( $folder, FCUNITED_SKIN_NAME, $return_url );
	}
}


// Add skins folder to the get_template_part
if ( ! function_exists( 'fcunited_skins_get_template_part' ) ) {
	add_filter( 'fcunited_filter_get_template_part', 'fcunited_skins_get_template_part', 10, 2 );
	function fcunited_skins_get_template_part( $slug, $part = '' ) {
		if ( ! empty( $part ) ) {
			$part = "-{$part}";
		}
		if ( fcunited_skins_get_file_dir( "{$slug}{$part}.php" ) != '' ) {
			$slug = sprintf( 'skins/%s/%s', FCUNITED_SKIN_NAME, $slug );
		}
		return $slug;
	}
}



// Add tab with skins to the 'Theme Panel'
//------------------------------------------------------

// Add step 'Skins'
if ( ! function_exists( 'fcunited_skins_theme_panel_steps' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_steps', 'fcunited_skins_theme_panel_steps' );
	function fcunited_skins_theme_panel_steps( $steps ) {
		if ( FCUNITED_ALLOW_SKINS ) {
			$steps = fcunited_array_merge( array( 'skins' => wp_kses_data( __( 'Select a skin for your website.', 'fcunited' ) ) ), $steps );
		}
		return $steps;
	}
}

// Add tab link 'Skins'
if ( ! function_exists( 'fcunited_skins_theme_panel_tabs' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_tabs', 'fcunited_skins_theme_panel_tabs' );
	function fcunited_skins_theme_panel_tabs( $tabs ) {
		if ( FCUNITED_ALLOW_SKINS ) {
			fcunited_array_insert_after( $tabs, 'general', array( 'skins' => esc_html__( 'Skins', 'fcunited' ) ) );
		}
		return $tabs;
	}
}


// Display 'Skins' section in the Theme Panel
if ( ! function_exists( 'fcunited_skins_theme_panel_section' ) ) {
	add_action( 'trx_addons_action_theme_panel_section', 'fcunited_skins_theme_panel_section', 10, 2);
	function fcunited_skins_theme_panel_section( $tab_id, $theme_info ) {
		if ( 'skins' !== $tab_id ) return;
		?>
		<div id="trx_addons_theme_panel_section_<?php echo esc_attr($tab_id); ?>" class="trx_addons_tabs_section">

			<?php
			do_action('trx_addons_action_theme_panel_section_start', $tab_id, $theme_info);

			if ( trx_addons_is_theme_activated() ) {
				?>
				<div class="trx_addons_theme_panel_skins_selector">

					<?php do_action('trx_addons_action_theme_panel_before_section_title', $tab_id, $theme_info); ?>
		
					<h1 class="trx_addons_theme_panel_section_title">
						<?php esc_html_e( 'Skins', 'fcunited' ); ?>
					</h1>

					<?php do_action('trx_addons_action_theme_panel_after_section_title', $tab_id, $theme_info); ?>

					<div class="trx_addons_theme_panel_section_info">
						<p><?php echo wp_kses_data( __( 'Choose a skin for your website. Depending on which skin is selected, the list of plugins and demo data may change.', 'fcunited' ) ); ?></p>
						<p><?php echo wp_kses_data( __( '<b>Attention!</b> Each skin is customized individually and has its own options. You will be able to change the skin later, but you will have to re-configure it.', 'fcunited' ) ); ?></p>
					</div>

					<?php do_action('trx_addons_action_theme_panel_before_list_items', $tab_id, $theme_info); ?>
					
					<div class="trx_addons_theme_panel_skins_list">
						<?php
						$skins = fcunited_storage_get( 'skins' );
						foreach ( $skins as $skin => $data ) {
							$skin_classes = array();
							if ( FCUNITED_SKIN_NAME == $skin ) {
								$skin_classes[] = 'skin_active';
							}
							if ( ! empty( $data['installed'] ) ) {
								$skin_classes[] = 'skin_installed';
							} else if ( ! empty( $data['buy_url'] ) ) {
								$skin_classes[] = 'skin_buy';
							} else {
								$skin_classes[] = 'skin_free';
							}
							
							?><div class="trx_addons_image_block <?php echo esc_attr( join( ' ', $skin_classes ) ); ?>">
								<div class="trx_addons_image_block_inner
								 	<?php 
									$theme_slug  = get_option( 'template' );
									// Skin image
									$img = ! empty( $data['installed'] )
											? fcunited_skins_get_file_url( 'skin.jpg', $skin )
											: trailingslashit( fcunited_storage_get( 'theme_upgrade_url' ) ) . "skins/{$theme_slug}/{$skin}/skin.jpg";
									if ( ! empty( $img ) ) {
										echo fcunited_add_inline_css_class( 'background-image: url(' . esc_url( $img ) . ');' );
									}				 	
								 	?>">
								 	<?php
									// Link to choose skin
									if ( FCUNITED_SKIN_NAME == $skin ) {
										?>
										<span class="trx_addons_image_block_link button button-action trx_addons_image_block_link_active">
											<?php
											esc_html_e( 'Active skin', 'fcunited' );
											?>
										</span>
										<?php
											if ( version_compare( $data['installed'], $data['version'], '<' ) ) {
												?>
												<a href="#"
													class="trx_addons_image_block_link trx_addons_image_block_link_update_skin button button-secondary"
													data-skin="<?php echo esc_attr( $skin ); ?>">
														<?php
														// Translators: Add new version of the skin to the string
														echo esc_html( sprintf( __( 'Update to v.%s', 'fcunited' ), $data['version'] ) );
														?>
												</a>
												<?php
											}
										} else if ( ! empty( $data['installed'] ) ) {
										?>
										<a href="#"
											class="trx_addons_image_block_link trx_addons_image_block_link_choose_skin button button-primary"
											data-skin="<?php echo esc_attr( $skin ); ?>">
												<?php
												esc_html_e( 'Choose skin', 'fcunited' );
												?>
										</a>
										<?php
										if ( version_compare( $data['installed'], $data['version'], '<' ) ) {
											?>
											<a href="#"
												class="trx_addons_image_block_link trx_addons_image_block_link_update_skin button button-secondary"
												data-skin="<?php echo esc_attr( $skin ); ?>">
													<?php
													// Translators: Add new version of the skin to the string
													echo esc_html( sprintf( __( 'Update to v.%s', 'fcunited' ), $data['version'] ) );
													?>
											</a>
											<?php
										}
									} else if ( ! empty( $data['buy_url'] ) ) {
										?>
										<a href="#"
											class="trx_addons_image_block_link trx_addons_image_block_link_buy_skin button button-secondary"
											data-skin="<?php echo esc_attr( $skin ); ?>"
											data-buy="<?php echo esc_url( $data['buy_url'] ); ?>">
												<?php
												esc_html_e( 'Buy skin', 'fcunited' );
												?>
										</a>
										<?php
									} else {
										?>
										<a href="#"
											class="trx_addons_image_block_link trx_addons_image_block_link_download_skin button button-secondary"
											data-skin="<?php echo esc_attr( $skin ); ?>">
												<?php
												esc_html_e( 'Download skin', 'fcunited' );
												?>
										</a>
										<?php
									}
									// Link to demo site
									if ( ! empty( $data['demo_url'] ) ) {
										?>
										<a href="<?php echo esc_url( $data['demo_url'] ); ?>" class="trx_addons_image_block_link trx_addons_image_block_link_view_demo button" target="_blank">
											<?php
											esc_html_e( 'View demo', 'fcunited' );
											?>
										</a>
										<?php
									}
									?>
							 	</div>
								<?php
								// Skin title
								if ( ! empty( $data['title'] ) ) {
									?>
									<h3 class="trx_addons_image_block_title">
										<i class="dashicons dashicons-admin-appearance"></i>
										<?php
										// Translators: Add version of the skin to the string
										echo esc_html( $data['title'] )
											. ( ! empty( $data['installed'] )
												? ' ' . esc_html( sprintf( __( 'v.%s', 'fcunited' ), $data['installed'] ) )
												: ''
												);
										?>
									</h3>
									<?php
								}
								// Skin description
								if ( ! empty( $data['description'] ) ) {
									?>
									<div class="trx_addons_image_block_description">
										<?php
										echo wp_kses( $data['description'], 'fcunited_kses_content' );
										?>
									</div>
									<?php
								}
								?>
							</div><?php // No spaces allowed after this <div>, because it is an inline-block element
						}
						?>
					</div>

					<?php do_action('trx_addons_action_theme_panel_after_list_items', $tab_id, $theme_info); ?>

				</div>
				<?php
				do_action('trx_addons_action_theme_panel_after_section_data', $tab_id, $theme_info);
			} else {
				?>
				<div class="error"><p>
					<?php esc_html_e( 'Activate your theme in order to be able to change skins.', 'fcunited' ); ?>
				</p></div>
				<?php
			}

			do_action('trx_addons_action_theme_panel_section_end', $tab_id, $theme_info);
			?>
		</div>
		<?php
	}
}


// Load page-specific scripts and styles
if ( ! function_exists( 'fcunited_skins_about_enqueue_scripts' ) ) {
	add_action( 'admin_enqueue_scripts', 'fcunited_skins_about_enqueue_scripts' );
	function fcunited_skins_about_enqueue_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos($screen->id, '_page_trx_addons_theme_panel') ) {
			wp_enqueue_script( 'fcunited-skins-admin', fcunited_get_file_url( 'skins/skins-admin.js' ), array( 'jquery' ), null, true );
		}
	}
}

// Add page-specific vars to the localize array
if ( ! function_exists( 'fcunited_skins_localize_script' ) ) {
	add_filter( 'fcunited_filter_localize_script_admin', 'fcunited_skins_localize_script' );
	function fcunited_skins_localize_script( $arr ) {

		// Switch an active skin
		$arr['msg_switch_skin_caption']           = esc_html__( "Attention!", 'fcunited' );
		$arr['msg_switch_skin']                   = apply_filters( 'fcunited_filter_msg_switch_skin',
			'<p>'
			. esc_html__( "Some skins require installation of additional plugins.", 'fcunited' )
			. '</p><p>'
			. esc_html__( "Also, after selecting a new skin, your theme settings will be changed.", 'fcunited' )
			. '</p>'
		);
		$arr['msg_switch_skin_success']           = esc_html__( 'A new skin is selected. The page will be reloaded.', 'fcunited' );
		$arr['msg_switch_skin_success_caption']   = esc_html__( 'Skin is changed!', 'fcunited' );

		// Download a new skin
		$arr['msg_download_skin_caption']         = esc_html__( "Download skin", 'fcunited' );
		$arr['msg_download_skin']                 = apply_filters( 'fcunited_filter_msg_download_skin',
			'<p>'
			. esc_html__( "The new skin will be installed in the 'skins' folder inside your theme folder.", 'fcunited' )
			. '</p><p>'
			. esc_html__( "Attention! Do not forget to activate the new skin after installation.", 'fcunited' )
			. '</p>'
		);
		$arr['msg_download_skin_success']         = esc_html__( 'A new skin is installed. The page will be reloaded.', 'fcunited' );
		$arr['msg_download_skin_success_caption'] = esc_html__( 'Skin is installed!', 'fcunited' );
		$arr['msg_download_skin_error_caption']   = esc_html__( 'Skin download error!', 'fcunited' );

		// Buy a new skin
		$arr['msg_buy_skin_caption']              = esc_html__( "Download purchased skin", 'fcunited' );
		$arr['msg_buy_skin']                      = apply_filters( 'fcunited_filter_msg_buy_skin',
			'<p>'
			. esc_html__( "1. Follow the link below and purchase the selected skin. After payment you will receive a purchase code.", 'fcunited' )
			. '</p><p>'
			. '<a href="#" target="_blank">' . esc_html__( "Purchase the selected skin.", 'fcunited' ) . '</a>'
			. '</p><p>'
			. esc_html__( "2. Enter the purchase code of the selected skin in the field below and press the button 'Apply'.", 'fcunited' )
			. '</p><p>'
			. esc_html__( "3. The new skin will be installed to the folder 'skins' inside your theme folder.", 'fcunited' )
			. '</p><p>'
			. esc_html__( "Attention! Do not forget to activate the new skin after installation.", 'fcunited' )
			. '</p>'
		);
		$arr['msg_buy_skin_placeholder']          = esc_html__( 'Enter the purchase code of the skin.', 'fcunited' );
		$arr['msg_buy_skin_success']              = esc_html__( 'A new skin is installed. The page will be reloaded.', 'fcunited' );
		$arr['msg_buy_skin_success_caption']      = esc_html__( 'Skin is installed!', 'fcunited' );
		$arr['msg_buy_skin_error_caption']        = esc_html__( 'Skin download error!', 'fcunited' );

		// Update an installed skin
		$arr['msg_update_skin_caption']         = esc_html__( "Update skin", 'fcunited' );
		$arr['msg_update_skin']                 = apply_filters( 'fcunited_filter_msg_update_skin',
			'<p>'
			. esc_html__( "Attention! The new version of the skin will be installed in the same folder instead the current version!", 'fcunited' )
			. '</p><p>'
			. esc_html__( "If you made any changes in the files from the folder of the selected skin - they will be lost.", 'fcunited' )
			. '</p>'
		);
		$arr['msg_update_skin_success']         = esc_html__( 'The skin is updated. The page will be reloaded.', 'fcunited' );
		$arr['msg_update_skin_success_caption'] = esc_html__( 'Skin is updated!', 'fcunited' );
		$arr['msg_update_skin_error_caption']   = esc_html__( 'Skin update error!', 'fcunited' );

		return $arr;
	}
}


// AJAX handler for the 'fcunited_switch_skin' action
if ( ! function_exists( 'fcunited_skins_ajax_switch_skin' ) ) {
	add_action( 'wp_ajax_fcunited_switch_skin', 'fcunited_skins_ajax_switch_skin' );
	function fcunited_skins_ajax_switch_skin() {

		if ( ! wp_verify_nonce( fcunited_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}

		$response = array( 'error' => '' );

		$skin  = fcunited_get_value_gp( 'skin' );
		$skins = fcunited_storage_get( 'skins' );

		if ( empty( $skin ) || ! isset( $skins[ $skin ] ) || empty( $skins[ $skin ]['installed'] ) ) {
			// Translators: Add the skin's name to the message
			$response['error'] = wp_kses_data(sprintf( __( 'Can not switch to the skin %s', 'fcunited' ), $skin ));
		} elseif ( FCUNITED_SKIN_NAME == $skin ) {
			// Translators: Add the skin's name to the message
			$response['error'] = wp_kses_data(sprintf( __( 'Skin %s is already active', 'fcunited' ), $skin ));
		} else {
			// Get current theme slug
			$theme_slug = get_option( 'stylesheet' );
			// Get options from new skin
			$skin_mods = get_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, $skin ), false );
			if ( ! $skin_mods ) {
				if ( file_exists( FCUNITED_THEME_DIR . 'skins/skins-options.php' ) ) {
					require_once FCUNITED_THEME_DIR . 'skins/skins-options.php';
					if ( isset( $skins_options[ $skin ] ) ) {
						$skin_mods = fcunited_unserialize( $skins_options[ $skin ]['options'] );
					}
				}
			}
			if ( false !== $skin_mods ) {
				// Save current options
				update_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, FCUNITED_SKIN_NAME ), get_theme_mods() );
				// Replace theme mods with options from new skin
				fcunited_options_update( $skin_mods );
				// Replace current skin
				update_option( sprintf( 'theme_skin_%s', $theme_slug ), $skin );
                // Set flag to regenerate styles and scripts on first run
                update_option( 'fcunited_action', '' );
                update_option( 'trx_addons_action', 'trx_addons_action_save_options' );

			} else {
				$response['error'] = esc_html__( 'Options of the new skin are not found!', 'fcunited' );
			}
		}

		echo json_encode( $response );
		wp_die();
	}
}


// AJAX handler for the 'fcunited_download_skin' action
if ( ! function_exists( 'fcunited_skins_ajax_download_skin' ) ) {
	add_action( 'wp_ajax_fcunited_download_skin', 'fcunited_skins_ajax_download_skin' );
	add_action( 'wp_ajax_fcunited_buy_skin', 'fcunited_skins_ajax_download_skin' );
	add_action( 'wp_ajax_fcunited_update_skin', 'fcunited_skins_ajax_download_skin' );
	function fcunited_skins_ajax_download_skin() {

		if ( ! wp_verify_nonce( fcunited_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}

		$response = array( 'error' => '' );

		$action   = current_action() == 'wp_ajax_fcunited_download_skin'
						? 'download'
						: (current_action() == 'wp_ajax_fcunited_buy_skin'
							? 'buy'
							: 'update' );

		$key      = fcunited_get_theme_activation_code();
		
		$skin     = fcunited_get_value_gp( 'skin' );
		$code     = 'update' == $action
						? get_option( sprintf( 'purchase_code_%s_%s', get_option( 'template' ), $skin ), '' )
						: fcunited_get_value_gp( 'code' );

		$skins    = fcunited_storage_get( 'skins' );

		if ( empty( $key ) ) {
			// Translators: Add the skin's name to the message
			$response['error'] = esc_html__( 'Theme is not activated!', 'fcunited' );

		} else if ( empty( $skin ) || ! isset( $skins[ $skin ] ) ) {
			// Translators: Add the skin's name to the message
			$response['error'] = wp_kses_data(sprintf( __( 'Can not download the skin %s', 'fcunited' ), $skin ));

		} else if ( ! empty( $skins[ $skin ]['installed'] ) && 'update' != $action ) {
			// Translators: Add the skin's name to the message
			$response['error'] = wp_kses_data(sprintf( __( 'Skin %s is already installed', 'fcunited' ), $skin ));

		} else {

			$theme_slug  = get_option( 'template' );
			$theme_name = wp_get_theme( $theme_slug )->name;
			// Add the key, theme slug and name, skin name and purchase code to the link
			$upgrade_url = sprintf(
				trailingslashit( fcunited_storage_get( 'theme_upgrade_url' ) ) . 'upgrade.php?key=%1$s&src=%2$s&theme_slug=%3$s&theme_name=%4$s&skin=%5$s&action=download_skin&skin_key=%6$s&rnd=%7$s',
				urlencode( $key ),
				urlencode( fcunited_storage_get( 'theme_pro_key' ) ),
				urlencode( $theme_slug ),
				urlencode( $theme_name ),
				urlencode( $skin ),
				urlencode( $code ),
				mt_rand()
			);
			$result      = function_exists( 'trx_addons_fgc' ) ? trx_addons_fgc( $upgrade_url ) : fcunited_fgc( $upgrade_url );
			if ( is_serialized( $result ) ) {
				try {
					// Use serialization instead:
					$result = fcunited_unserialize( $result );
				} catch ( Exception $e ) {
					$result = array(
						'error' => esc_html__( 'Unrecognized server answer!', 'fcunited' ),
						'data'  => '',
						'info'  => ''
					);
				}
				if ( isset( $result['error'] ) && isset( $result['data'] ) ) {
					if ( substr( $result['data'], 0, 2 ) == 'PK' ) {
						$tmp_name = 'tmp-' . rand() . '.zip';
						$tmp      = wp_upload_bits( $tmp_name, null, $result['data'] );
						if ( $tmp['error'] ) {
							$response['error'] = esc_html__( 'Problem with save upgrade file to the folder with uploads', 'fcunited' );
						} else {
							$response['error'] .= fcunited_skins_install_skin( $skin, $tmp['file'], $result['info'] );
							// Store purchase code to update skins in the future
							if ( ! empty( $code ) && empty( $response['error'] ) ) {
								update_option( sprintf( 'purchase_code_%s_%s', get_option( 'template' ), $skin ), $code );
							}
						}
					} else {
						$response['error'] = ! empty( $result['error'] )
														? $result['error']
														: esc_html__( 'Package with upgrade is corrupt', 'fcunited' );
					}
				} else {
					$response['error'] = esc_html__( 'Incorrect server answer', 'fcunited' );
				}
			} else {
				$response['error'] = esc_html__( 'Unrecognized server answer format:', 'fcunited' ) . strlen( $result ) . ' "' . substr( $result, 0, 100 ) . '...' . substr( $result, -100 ) . '"';
			}
		}

		echo json_encode( $response );
		wp_die();
	}
}


// Unpack and install skin
if ( ! function_exists( 'fcunited_skins_install_skin' ) ) {
	function fcunited_skins_install_skin( $skin, $file, $info ) {
		if ( file_exists( $file ) ) {
			ob_start();
			// Unpack skin
			$dest = fcunited_get_folder_dir( '/skins' );
			if ( ! empty( $dest ) ) {
				unzip_file( $file, $dest );
			}
			// Remove uploaded archive
			unlink( $file );
			$log = ob_get_contents();
			ob_end_clean();
			// Save skin options
			if ( ! empty( $info['skin_options'] ) ) {
				if ( is_string( $info['skin_options'] ) && is_serialized( $info['skin_options'] ) ) {
					$info['skin_options'] = fcunited_unserialize( stripslashes( $info['skin_options'] ) );
				}
				if ( is_array( $info['skin_options'] ) ) {
					$theme_slug = get_option( 'stylesheet' );
					update_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, $skin ), $info['skin_options'] );
				}
			}
			// Update skins list
			$skins_file      = fcunited_get_file_dir( 'skins/skins.json' );
			$skins_installed = json_decode( fcunited_fgc( $skins_file ), true );
			$skins_available = fcunited_storage_get( 'skins' );
			if ( isset( $skins_available[ $skin ][ 'installed' ] ) ) {
				unset( $skins_available[ $skin ][ 'installed' ] );
			}
			$skins_installed[ $skin ] = $skins_available[ $skin ];
			fcunited_fpc( $skins_file, json_encode( $skins_installed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT ) );

		} else {
			return esc_html__( 'Uploaded file with skin package is not available', 'fcunited' );
		}
	}
}





// One-click import support
//------------------------------------------------------------------------

// Export custom layouts
if ( ! function_exists( 'fcunited_skins_importer_export' ) ) {
	if ( is_admin() ) {
		add_action( 'trx_addons_action_importer_export', 'fcunited_skins_importer_export', 10, 1 );
	}
	function fcunited_skins_importer_export( $importer ) {
		$skins  = fcunited_storage_get( 'skins' );
		$output = '';
		if ( is_array( $skins ) && count( $skins ) > 0 ) {
			$output     = '<?php'
						. "\n//" . esc_html__( 'Skins', 'fcunited' )
						. "\n\$skins_options = array(";
			$counter    = 0;
			$theme_mods = get_theme_mods();
			$theme_slug = get_option( 'stylesheet' );
			foreach ( $skins as $skin => $skin_data ) {
				$options = get_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, $skin ), false );
				if ( false === $options ) {
					$options = $theme_mods;
				}
				$output .= ( $counter++ ? ',' : '' )
						. "\n\t\t'{$skin}' => array("
						. "\n\t\t\t\t'options' => " . '"' . str_replace( array( "\r", "\n" ), array( '\r', '\n' ), addslashes( serialize( apply_filters( 'fcunited_filter_export_skin_options', $options, $skin ) ) ) ) . '"'
						. "\n\t\t\t\t)";
			}
			$output .= "\n\t\t);"
					. "\n?>";
		}
		fcunited_fpc( $importer->export_file_dir( 'skins.txt' ), $output );
	}
}

// Display exported data in the fields
if ( ! function_exists( 'fcunited_skins_importer_export_fields' ) ) {
	if ( is_admin() ) {
		add_action( 'trx_addons_action_importer_export_fields', 'fcunited_skins_importer_export_fields', 12, 1 );
	}
	function fcunited_skins_importer_export_fields( $importer ) {
		$importer->show_exporter_fields(
			array(
				'slug'     => 'skins',
				'title'    => esc_html__( 'Skins', 'fcunited' ),
				'download' => 'skins-options.php',
			)
		);
	}
}


// Load file with current skin
$fcunited_skin_file = fcunited_skins_get_file_dir( 'skin.php' );
if ( '' != $fcunited_skin_file ) {
	require_once $fcunited_skin_file;
}
