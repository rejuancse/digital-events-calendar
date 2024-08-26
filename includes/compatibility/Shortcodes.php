<?php
defined( 'ABSPATH' ) || exit;
add_shortcode( 'wp_event_calender', array( $dec_calender, 'calender_callback' ) );
add_shortcode( 'wp_event_listing', array( $event_listing, 'events_list_callback' ) );
add_shortcode( 'wp_upcoming_event_listing', array( $upcoming_events, 'upcoming_event_list_callback' ) );
add_shortcode( 'wp_past_event_listing', array( $past_events, 'past_event_list_callback' ) );
