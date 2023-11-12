<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

$fcunited_template_args = get_query_var( 'fcunited_template_args' );
if ( is_array( $fcunited_template_args ) ) {
	$fcunited_columns    = empty( $fcunited_template_args['columns'] ) ? 1 : max( 1, $fcunited_template_args['columns'] );
	$fcunited_blog_style = array( $fcunited_template_args['type'], $fcunited_columns );
	if ( ! empty( $fcunited_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $fcunited_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $fcunited_columns ); ?>">
		<?php
	}
}
$fcunited_expanded    = ! fcunited_sidebar_present() && fcunited_is_on( fcunited_get_theme_option( 'expand_content' ) );
$fcunited_post_format = get_post_format();
$fcunited_post_format = empty( $fcunited_post_format ) ? 'standard' : str_replace( 'post-format-', '', $fcunited_post_format );
$fcunited_animation   = fcunited_get_theme_option( 'blog_animation' );
?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $fcunited_post_format ) ); ?>
	<?php echo ( ! fcunited_is_off( $fcunited_animation ) && empty( $fcunited_template_args['slider'] ) ? ' data-animation="' . esc_attr( fcunited_get_animation_classes( $fcunited_animation ) ) . '"' : '' ); ?>
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
			'no_links'   => ! empty( $fcunited_template_args['no_links'] ),
			'hover'      => $fcunited_hover,
			'thumb_size' => fcunited_get_thumb_size( strpos( fcunited_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $fcunited_expanded ? 'huge' : 'big' ) ),
		)
	);

	if( in_array($fcunited_post_format, array('link', 'aside', 'status', 'quote')) && fcunited_get_theme_option( 'blog_content' ) != 'fullpost' ) {
	    fcunited_show_post_content( $fcunited_template_args, '<div class="post_content_inner">', '</div>' );
	}

    ?>
    <div class="post_layout_excerpt_wrap">
    <?php
    $go_link = false;
	// Title and post meta
	if ( get_the_title() != '' ) {
		?>
		<div class="post_header entry-header">
			<?php

			do_action( 'fcunited_action_before_post_meta' );

			// Post meta
			$fcunited_components = fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) );

			if ( ! empty( $fcunited_components ) && ! in_array( $fcunited_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				fcunited_show_post_meta(
					apply_filters(
						'fcunited_filter_post_meta_args', array(
							'components' => $fcunited_components,
							'seo'        => false,
						), 'excerpt', 1
					)
				);
			}

			do_action( 'fcunited_action_before_post_title' );

			// Post title
			if ( empty( $fcunited_template_args['no_links'] ) ) {
				the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			} else {
				the_title( '<h2 class="post_title entry-title">', '</h2>' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	} else {
	    $go_link = true;
	}

	// Post content
	if ( ! in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) && fcunited_get_theme_option( 'blog_content' ) != 'fullpost' &&
	        empty( $fcunited_template_args['hide_excerpt'] ) && ! empty( fcunited_get_theme_option( 'excerpt_length' ) ) && fcunited_get_theme_option( 'excerpt_length' ) > 0 ) {
		?>
		<div class="post_content entry-content">
			<?php
			if ( fcunited_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'fcunited_action_before_full_post_content' );
					the_content( '' );
					do_action( 'fcunited_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'fcunited' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'fcunited' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				fcunited_show_post_content( $fcunited_template_args, '<div class="post_content_inner">', '</div>' );
				// More button
				if ( $go_link && ! in_array( $fcunited_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
					fcunited_show_post_more_link( $fcunited_template_args, '<p>', '</p>' );
				}
			}
			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
	</div>
</article>
<?php

if ( is_array( $fcunited_template_args ) ) {
	if ( ! empty( $fcunited_template_args['slider'] ) || $fcunited_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
