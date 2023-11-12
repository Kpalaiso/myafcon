<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.14
 */
$fcunited_header_video = fcunited_get_header_video();
$fcunited_embed_video  = '';
if ( ! empty( $fcunited_header_video ) && ! fcunited_is_from_uploads( $fcunited_header_video ) ) {
	if ( fcunited_is_youtube_url( $fcunited_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $fcunited_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php fcunited_show_layout( fcunited_get_embed_video( $fcunited_header_video ) ); ?></div>
		<?php
	}
}
