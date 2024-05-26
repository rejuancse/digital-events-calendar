<?php
/*
* Plugin Name:       Digital Events Calendar
* Description:       Digital Events Calendar is an extensible plugin that lets you easily manage events by the calendar. Nice. Solid. Awesome. This will blow your mind.
* Author:            Rejuan Ahamed
* Text Domain:       event-calender
* Version:           1.0.6
* Requires at least: 5.9
* Tested up to:      6.1
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Domain Path:       /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; # Exit if accessed directly
}

define( 'DEC_FILE', __FILE__ );
define( 'DEC_VERSION', '1.0.6' );
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
