<?php
/*
* Plugin Name: Digital Events Calendar
* Author: Rejuan Ahamed
* Description: Event Calender is a all events calender listing.
* License - GNU/GPL V2 or Later
* Version: 1.0.0
* Text Domain: event-calender
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; # Exit if accessed directly
}

define( 'DEC_FILE', __FILE__ );
define( 'DEC_VERSION', '1.0.0' );
define( 'DEC_URI', plugin_dir_url( DEC_FILE ) ); 
define( 'DEC_DIR_PATH', plugin_dir_path( DEC_FILE  ));
define( 'DEC_PLUGIN_DIR', untrailingslashit( plugin_dir_path( DEC_FILE ) ) );

require_once dirname( __FILE__ ) . '/includes/digital-event-calendar.php';
function DEC() { 
	return Digital_Event_Calendar::instance();
}
$GLOBALS['digital_event_calendar'] = DEC();

if (!class_exists( 'Events_Calender' )) {
    require_once DEC_DIR_PATH . 'includes/Events_Calender.php';
    new \DEC\Events_Calender();
}