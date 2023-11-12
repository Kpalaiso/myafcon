<?php
/**
 * The template 'Style 2' to displaying related posts
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
			'thumb_size'    => apply_filters( 'fcunited_filter_related_thumb_size', fcunited_get_thumb_size( (int) fcunited_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'extra' ) ),
			'show_no_image' => fcunited_get_no_image() != '',
            'thumb_ratio'   => '600:394',
		)
	);
	?>
	<div class="post_header entry-header">
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
            fcunited_show_post_meta(
                apply_filters(
                    'fcunited_filter_post_meta_args', array(
                    'components' => 'categories,date',
                    'seo'        => false,
                ), 'related', 1
                )
            );
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $fcunited_link ); ?>"><?php the_title(); ?></a></h6>
        <?php
        $fcunited_template_args['excerpt_length'] = 19;
        fcunited_show_post_content( $fcunited_template_args, '<div class="post_content_inner">', '</div>' );
        ?>
	</div>
</div>