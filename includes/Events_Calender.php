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

        add_action( 'wp_head', array( $this, 'style_custom_css' ) );
		add_action( 'wp_ajax_edisplaynextmonth', array( $this, 'event_display_nextmonth' ) );
        add_action( 'wp_ajax_nopriv_edisplaynextmonth', array( $this, 'event_display_nextmonth' ) );
	}

	# Custom css style.
	public function style_custom_css() {
		require_once DEC_DIR_PATH.'includes/compatibility/Admin_Menu.php';
	}

	# Include Shortcode
	public function include_shortcode() {
		include_once DEC_DIR_PATH.'shortcode/Calender.php';
		include_once DEC_DIR_PATH.'shortcode/Events_List.php';
		include_once DEC_DIR_PATH.'shortcode/Upcoming_Events.php';
		include_once DEC_DIR_PATH.'shortcode/Past_Events.php';

		$dec_calender 	= new \DEC\shortcode\Calendar();
		$event_listing 	= new \DEC\shortcode\Event_Listing();
		$upcoming_events 	= new \DEC\shortcode\Upcoming_Events();
		$past_events 	= new \DEC\shortcode\Past_Events();

		# require file for compatibility
		require_once DEC_DIR_PATH.'includes/compatibility/Shortcodes.php';
	}

	# Display next/pre month.
	public function event_display_nextmonth() {
		if( isset($_POST['nextmonth']) && isset($_POST['nextyear']) ){
	        check_ajax_referer( 'event-calendar-nonce', '_nonce' );
	        require_once DEC_DIR_PATH . 'lib/calendar.php';
	        $calendar_shortcode = new \DEC\lib\Calendar_Shortcode();
	        $nextmonth  = sanitize_text_field($_POST['nextmonth']);
	        $nextyear   = (int) sanitize_text_field($_POST['nextyear']);

    		echo $calendar_shortcode->showCalender( $nextmonth, $nextyear );
	    }
	    wp_die();
	}
}
