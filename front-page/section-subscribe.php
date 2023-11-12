<div class="front_page_section front_page_section_subscribe<?php
	$fcunited_scheme = fcunited_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! fcunited_is_inherit( $fcunited_scheme ) ) {
		echo ' scheme_' . esc_attr( $fcunited_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( fcunited_get_theme_option( 'front_page_subscribe_paddings' ) );
?>"
		<?php
		$fcunited_css      = '';
		$fcunited_bg_image = fcunited_get_theme_option( 'front_page_subscribe_bg_image' );
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
	$fcunited_anchor_icon = fcunited_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$fcunited_anchor_text = fcunited_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $fcunited_anchor_icon ) || ! empty( $fcunited_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $fcunited_anchor_icon ) ? ' icon="' . esc_attr( $fcunited_anchor_icon ) . '"' : '' )
									. ( ! empty( $fcunited_anchor_text ) ? ' title="' . esc_attr( $fcunited_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( fcunited_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' fcunited-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$fcunited_css      = '';
			$fcunited_bg_mask  = fcunited_get_theme_option( 'front_page_subscribe_bg_mask' );
			$fcunited_bg_color_type = fcunited_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $fcunited_bg_color_type ) {
				$fcunited_bg_color = fcunited_get_theme_option( 'front_page_subscribe_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$fcunited_caption = fcunited_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $fcunited_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $fcunited_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $fcunited_caption, 'fcunited_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$fcunited_description = fcunited_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $fcunited_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $fcunited_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $fcunited_description ), 'fcunited_kses_content' ); ?></div>
				<?php
			}

			// Content
			$fcunited_sc = fcunited_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $fcunited_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $fcunited_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					fcunited_show_layout( do_shortcode( $fcunited_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>