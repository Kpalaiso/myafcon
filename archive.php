<?php
/**
 * The template file to display taxonomies archive
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.57
 */

// Redirect to the template page (if exists) for output current taxonomy
if ( is_category() || is_tag() || is_tax() ) {
	$fcunited_term = get_queried_object();
	global $wp_query;
	if ( ! empty( $fcunited_term->taxonomy ) && ! empty( $wp_query->posts[0]->post_type ) ) {
		$fcunited_taxonomy  = fcunited_get_post_type_taxonomy( $wp_query->posts[0]->post_type );
		if ( $fcunited_taxonomy == $fcunited_term->taxonomy ) {
			$fcunited_template_page_id = fcunited_get_template_page_id( array(
				'post_type'  => $wp_query->posts[0]->post_type,
				'parent_cat' => $fcunited_term->term_id
			) );
			if ( 0 < $fcunited_template_page_id ) {
				wp_safe_redirect( get_permalink( $fcunited_template_page_id ) );
				exit;
			}
		}
	}
}
// If template page is not exists - display default blog archive template
get_template_part( apply_filters( 'fcunited_filter_get_template_part', fcunited_blog_archive_get_template() ) );
