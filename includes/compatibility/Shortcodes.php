<?php
defined( 'ABSPATH' ) || exit;
add_shortcode( 'wp_event_calender', array( $dec_calender, 'calender_callback' ) );
add_shortcode( 'wp_event_listing', array( $events_listing, 'events_listing_callback' ) );