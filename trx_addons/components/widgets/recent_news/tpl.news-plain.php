<?php
/**
 * The "Plain" template to show post's content
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

$grid = array(
    array('full'),
    array('big', 'small'),
    array('big', 'small', 'small'),
    array('big', 'small', 'small', 'small'),
    array('big', 'small', 'small', 'small', 'small'),
    array('big', 'small', 'small', 'small', 'small', 'small'),
    array('big', 'small', 'small', 'small', 'small', 'small', 'small'),
    array('big', 'small', 'small', 'small', 'small', 'small', 'small', 'small'),
);
$thumb_size = $grid[$count-$number >= 8 ? 8 : ($count-1)%8][($number-1)%8];
if((int)$number == 1) {
    echo '<div class="recent_news_wrap_posts">';
}
if((int)$number == 2) {
    echo '<div class="left_wrap_posts">';
}

?><article
<?php post_class( 'post_item post_layout_'.esc_attr($style)
    .' post_format_'.esc_attr($post_format)
    .' post_size_'.esc_attr($thumb_size)
); ?>
<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
    >

<?php
if ( is_sticky() && is_home() && !is_paged() ) {
    ?><span class="post_label label_sticky"></span><?php
}

trx_addons_get_template_part('templates/tpl.featured.php',
    'trx_addons_args_featured',
    apply_filters('trx_addons_filter_args_featured', array(
        'post_info' => ($number == 1 && $count != $number ? (
                ($post_format == 'video' ? '<a href="'.esc_url(get_permalink()).'" class="icons"></a>' : '')
                . '<div class="post_info">'
                . ( in_array( get_post_type(), array( 'post', 'attachment' ) )
                ? '<div class="post_meta">'
                . '<span class="post_date"><a href="'.esc_url(get_permalink()).'">'.get_the_date().'</a></span>'
                . '</div>'
                : '')
            . '<h5 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.wp_kses_post( get_the_title() ).'</a></h5>'
            . '</div>') : ''),
        'thumb_bg' => ($number == 1 && $count != $number ? true : false),
        'thumb_size' => fcunited_get_thumb_size($number == 1 ? ($thumb_size == 'full' ? 'full' : 'huge') : 'plain'),
        'thumb_only' => true
    ), 'recent_news-plain')
);

if($number != 1 ) {
    ?>
    <div class="post_info">
        <div class="post_meta">
            <span class="post_meta_item post_date"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_date()); ?></a></span>
        </div>
        <h5 class="post_title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
        <?php
        $template_args['excerpt_length'] = 11;
        fcunited_show_post_content( $template_args, '<div class="post_content_inner">', '</div>' );
        ?>
    </div>
<?php }
?>
    </article>
<?php
if((int)$number > 1 && $count == $number) {
    echo '</div>';
}
if($count == $number) {
    echo '</div>';
}
?>