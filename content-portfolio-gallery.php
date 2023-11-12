<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_template_args = get_query_var( 'fcunited_template_args' );
if ( is_array( $fcunited_template_args ) ) {
	$fcunited_columns    = empty( $fcunited_template_args['columns'] ) ? 2 : max( 1, $fcunited_template_args['columns'] );
	$fcunited_blog_style = array( $fcunited_template_args['type'], $fcunited_columns );
} else {
	$fcunited_blog_style = explode( '_', fcunited_get_theme_option( 'blog_style' ) );
	$fcunited_columns    = empty( $fcunited_blog_style[1] ) ? 2 : max( 1, $fcunited_blog_style[1] );
}
$fcunited_post_format = get_post_format();
$fcunited_post_format = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );
$fcunited_animation   = fcunited_get_theme_option( 'blog_animation' );
$fcunited_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><div class="
<?php
if ( ! empty( $fcunited_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo 'masonry_item masonry_item-1_' . esc_attr( $fcunited_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $fcunited_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $fcunited_columns )
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $fcunited_columns )
	);
	echo ( ! fcunited_is_off( $fcunited_animation ) && empty( $fcunited_template_args['slider'] ) ? ' data-animation="' . esc_attr( fcunited_get_animation_classes( $fcunited_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $fcunited_image[1] ) && ! empty( $fcunited_image[2] ) ) {
			echo intval( $fcunited_image[1] ) . 'x' . intval( $fcunited_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $fcunited_image[0] ) ) {
			echo esc_url( $fcunited_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$fcunited_image_hover = 'icon';
if ( in_array( $fcunited_image_hover, array( 'icons', 'zoom' ) ) ) {
	$fcunited_image_hover = 'dots';
}
$fcunited_components = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) );
fcunited_show_post_featured(
	array(
		'hover'         => $fcunited_image_hover,
		'no_links'      => ! empty( $fcunited_template_args['no_links'] ),
		'thumb_size'    => fcunited_get_thumb_size( strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false || $fcunited_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $fcunited_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $fcunited_components )
								? fcunited_show_post_meta(
									apply_filters(
										'fcunited_filter_post_meta_args', array(
											'components' => $fcunited_components,
											'seo'      => false,
											'echo'     => false,
										), $fcunited_blog_style[0], $fcunited_columns
									)
								)
								: ''
								)
							. ( empty( $fcunited_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $fcunited_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'fcunited' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
