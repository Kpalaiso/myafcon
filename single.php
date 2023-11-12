<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0
 */

get_header();

while ( have_posts() ) {
	the_post();

	// Prepare theme-specific vars:

	// Position of the related posts
	$fcunited_related_position = fcunited_get_theme_option( 'related_position' );

	// Type of the prev/next posts navigation
	$fcunited_posts_navigation = fcunited_get_theme_option( 'posts_navigation' );
	if ( 'scroll' == $fcunited_posts_navigation ) {
		$fcunited_prev_post = get_previous_post( true );         // Get post from same category
		if ( ! $fcunited_prev_post ) {
			$fcunited_prev_post = get_previous_post( false );    // Get post from any category
			if ( ! $fcunited_prev_post ) {
				$fcunited_posts_navigation = 'links';
			}
		}
		// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
		if ( $fcunited_prev_post && fcunited_get_value_gp( 'action' ) == 'prev_post_loading' ) {
			fcunited_storage_set_array( 'options_meta', 'post_thumbnail_type', 'default' );
			if ( fcunited_get_theme_option( 'post_header_position' ) != 'below' ) {
				fcunited_storage_set_array( 'options_meta', 'post_header_position', 'above' );
			}
			fcunited_sc_layouts_showed( 'featured', false );
			fcunited_sc_layouts_showed( 'title', false );
			fcunited_sc_layouts_showed( 'postmeta', false );
		}
	}

	// If related posts should be inside the content
	if ( strpos( $fcunited_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'content', get_post_format() ), get_post_format() );

	// If related posts should be inside the content
	if ( strpos( $fcunited_related_position, 'inside' ) === 0 ) {
		$fcunited_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'fcunited_action_related_posts' );
		$fcunited_related_content = ob_get_contents();
		ob_end_clean();

		$fcunited_related_position_inside = max( 0, min( 9, fcunited_get_theme_option( 'related_position_inside' ) ) );
		if ( 0 == $fcunited_related_position_inside ) {
			$fcunited_related_position_inside = mt_rand( 1, 9 );
		}
		
		$fcunited_p_number = 0;
		$fcunited_related_inserted = false;
		for ( $i = 0; $i < strlen( $fcunited_content ) - 3; $i++ ) {
			if ( $fcunited_content[ $i ] == '<' && $fcunited_content[ $i + 1 ] == 'p' && in_array( $fcunited_content[ $i + 2 ], array( '>', ' ' ) ) ) {
				$fcunited_p_number++;
				if ( $fcunited_related_position_inside == $fcunited_p_number ) {
					$fcunited_related_inserted = true;
					$fcunited_content = ( $i > 0 ? substr( $fcunited_content, 0, $i ) : '' )
										. $fcunited_related_content
										. substr( $fcunited_content, $i );
				}
			}
		}
		if ( ! $fcunited_related_inserted ) {
			$fcunited_content .= $fcunited_related_content;
		}

		fcunited_show_layout( $fcunited_content );
	}

	// Author bio
	if ( fcunited_get_theme_option( 'show_author_info' ) == 1
		&& ! is_attachment()
		&& get_the_author_meta( 'description' )
		&& ( 'scroll' != $fcunited_posts_navigation || fcunited_get_theme_option( 'posts_navigation_scroll_hide_author' ) == 0 )
	) {
		do_action( 'fcunited_action_before_post_author' );
		get_template_part( apply_filters( 'fcunited_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'fcunited_action_after_post_author' );
	}

	// Previous/next post navigation.
	if ( 'links' == $fcunited_posts_navigation ) {
		do_action( 'fcunited_action_before_post_navigation' );
		?>
		<div class="nav-links-single<?php
			if ( ! fcunited_is_off( fcunited_get_theme_option( 'posts_navigation_fixed' ) ) ) {
				echo ' nav-links-fixed fixed';
			}
		?>">
			<?php
			the_post_navigation(
				array(
					'next_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'fcunited' ) . '</span> '
						. '<h6 class="post-title">%title</h6>',
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'fcunited' ) . '</span> '
						. '<h6 class="post-title">%title</h6>',
				)
			);
			?>
		</div>
		<?php
		do_action( 'fcunited_action_after_post_navigation' );
	}

	// Related posts
	if ( 'below_content' == $fcunited_related_position && ( 'scroll' != $fcunited_posts_navigation || fcunited_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 ) ) {
	    do_action( 'fcunited_action_related_posts' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( ( comments_open() || get_comments_number() ) && ( 'scroll' != $fcunited_posts_navigation || fcunited_get_theme_option( 'posts_navigation_scroll_hide_comments' ) == 0 ) ) {
		do_action( 'fcunited_action_before_comments' );
		comments_template();
		do_action( 'fcunited_action_after_comments' );
	}

	if ( 'scroll' == $fcunited_posts_navigation ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $fcunited_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $fcunited_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $fcunited_prev_post ) ); ?>">
		</div>
		<?php
	}
}

get_footer();
