<?php
/**
 * The "Line" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = min(8, $widget_args['number']);
$count = min(8, $widget_args['count']);
$columns = $widget_args['columns'];
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');


?><article
<?php post_class( 'post_item post_layout_'.esc_attr($style)
    .' post_format_'.esc_attr($post_format)
); ?>
<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
    >
    <h5 class="post_title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
    <div class="post_meta">
        <span class="post_meta_item post_date"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_date('l, F j, Y')); ?></a></span>
    </div>
</article>