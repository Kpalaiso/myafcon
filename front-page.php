<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( fcunited_is_on( fcunited_get_theme_option( 'front_page_enabled' ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$fcunited_sections = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'front_page_sections' ), 1, false );
		if ( is_array( $fcunited_sections ) ) {
			foreach ( $fcunited_sections as $fcunited_section ) {
				get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'front-page/section', $fcunited_section ), $fcunited_section );
			}
		}

		// Else if this page is blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'blog' ) );

		// Else - display native page content
	} else {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'page' ) );
	}

	// Else get index template to show posts
} else {
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'index' ) );
}

get_footer();
