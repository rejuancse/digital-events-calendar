<?php
namespace DEC;

defined( 'ABSPATH' ) || exit;

final class Events_Calender {

	protected static $_instance = null;
	private $events;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		include_once DEC_DIR_PATH.'includes/metabox/Events.php';

		$this->include_shortcode();
		$this->events = new \DEC\EVENT\Events();

		add_action( 'wp_ajax_edisplaynextmonth', array( $this, 'event_display_nextmonth' ) );
        add_action( 'wp_ajax_nopriv_edisplaynextmonth', array( $this, 'event_display_nextmonth' ) );
	}
	
	# Include Shortcode
	public function include_shortcode() {
		include_once DEC_DIR_PATH.'shortcode/Calender.php';
		$dec_calender = new \DEC\shortcode\Calendar();

		# require file for compatibility
		require_once DEC_DIR_PATH.'includes/compatibility/Shortcodes.php';
	}

	# Display next/pre month.
	public function event_display_nextmonth() {
		if( isset($_POST['nextmonth']) && isset($_POST['nextyear']) ){
	        check_ajax_referer( 'event-calendar-nonce', '_nonce' );
	        require_once DEC_DIR_PATH . 'lib/calendar.php';
	        $calendar_shortcode = new \DEC\lib\Calendar_Shortcode();
	        $nextmonth  = $_POST['nextmonth'];
	        $nextyear   = $_POST['nextyear'];

    		echo $calendar_shortcode->showCalender( $nextmonth, $nextyear ); 
	    } 
	    wp_die();
	}
	
}