<?php
/**
 * The Portfolio template to display the content
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
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
	);
	echo ( ! fcunited_is_off( $fcunited_animation ) && empty( $fcunited_template_args['slider'] ) ? ' data-animation="' . esc_attr( fcunited_get_animation_classes( $fcunited_animation ) ) . '"' : '' );
	?>
>
<?php

// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	$fcunited_image_hover = ! empty( $fcunited_template_args['hover'] ) && ! fcunited_is_inherit( $fcunited_template_args['hover'] )
								? $fcunited_template_args['hover']
								: fcunited_get_theme_option( 'image_hover' );
	// Featured image
	fcunited_show_post_featured(
		array(
			'hover'         => $fcunited_image_hover,
			'no_links'      => ! empty( $fcunited_template_args['no_links'] ),
			'thumb_size'    => fcunited_get_thumb_size(
				strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false || $fcunited_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $fcunited_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $fcunited_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!