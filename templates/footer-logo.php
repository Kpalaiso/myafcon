<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */

// Logo
if ( fcunited_is_on( fcunited_get_theme_option( 'logo_in_footer' ) ) ) {
	$fcunited_logo_image = fcunited_get_logo_image( 'footer' );
	$fcunited_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $fcunited_logo_image['logo'] ) || ! empty( $fcunited_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $fcunited_logo_image['logo'] ) ) {
					$fcunited_attr = fcunited_getimagesize( $fcunited_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $fcunited_logo_image['logo'] ) . '"'
								. ( ! empty( $fcunited_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $fcunited_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'fcunited' ) . '"'
								. ( ! empty( $fcunited_attr[3] ) ? ' ' . wp_kses_data( $fcunited_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $fcunited_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $fcunited_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
