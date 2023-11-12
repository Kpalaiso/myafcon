<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.1
 */

$fcunited_theme_obj = wp_get_theme();
?>
<div class="fcunited_admin_notice fcunited_welcome_notice update-nag">
	<?php
	// Theme image
	$fcunited_theme_img = fcunited_get_file_url( 'screenshot.jpg' );
	if ( '' != $fcunited_theme_img ) {
		?>
		<div class="fcunited_notice_image"><img src="<?php echo esc_url( $fcunited_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'fcunited' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="fcunited_notice_title">
		<?php
		echo sprintf(
			// Translators: Add theme name and version to the 'Welcome' message
			esc_html__( 'Welcome to %1$s v.%2$s', 'fcunited' ),
			$fcunited_theme_obj->name . ( FCUNITED_THEME_FREE ? ' ' . esc_html__( 'Free', 'fcunited' ) : '' ),
			$fcunited_theme_obj->version
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="fcunited_notice_text">
		<p class="fcunited_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $fcunited_theme_obj->description ) );
			?>
		</p>
		<p class="fcunited_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'fcunited' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="fcunited_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=fcunited_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'fcunited' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="fcunited_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="fcunited_hide_notice_text"><?php esc_html_e( 'Dismiss', 'fcunited' ); ?></span></a>
	</div>
</div>
