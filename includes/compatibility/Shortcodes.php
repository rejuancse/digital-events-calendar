<?php
defined( 'ABSPATH' ) || exit;

add_shortcode( 'wp_event_calender', array( $dec_calender, 'calender_callback' ) );