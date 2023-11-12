<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
if ( ! fcunited_is_inherit( fcunited_get_theme_option( 'footer_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'footer_scheme' ) );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/footer-socials' ) );

	// Menu
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/footer-menu' ) );

	// Copyright area
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
