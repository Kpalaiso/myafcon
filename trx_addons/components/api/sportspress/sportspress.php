<?php
/**
 * Plugin support: SportsPress
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
    wp_die( '-1' );
}

// Check if plugin installed and activated
// Attention! This function is used in many files and was moved to the api.php

if ( !function_exists( 'fcunited_exists_sportspress' ) ) {
    function fcunited_exists_sportspress() {
        return  class_exists( 'SportsPress' );
    }
}


// Demo data install
//----------------------------------------------------------------------------

// One-click import support
if ( is_admin() ) {

// Check plugin in the required plugins
    if ( !function_exists( 'fcunited_sportspress_importer_required_plugins' ) ) {
        add_filter( 'trx_addons_filter_importer_required_plugins',  'fcunited_sportspress_importer_required_plugins', 10, 2 );
        function fcunited_sportspress_importer_required_plugins($not_installed='', $list='') {
            if (strpos($list, 'sportspress')!==false && !fcunited_exists_sportspress() )
                $not_installed .= '<br>' . esc_html__('SportsPress', 'fcunited');
            return $not_installed;
        }
    }

// Set plugin's specific importer options
    if ( !function_exists( 'fcunited_sportspress_importer_set_options' ) ) {
        add_filter( 'trx_addons_filter_importer_options',   'fcunited_sportspress_importer_set_options' );
        function fcunited_sportspress_importer_set_options($options=array()) {
            if ( fcunited_exists_sportspress() && in_array('sportspress', $options['required_plugins']) ) {
                $options['additional_options'][]    = 'sportspress_%';
                $options['additional_options'][]    = 'taxonomy_%';
            }
            return $options;
        }
    }

// Add checkbox to the one-click importer
    if ( !function_exists( 'fcunited_sportspress_importer_show_params' ) ) {
        add_action( 'trx_addons_action_importer_params',    'fcunited_sportspress_importer_show_params', 10, 1 );
        function fcunited_sportspress_importer_show_params($importer) {
            if ( fcunited_exists_sportspress() && in_array('sportspress', $importer->options['required_plugins']) ) {
                $importer->show_importer_params(array(
                    'slug' => 'sportspress',
                    'title' => esc_html__('Import SportsPress', 'fcunited'),
                    'part' => 0
                ));
            }
        }
    }

// Check if the row will be imported
    if ( !function_exists( 'fcunited_sportspress_importer_check_row' ) ) {
        add_filter('trx_addons_filter_importer_import_row', 'fcunited_sportspress_importer_check_row', 9, 4);
        function fcunited_sportspress_importer_check_row($flag, $table, $row, $list) {
            if ($flag || strpos($list, 'sportspress')===false) return $flag;
            if ( fcunited_exists_sportspress() ) {
                if ($table == 'posts')
                    $flag = in_array($row['post_type'], array('sp_result', 'sp_outcome', 'sp_column', 'sp_metric', 'sp_performance', 'sp_statistic', 'sp_event', 'sp_team', 'sp_player', 'sp_staff' ));
            }
            return $flag;
        }
    }

}