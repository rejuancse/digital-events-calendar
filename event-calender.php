<?php
/*
* Plugin Name: Event Calender
* Author: Rejuan Ahamed
* License - GNU/GPL V2 or Later
* Description: Event Calender is a all events calender listing.
* Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; # Exit if accessed directly
}

# language
add_action( 'init', 'event_calender_language_load' );
function event_calender_language_load(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'event-calender', false, $plugin_dir );
}

# Post Type
include_once( 'post-type/event.php' );

// # Metabox Include
include_once( 'post-type/meta_box.php' );
include_once( 'post-type/meta-box/meta-box.php' );
include_once( 'post-type/meta-box-group/meta-box-group.php' );



# Add CSS for Frontend
add_action( 'wp_enqueue_scripts', 'event_calender_style' );
if(!function_exists('event_calender_style')):
function event_calender_style(){
    # CSS
    wp_enqueue_style('event-calender',plugins_url('assets/css/event-calender.css',__FILE__));

    # JS
    wp_enqueue_script('eventcalendar_main',plugins_url('assets/js/main.js',__FILE__), array('jquery'));

    wp_enqueue_script( 'eventcalendar_main' );
    wp_localize_script( 'eventcalendar_main', 'ajax_objects', array( 
        'ajaxurl'           => admin_url( 'admin-ajax.php' ),
        'redirecturl'       => home_url('/'),
        'loadingmessage'    => __('Sending user info, please wait...','ecalendar'),
        'ajax_nonce'        => wp_create_nonce('calendar-demo-nonce')
    ));
}
endif;

function event_calender_load_admin_assets() {
    wp_enqueue_script( 'calender-admin', plugins_url('assets/js/admin.js', __FILE__), array('jquery') );
}
add_action( 'admin_enqueue_scripts', 'event_calender_load_admin_assets' );



# Calender Shortcode
function event_calender_func( $atts ) {
    include_once ( 'lib/calendar.php' );
    $calendar = new Calendar();
    $event_calender = $calendar->show();  
    echo $event_calender; 
}
add_shortcode( 'event_calender', 'event_calender_func' );




/*-------------------------------------------------------
*       Next and Previous Month of Events Calendar
*-------------------------------------------------------- */
function ecalendar_displaynextmonth(){
    check_ajax_referer( 'calendar-demo-nonce', '_nonce' );
    if( isset($_POST['nextmonth']) && isset($_POST['nextyear']) ){
        include_once ( 'lib/calendar.php' );
        $calendar_next = new Calendar();
        $nextmonth  = $_POST['nextmonth'];
        $nextyear   = $_POST['nextyear'];
        echo $calendar_next->ecalendar_nextprevious_month( $nextmonth, $nextyear );   
    }
    wp_die();
}
add_action('wp_ajax_ecalendar_displaynextmonth', 'ecalendar_displaynextmonth');
add_action('wp_ajax_nopriv_ecalendar_displaynextmonth', 'ecalendar_displaynextmonth');
