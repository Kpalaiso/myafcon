<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php do_action( 'fcunited_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$fcunited_header_type = fcunited_get_theme_option( 'header_type' );
			if ( 'custom' == $fcunited_header_type && ! fcunited_is_layouts_available() ) {
				$fcunited_header_type = 'default';
			}
			get_template_part( apply_filters( 'fcunited_filter_get_template_part', "templates/header-{$fcunited_header_type}" ) );

			// Side menu
			if ( in_array( fcunited_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/header-navi-mobile' ) );
			
			// Single posts banner after header
			fcunited_show_post_banner( 'header' );
			?>

			<div class="page_content_wrap">
				<?php
				// Single posts banner on the background
				if ( is_singular( 'post' ) || is_singular( 'attachment' ) ) {

					fcunited_show_post_banner( 'background' );

					$fcunited_post_thumbnail_type  = fcunited_get_theme_option( 'post_thumbnail_type' );
					$fcunited_post_header_position = fcunited_get_theme_option( 'post_header_position' );
					$fcunited_post_header_align    = fcunited_get_theme_option( 'post_header_align' );

					// Boxed post thumbnail
					if ( in_array( $fcunited_post_thumbnail_type, array( 'boxed', 'fullwidth') ) ) {
						ob_start();
						?>
						<div class="header_content_wrap header_align_<?php echo esc_attr( $fcunited_post_header_align ); ?>">
							<?php
							if ( 'boxed' === $fcunited_post_thumbnail_type ) {
								?>
								<div class="content_wrap">
								<?php
							}

							// Post title and meta
							if ( 'above' === $fcunited_post_header_position ) {
								fcunited_show_post_title_and_meta();
							}

							// Featured image
							fcunited_show_post_featured_image();

							// Post title and meta
							if ( in_array( $fcunited_post_header_position, array( 'under', 'on_thumb' ) ) ) {
								fcunited_show_post_title_and_meta();
							}

							if ( 'boxed' === $fcunited_post_thumbnail_type ) {
								?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
						$fcunited_post_header = ob_get_contents();
						ob_end_clean();
						if ( strpos( $fcunited_post_header, 'post_featured' ) !== false || strpos( $fcunited_post_header, 'post_title' ) !== false ) {
							fcunited_show_layout( $fcunited_post_header );
						}
					}
				}

				// Widgets area above page content
				$fcunited_body_style   = fcunited_get_theme_option( 'body_style' );
				$fcunited_widgets_name = fcunited_get_theme_option( 'widgets_above_page' );
				$fcunited_show_widgets = ! fcunited_is_off( $fcunited_widgets_name ) && is_active_sidebar( $fcunited_widgets_name );
				if ( $fcunited_show_widgets ) {
					if ( 'fullscreen' != $fcunited_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					fcunited_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $fcunited_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}
				}

				// Content area
				if ( 'fullscreen' != $fcunited_body_style ) {
					?>
					<div class="content_wrap">
						<?php
				}
				?>

				<div class="content">
					<?php
					// Widgets area inside page content
					fcunited_create_widgets_area( 'widgets_above_content' );
