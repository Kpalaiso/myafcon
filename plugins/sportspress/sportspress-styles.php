<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'fcunited_sportspress_get_css' ) ) {
	add_filter( 'fcunited_filter_get_css', 'fcunited_sportspress_get_css', 10, 2 );
	function fcunited_sportspress_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
            $fonts['h5_font-family!'] = str_replace(';', ' !important;', $fonts['h5_font-family']);
            $fonts['p_font-family!'] = str_replace(';', ' !important;', $fonts['p_font-family']);
			$css['fonts'] .= <<<CSS

.sc_blogger_line .player-number,
.sp-template-details.sp-template-player-details dt,
.sp-template-details.sp-template-staff-details dt {
    {$fonts['h5_font-family']}
}
.sp-countdown-wrapper .countdown.sp-countdown time span,
.sp-data-table.sp-event-performance .data-number,
.sp-template-event-blocks .sp-event-results *,
.sp-template-event-blocks .sp-event-results,
.sp-data-table th,
.sp-table-caption,
.sp-template h1, .sp-template h2, .sp-template h3, .sp-template h4, .sp-template h5, .sp-template h6, .sp-data-table h1, .sp-data-table h2, .sp-data-table h3, .sp-data-table h4, .sp-data-table h5, .sp-data-table h6, .sp-table-caption h1, .sp-table-caption h2, .sp-table-caption h3, .sp-table-caption h4, .sp-table-caption h5, .sp-table-caption h6 {
    {$fonts['h5_font-family!']}
}
.sp-template-countdown .sp-event-venue, .sp-template-countdown .sp-event-league, .sp-template-countdown .sp-event-date {
    {$fonts['p_font-family!']}
}
.sp-template-countdown .sp-event-name > a:not(.team-logo),
.sp-countdown-wrapper .countdown.sp-countdown time span small,
.sp-template-event-blocks .sp-event-title a,
.sp-template, .sp-data-table, .sp-table-caption {
    {$fonts['p_font-family']}
}


CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS


CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS


.sc_blogger_line .meta-role-wrap span {
    color: {$colors['text_link']};
}
.sp-template *, .sp-data-table *, .sp-table-caption {
  color: {$colors['text']} !important;
}
.sp-table-caption,
.sp-template-details.sp-template-player-details dd,
.sp-template-details.sp-template-player-details dt,
.sp-template-details.sp-template-staff-details dd,
.sp-template-details.sp-template-staff-details dt {
    color: {$colors['text_dark']} !important;
}
.sp-data-table td {
    color: {$colors['text_dark']} !important;
}
.sp-data-table th {
    color: {$colors['text_dark']} !important;
    background: {$colors['alter_bg_hover']} !important;
}
.sp-data-table tr + tr {
    border-color: {$colors['bd_color']} !important;
}
.sp-template-event-blocks .sp-event-results span,
.sp-template-event-blocks .sp-event-results,
.sp-template-event-blocks .sp-event-results a:hover,
.sp-template-event-blocks .sp-event-results a,
.sp-template-event-blocks .sp-event-season,
.sp-template-event-blocks .sp-event-league,
.sp-template-event-blocks .sp-event-date,
.sp-template-event-blocks .sp-event-title a,
.sp-template-event-blocks .sp-event-title,
.sp-template-event-blocks .sp-event-status,
.sp-template-event-logos .sp-team-name,
.sp-template-event-logos .sp-team-result {
    color: {$colors['text_dark']} !important;
}

.sp-template a, .sp-data-table a {
    color: {$colors['text_dark']} !important;
}
.sp-template a:hover, .sp-data-table a:hover {
    color: {$colors['text_link']} !important;
}

.sp-template-staff-details .sp-staff-details a,
.sp-template-player-details .sp-player-details a,
.sp_event .sp-template-event-staff .sp-event-staff,
.sp-data-table.sp-event-performance .data-name .sp-player-position {
    color: {$colors['text_link']} !important;
}
.sp-template-staff-details .sp-staff-details a:hover,
.sp-template-player-details .sp-player-details a:hover,
.sp_event .sp-template-event-staff .sp-event-staff a {
    color: {$colors['text_dark']} !important;
}
.sp_event .sp-template-event-staff .sp-event-staff a:hover {
    color: {$colors['text_link']} !important;
}
.extra-event-block .elementor-container,
.post_type_sp_team .sp-template-team-details .sp-team-details,
.sp-template.sp-template-event-blocks {
    background: {$colors['bg_color']} !important;
}

.sp-template-countdown .sp-event-venue, .sp-template-countdown .sp-event-league, .sp-template-countdown .sp-event-date,
.post_type_sp_team .sp-template-team-details .sp-team-details * {
    color: {$colors['text_dark']} !important;
}

.extra-event-block .elementor-row > .elementor-element + .elementor-element:before {
    background: {$colors['bd_color']};
}

.sp-countdown-wrapper .countdown.sp-countdown time span {
    color: {$colors['text_dark']} !important;
}
.sp-countdown-wrapper .countdown.sp-countdown time span small {
    color: {$colors['text']} !important;
}

.extra-countdown.top-style-2,
.extra-countdown.top-style {
    background: {$colors['bd_color']};
}
.extra-countdown.top-style-2 .widget_title,
.extra-countdown.top-style .widget_title {
    color: {$colors['text_link']} !important;
}

.sp-countdown time {
    border-color: {$colors['bd_color']} !important;
}

.sp-template-details.sp-template-staff-details dl,
.sp-template-details.sp-template-player-details dl {
    background: {$colors['bg_color']} !important;
}
.sp-template-details.sp-template-staff-details dd,
.sp-template-details.sp-template-player-details dd {
    border-color: {$colors['alter_bg_hover']} !important;
}


CSS;
		}

		return $css;
	}
}

