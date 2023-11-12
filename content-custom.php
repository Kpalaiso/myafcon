<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.50
 */

$fcunited_template_args = get_query_var( 'fcunited_template_args' );
if ( is_array( $fcunited_template_args ) ) {
	$fcunited_columns    = empty( $fcunited_template_args['columns'] ) ? 2 : max( 1, $fcunited_template_args['columns'] );
	$fcunited_blog_style = array( $fcunited_template_args['type'], $fcunited_columns );
} else {
	$fcunited_blog_style = explode( '_', fcunited_get_theme_option( 'blog_style' ) );
	$fcunited_columns    = empty( $fcunited_blog_style[1] ) ? 2 : max( 1, $fcunited_blog_style[1] );
}
$fcunited_blog_id       = fcunited_get_custom_blog_id( join( '_', $fcunited_blog_style ) );
$fcunited_blog_style[0] = str_replace( 'blog-custom-', '', $fcunited_blog_style[0] );
$fcunited_expanded      = ! fcunited_sidebar_present() && fcunited_is_on( fcunited_get_theme_option( 'expand_content' ) );
$fcunited_animation     = fcunited_get_theme_option( 'blog_animation' );
$fcunited_components    = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) );

$fcunited_post_format   = get_post_format();
$fcunited_post_format   = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );

$fcunited_blog_meta     = fcunited_get_custom_layout_meta( $fcunited_blog_id );
$fcunited_custom_style  = ! empty( $fcunited_blog_meta['scripts_required'] ) ? $fcunited_blog_meta['scripts_required'] : 'none';

if ( ! empty( $fcunited_template_args['slider'] ) || $fcunited_columns > 1 || ! fcunited_is_off( $fcunited_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $fcunited_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( fcunited_is_off( $fcunited_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $fcunited_custom_style ) ) . '-1_' . esc_attr( $fcunited_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php
	post_class(
			'post_item post_format_' . esc_attr( $fcunited_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $fcunited_columns )
					. ' post_layout_' . esc_attr( $fcunited_blog_style[0] )
					. ' post_layout_' . esc_attr( $fcunited_blog_style[0] ) . '_' . esc_attr( $fcunited_columns )
					. ( ! fcunited_is_off( $fcunited_custom_style )
						? ' post_layout_' . esc_attr( $fcunited_custom_style )
							. ' post_layout_' . esc_attr( $fcunited_custom_style ) . '_' . esc_attr( $fcunited_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'fcunited_action_show_layout', $fcunited_blog_id );
	?>
</article><?php
if ( ! empty( $fcunited_template_args['slider'] ) || $fcunited_columns > 1 || ! fcunited_is_off( $fcunited_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
