<?php
/*
* Plugin Name:       Digital Events Calendar
* Plugin URI:        https://demo.rejuandev.live/event-calender/
* Description:       Event Calender is a all events calender listing.
* Version:           1.0.1
* Author:            Rejuan Ahamed
* Author URI:        https://rejuandev.live/
* Text Domain:       event-calender
* Requires at least: 4.5
* Tested up to:      5.4
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Domain Path:       /languages
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