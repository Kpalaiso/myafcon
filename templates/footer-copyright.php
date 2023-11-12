<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
if ( ! fcunited_is_inherit( fcunited_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( fcunited_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$fcunited_copyright = fcunited_get_theme_option( 'copyright' );
			if ( ! empty( $fcunited_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$fcunited_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $fcunited_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$fcunited_copyright = fcunited_prepare_macros( $fcunited_copyright );
				// Display copyright
				echo wp_kses( nl2br( $fcunited_copyright ), 'fcunited_kses_content'  );
			}
			?>
			</div>
		</div>
	</div>
</div>
