<?php
namespace DEC\lib;

class Events_Listing_Shortcode { 

    /**
    * Constructor 
    */
    public function __construct(){     
        // $this->naviHref = htmlentities($_SERVER['PHP_SELF']);     
    }

    /*------------------ PUBLIC *------------------*/    
    /**
    * Print out the calendar 
    */
    public function events_show() {

        $content = '';
        $content .= '<div class="upcoming-events">';
            $content .= 'AAA';
        $content .='</div>';
                 
        return $content;   
    }
 


}
