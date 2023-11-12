<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

// Page (category, tag, archive, author) title

if ( fcunited_need_page_title() ) {
	fcunited_sc_layouts_showed( 'title', true );
	fcunited_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_left">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								fcunited_show_post_meta(
									apply_filters(
										'fcunited_filter_post_meta_args', array(
											'components' => fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'meta_parts' ) ),
											'counters'   => fcunited_array_get_keys_by_value( fcunited_get_theme_option( 'counters' ) ),
											'seo'        => fcunited_is_on( fcunited_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$fcunited_blog_title           = fcunited_get_blog_title();
							$fcunited_blog_title_text      = '';
							$fcunited_blog_title_class     = '';
							$fcunited_blog_title_link      = '';
							$fcunited_blog_title_link_text = '';
							if ( is_array( $fcunited_blog_title ) ) {
								$fcunited_blog_title_text      = $fcunited_blog_title['text'];
								$fcunited_blog_title_class     = ! empty( $fcunited_blog_title['class'] ) ? ' ' . $fcunited_blog_title['class'] : '';
								$fcunited_blog_title_link      = ! empty( $fcunited_blog_title['link'] ) ? $fcunited_blog_title['link'] : '';
								$fcunited_blog_title_link_text = ! empty( $fcunited_blog_title['link_text'] ) ? $fcunited_blog_title['link_text'] : '';
							} else {
								$fcunited_blog_title_text = $fcunited_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $fcunited_blog_title_class ); ?>">
								<?php
								$fcunited_top_icon = fcunited_get_term_image_small();
								if ( ! empty( $fcunited_top_icon ) ) {
									$fcunited_attr = fcunited_getimagesize( $fcunited_top_icon );
									?>
									<img src="<?php echo esc_url( $fcunited_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'fcunited' ); ?>"
										<?php
										if ( ! empty( $fcunited_attr[3] ) ) {
											fcunited_show_layout( $fcunited_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_post( $fcunited_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $fcunited_blog_title_link ) && ! empty( $fcunited_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $fcunited_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $fcunited_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						?>
						<div class="sc_layouts_title_breadcrumbs">
							<?php
							do_action( 'fcunited_action_breadcrumbs' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
