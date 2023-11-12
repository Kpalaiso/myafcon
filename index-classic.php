<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

fcunited_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	fcunited_blog_archive_start();

	$fcunited_classes    = 'posts_container '
						. ( substr( fcunited_get_theme_option( 'blog_style' ), 0, 7 ) == 'classic'
							? 'columns_wrap columns_padding_bottom'
							: 'masonry_wrap'
							);
	$fcunited_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$fcunited_sticky_out = fcunited_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $fcunited_stickies ) && count( $fcunited_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $fcunited_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $fcunited_sticky_out ) {
		if ( fcunited_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( fcunited_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}

		?>
		<div class="<?php echo esc_attr( $fcunited_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $fcunited_sticky_out && ! is_sticky() ) {
			$fcunited_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $fcunited_classes ); ?>">
			<?php
		}
		$fcunited_part = $fcunited_sticky_out && is_sticky() ? 'sticky' : 'classic';
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', $fcunited_part ), $fcunited_part );
	}

	?>
	</div>
	<?php

	fcunited_show_pagination();

	fcunited_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
