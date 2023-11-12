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
	$fcunited_columns    = empty( $fcunited_template_args['columns'] ) ? 2 : max( 1, $fcunited_template_args['columns'] );
	$fcunited_blog_style = array( $fcunited_template_args['type'], $fcunited_columns );
} else {
	$fcunited_blog_style = explode( '_', fcunited_get_theme_option( 'blog_style' ) );
	$fcunited_columns    = empty( $fcunited_blog_style[1] ) ? 2 : max( 1, $fcunited_blog_style[1] );
}
$fcunited_expanded   = ! fcunited_sidebar_present() && fcunited_is_on( fcunited_get_theme_option( 'expand_content' ) );
$fcunited_animation  = fcunited_get_theme_option( 'blog_animation' );
$fcunited_components = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) );

$fcunited_post_format = get_post_format();
$fcunited_post_format = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );

?><div class="
<?php
if ( ! empty( $fcunited_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $fcunited_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $fcunited_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $fcunited_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $fcunited_columns )
					. ' post_layout_' . esc_attr( $fcunited_blog_style[0] )
					. ' post_layout_' . esc_attr( $fcunited_blog_style[0] ) . '_' . esc_attr( $fcunited_columns )
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

	// Featured image
	$fcunited_hover = ! empty( $fcunited_template_args['hover'] ) && ! fcunited_is_inherit( $fcunited_template_args['hover'] )
						? $fcunited_template_args['hover']
						: fcunited_get_theme_option( 'image_hover' );
	fcunited_show_post_featured(
		array(
			'thumb_size' => fcunited_get_thumb_size(
				'classic' == $fcunited_blog_style[0]
						? ( strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $fcunited_columns > 2 ? 'big' : 'huge' )
								: ( $fcunited_columns > 2
									? ( $fcunited_expanded ? 'med' : 'small' )
									: ( $fcunited_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $fcunited_columns > 2 ? 'masonry-big' : 'full' )
								: ( $fcunited_columns <= 2 && $fcunited_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $fcunited_hover,
			'no_links'   => ! empty( $fcunited_template_args['no_links'] ),
		)
	);
    ?>
    <div class="post_layout_classic_wrap">
        <?php
        if ( ! in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
            ?>
            <div class="post_header entry-header">
                <?php

                do_action( 'fcunited_action_before_post_meta' );

                // Post meta
                if ( ! empty( $fcunited_components ) && ! in_array( $fcunited_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                    fcunited_show_post_meta(
                        apply_filters(
                            'fcunited_filter_post_meta_args', array(
                            'components' => $fcunited_components,
                            'seo'        => false,
                        ), $fcunited_blog_style[0], $fcunited_columns
                        )
                    );
                }

                do_action( 'fcunited_action_after_post_meta' );

                do_action( 'fcunited_action_before_post_title' );

                // Post title
                if ( empty( $fcunited_template_args['no_links'] ) ) {
                    the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                } else {
                    the_title( '<h4 class="post_title entry-title">', '</h4>' );
                }
                ?>
            </div><!-- .entry-header -->
            <?php
        }
        ?>

        <div class="post_content entry-content">
            <?php
            if ( empty( $fcunited_template_args['hide_excerpt'] ) && ! empty( fcunited_get_theme_option( 'excerpt_length' ) ) && fcunited_get_theme_option( 'excerpt_length' ) > 0 ) {
                // Post content area
                fcunited_show_post_content( $fcunited_template_args, '<div class="post_content_inner">', '</div>' );
            }

            // Post meta
            if ( in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
                if ( ! empty( $fcunited_components ) ) {
                    fcunited_show_post_meta(
                        apply_filters(
                            'fcunited_filter_post_meta_args', array(
                                'components' => $fcunited_components,
                            ), $fcunited_blog_style[0], $fcunited_columns
                        )
                    );
                }
            }

            // More button
            if ( empty( $fcunited_template_args['no_links'] ) && ! empty( $fcunited_template_args['more_text'] ) && ! in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
                fcunited_show_post_more_link( $fcunited_template_args, '<p>', '</p>' );
            }
            ?>
        </div><!-- .entry-content -->
    </div>
</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
