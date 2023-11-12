<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'fcunited_wpml_get_css' ) ) {
	add_filter( 'fcunited_filter_get_css', 'fcunited_wpml_get_css', 10, 2 );
	function fcunited_wpml_get_css( $css, $args ) {
		return $css;
	}
}

