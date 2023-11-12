<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_link        = get_permalink();
$fcunited_post_format = get_post_format();
$fcunited_post_format = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $fcunited_post_format ) ); ?>>
	<?php
	fcunited_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'fcunited_filter_related_thumb_size', fcunited_get_thumb_size( (int) fcunited_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => fcunited_get_no_image() != '',
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses_post( fcunited_get_post_categories( '' ) ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $fcunited_link ) . '">' . wp_kses_data( get_the_title() ) . '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $fcunited_link ) . '" class="post_meta_item post_date">' . wp_kses_data( fcunited_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
