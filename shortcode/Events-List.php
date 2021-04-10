<?php
namespace DEC\shortcode;

defined( 'ABSPATH' ) || exit;

class Event_Listing {

    function __construct() {
        add_shortcode( 'events_list', array( $this, 'event_list_callback' ) );
    }

    function event_list_callback( $atts, $shortcode ){  
        $output = '';
	    $output .=' <div class="container">';
	        require_once DEC_DIR_PATH . 'lib/events-listing.php';
	        $Events_Listing_Shortcode = new \DEC\lib\Events_Listing_Shortcode();
    		$output .= $Events_Listing_Shortcode->events_show();                
	    $output .= '</div>';

		return $output;
    }
}