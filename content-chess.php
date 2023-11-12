<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_template_args = get_query_var( 'fcunited_template_args' );
if ( is_array( $fcunited_template_args ) ) {
	$fcunited_columns    = empty( $fcunited_template_args['columns'] ) ? 1 : max( 1, min( 3, $fcunited_template_args['columns'] ) );
	$fcunited_blog_style = array( $fcunited_template_args['type'], $fcunited_columns );
} else {
	$fcunited_blog_style = explode( '_', fcunited_get_theme_option( 'blog_style' ) );
	$fcunited_columns    = empty( $fcunited_blog_style[1] ) ? 1 : max( 1, min( 3, $fcunited_blog_style[1] ) );
}
$fcunited_expanded    = ! fcunited_sidebar_present() && fcunited_is_on( fcunited_get_theme_option( 'expand_content' ) );
$fcunited_post_format = get_post_format();
$fcunited_post_format = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );
$fcunited_animation   = fcunited_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $fcunited_columns )
										. ' post_format_' . esc_attr( $fcunited_post_format )
										. ( ! empty( $fcunited_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! fcunited_is_off( $fcunited_animation ) && empty( $fcunited_template_args['slider'] ) ? ' data-animation="' . esc_attr( fcunited_get_animation_classes( $fcunited_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $fcunited_columns && ! is_array( $fcunited_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' .the_title_attribute( array( 'echo' => false ) ). '" icon="' . esc_attr( fcunited_get_post_icon() ) . '"]' );
	}

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$fcunited_hover = ! empty( $fcunited_template_args['hover'] ) && ! fcunited_is_inherit( $fcunited_template_args['hover'] )
						? $fcunited_template_args['hover']
						: fcunited_get_theme_option( 'image_hover' );
	fcunited_show_post_featured(
		array(
			'class'         => 1 == $fcunited_columns && ! is_array( $fcunited_template_args ) ? 'fcunited-full-height' : '',
			'hover'         => $fcunited_hover,
			'no_links'      => ! empty( $fcunited_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => fcunited_get_thumb_size(
				strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $fcunited_columns ? 'huge' : 'original' )
										: ( 2 < $fcunited_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'fcunited_action_before_post_title' );

			// Post title
			if ( empty( $fcunited_template_args['no_links'] ) ) {
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			} else {
				the_title( '<h3 class="post_title entry-title">', '</h3>' );
			}

			do_action( 'fcunited_action_before_post_meta' );

			// Post meta
			$fcunited_components = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) );
			$fcunited_post_meta  = empty( $fcunited_components ) || in_array( $fcunited_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: fcunited_show_post_meta(
											apply_filters(
												'fcunited_filter_post_meta_args', array(
													'components' => $fcunited_components,
													'seo'  => false,
													'echo' => false,
												), $fcunited_blog_style[0], $fcunited_columns
											)
										);
			fcunited_show_layout( $fcunited_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
			<?php
			// Post content area
			if ( empty( $fcunited_template_args['hide_excerpt'] ) && ! empty( fcunited_get_theme_option( 'excerpt_length' ) ) && fcunited_get_theme_option( 'excerpt_length' ) > 0 ) {
				fcunited_show_post_content( $fcunited_template_args, '<div class="post_content_inner">', '</div>' );
			}
			// Post meta
			if ( in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				fcunited_show_layout( $fcunited_post_meta );
			}
			// More button
			if ( false && empty( $fcunited_template_args['no_links'] ) && ! in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				fcunited_show_post_more_link( $fcunited_template_args, '<p>', '</p>' );
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
