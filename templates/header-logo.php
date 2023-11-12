<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_args = get_query_var( 'fcunited_logo_args' );

// Site logo
$fcunited_logo_type   = isset( $fcunited_args['type'] ) ? $fcunited_args['type'] : '';
$fcunited_logo_image  = fcunited_get_logo_image( $fcunited_logo_type );
$fcunited_logo_text   = fcunited_is_on( fcunited_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$fcunited_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $fcunited_logo_image['logo'] ) || ! empty( $fcunited_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $fcunited_logo_image['logo'] ) ) {
			if ( empty( $fcunited_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $fcunited_logo_image['logo'] ) && $fcunited_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$fcunited_attr = fcunited_getimagesize( $fcunited_logo_image['logo'] );
				echo '<img src="' . esc_url( $fcunited_logo_image['logo'] ) . '"'
						. ( ! empty( $fcunited_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $fcunited_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $fcunited_logo_text ) . '"'
						. ( ! empty( $fcunited_attr[3] ) ? ' ' . wp_kses_data( $fcunited_attr[3] ) : '' )
						. '>';
			}
		} else {
			fcunited_show_layout( fcunited_prepare_macros( $fcunited_logo_text ), '<span class="logo_text">', '</span>' );
			fcunited_show_layout( fcunited_prepare_macros( $fcunited_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
