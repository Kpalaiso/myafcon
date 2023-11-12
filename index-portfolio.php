<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

fcunited_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	fcunited_blog_archive_start();

	$fcunited_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$fcunited_sticky_out = fcunited_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $fcunited_stickies ) && count( $fcunited_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$fcunited_cat          = fcunited_get_theme_option( 'parent_cat' );
	$fcunited_post_type    = fcunited_get_theme_option( 'post_type' );
	$fcunited_taxonomy     = fcunited_get_post_type_taxonomy( $fcunited_post_type );
	$fcunited_show_filters = fcunited_get_theme_option( 'show_filters' );
	$fcunited_tabs         = array();
	if ( ! fcunited_is_off( $fcunited_show_filters ) ) {
		$fcunited_args           = array(
			'type'         => $fcunited_post_type,
			'child_of'     => $fcunited_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $fcunited_taxonomy,
			'pad_counts'   => false,
		);
		$fcunited_portfolio_list = get_terms( $fcunited_args );
		if ( is_array( $fcunited_portfolio_list ) && count( $fcunited_portfolio_list ) > 0 ) {
			$fcunited_tabs[ $fcunited_cat ] = esc_html__( 'All', 'fcunited' );
			foreach ( $fcunited_portfolio_list as $fcunited_term ) {
				if ( isset( $fcunited_term->term_id ) ) {
					$fcunited_tabs[ $fcunited_term->term_id ] = $fcunited_term->name;
				}
			}
		}
	}
	if ( count( $fcunited_tabs ) > 0 ) {
		$fcunited_portfolio_filters_ajax   = true;
		$fcunited_portfolio_filters_active = $fcunited_cat;
		$fcunited_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters fcunited_tabs fcunited_tabs_ajax">
			<ul class="portfolio_titles fcunited_tabs_titles">
				<?php
				foreach ( $fcunited_tabs as $fcunited_id => $fcunited_title ) {
					?>
					<li><a href="<?php echo esc_url( fcunited_get_hash_link( sprintf( '#%s_%s_content', $fcunited_portfolio_filters_id, $fcunited_id ) ) ); ?>" data-tab="<?php echo esc_attr( $fcunited_id ); ?>"><?php echo esc_html( $fcunited_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$fcunited_ppp = fcunited_get_theme_option( 'posts_per_page' );
			if ( fcunited_is_inherit( $fcunited_ppp ) ) {
				$fcunited_ppp = '';
			}
			foreach ( $fcunited_tabs as $fcunited_id => $fcunited_title ) {
				$fcunited_portfolio_need_content = $fcunited_id == $fcunited_portfolio_filters_active || ! $fcunited_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $fcunited_portfolio_filters_id, $fcunited_id ) ); ?>"
					class="portfolio_content fcunited_tabs_content"
					data-blog-template="<?php echo esc_attr( fcunited_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( fcunited_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $fcunited_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $fcunited_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $fcunited_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $fcunited_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $fcunited_cat ); ?>"
					data-need-content="<?php echo ( false === $fcunited_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $fcunited_portfolio_need_content ) {
						fcunited_show_portfolio_posts(
							array(
								'cat'        => $fcunited_id,
								'parent_cat' => $fcunited_cat,
								'taxonomy'   => $fcunited_taxonomy,
								'post_type'  => $fcunited_post_type,
								'page'       => 1,
								'sticky'     => $fcunited_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		fcunited_show_portfolio_posts(
			array(
				'cat'        => $fcunited_cat,
				'parent_cat' => $fcunited_cat,
				'taxonomy'   => $fcunited_taxonomy,
				'post_type'  => $fcunited_post_type,
				'page'       => 1,
				'sticky'     => $fcunited_sticky_out,
			)
		);
	}

	fcunited_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
