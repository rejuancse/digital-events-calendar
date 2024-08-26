<?php
namespace DEC\shortcode;

defined( 'ABSPATH' ) || exit;

class Calendar {

    function __construct() {
        add_shortcode( 'event_calender', array( $this, 'calender_callback' ) );
    }

    function calender_callback( $atts, $shortcode ){
        $output = '';

	    $output .=' <div class="container" id="calendar_area">';
            $output .=' <div class="row">';
                $output .=' <div class="col-md-12">';
                    require_once DEC_DIR_PATH . 'lib/calendar.php';
                    $Calendar_Shortcode = new \DEC\lib\Calendar_Shortcode();
                    $output .= $Calendar_Shortcode->show();
                $output .= '</div>';
            $output .= '</div>';
	    $output .= '</div>';

		return $output;
    }
}
