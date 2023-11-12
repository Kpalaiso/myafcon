<div class="front_page_section front_page_section_googlemap<?php
	$fcunited_scheme = fcunited_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! fcunited_is_inherit( $fcunited_scheme ) ) {
		echo ' scheme_' . esc_attr( $fcunited_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( fcunited_get_theme_option( 'front_page_googlemap_paddings' ) );
?>"
		<?php
		$fcunited_css      = '';
		$fcunited_bg_image = fcunited_get_theme_option( 'front_page_googlemap_bg_image' );
		if ( ! empty( $fcunited_bg_image ) ) {
			$fcunited_css .= 'background-image: url(' . esc_url( fcunited_get_attachment_url( $fcunited_bg_image ) ) . ');';
		}
		if ( ! empty( $fcunited_css ) ) {
			echo ' style="' . esc_attr( $fcunited_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$fcunited_anchor_icon = fcunited_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$fcunited_anchor_text = fcunited_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $fcunited_anchor_icon ) || ! empty( $fcunited_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $fcunited_anchor_icon ) ? ' icon="' . esc_attr( $fcunited_anchor_icon ) . '"' : '' )
									. ( ! empty( $fcunited_anchor_text ) ? ' title="' . esc_attr( $fcunited_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
	<?php
	if ( fcunited_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
		echo ' fcunited-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$fcunited_css      = '';
			$fcunited_bg_mask  = fcunited_get_theme_option( 'front_page_googlemap_bg_mask' );
			$fcunited_bg_color_type = fcunited_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $fcunited_bg_color_type ) {
				$fcunited_bg_color = fcunited_get_theme_option( 'front_page_googlemap_bg_color' );
			} elseif ( 'scheme_bg_color' == $fcunited_bg_color_type ) {
				$fcunited_bg_color = fcunited_get_scheme_color( 'bg_color', $fcunited_scheme );
			} else {
				$fcunited_bg_color = '';
			}
			if ( ! empty( $fcunited_bg_color ) && $fcunited_bg_mask > 0 ) {
				$fcunited_css .= 'background-color: ' . esc_attr(
					1 == $fcunited_bg_mask ? $fcunited_bg_color : fcunited_hex2rgba( $fcunited_bg_color, $fcunited_bg_mask )
				) . ';';
			}
			if ( ! empty( $fcunited_css ) ) {
				echo ' style="' . esc_attr( $fcunited_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
			$fcunited_layout = fcunited_get_theme_option( 'front_page_googlemap_layout' );
		if ( 'fullwidth' != $fcunited_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$fcunited_caption     = fcunited_get_theme_option( 'front_page_googlemap_caption' );
			$fcunited_description = fcunited_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $fcunited_caption ) || ! empty( $fcunited_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $fcunited_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $fcunited_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $fcunited_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $fcunited_caption, 'fcunited_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $fcunited_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $fcunited_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $fcunited_description ), 'fcunited_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $fcunited_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$fcunited_content = fcunited_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $fcunited_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $fcunited_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $fcunited_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $fcunited_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $fcunited_content, 'fcunited_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $fcunited_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $fcunited_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
			<?php
			if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
				dynamic_sidebar( 'front_page_googlemap_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! fcunited_exists_trx_addons() ) {
					fcunited_customizer_need_trx_addons_message();
				} else {
					fcunited_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
				}
			}
			?>
			</div>
			<?php

			if ( 'columns' == $fcunited_layout && ( ! empty( $fcunited_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
