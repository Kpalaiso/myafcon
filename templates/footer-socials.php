<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */


// Socials
if ( fcunited_is_on( fcunited_get_theme_option( 'socials_in_footer' ) ) ) {
	$fcunited_output = fcunited_get_socials_links();
	if ( '' != $fcunited_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php fcunited_show_layout( $fcunited_output ); ?>
			</div>
		</div>
		<?php
	}
}
