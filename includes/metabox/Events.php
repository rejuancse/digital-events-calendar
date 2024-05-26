<?php
namespace DEC\EVENT;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Events {

	public function __construct() {
		add_action( 'add_meta_boxes', array($this, 'register_meta_box') );
		add_action( 'save_post', array($this, 'meta_box_save_func_store') );
	}

	/**
	* Registering metabox
	*/
	public function register_meta_box(){
		add_meta_box( 'event-info', __( 'Events Info', 'event-calender' ), array($this, 'events_metabox'), 'event', 'normal' );
	}

	public function events_metabox($post){

		#Call get post meta.
		$event_start_date 	= get_post_meta($post->ID, 'event_start_date', true);
		$event_start_time 	= get_post_meta($post->ID, 'event_start_time', true);

		$event_end_date 	= get_post_meta($post->ID, 'event_end_date', true);
		$event_end_time 	= get_post_meta($post->ID, 'event_end_time', true);

		$event_organizer 	= get_post_meta($post->ID, 'event_organizer', true);
		$event_location 	= get_post_meta($post->ID, 'event_location', true);

		# For security Checking.
		wp_nonce_field('events_nonce_action', 'events_nonce_name');

		include DEC_DIR_PATH.'includes/metabox/events-metabox.php';
	}

	# Data save in custom metabox field
	public function meta_box_save_func_store($post_id) {

		# Doing autosave then return.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;

		# If the nonce is not present there or we can not versify it.
		if ( !isset($_POST['events_nonce_name']) || !wp_verify_nonce($_POST['events_nonce_name'], 'events_nonce_action' ))
			return;

		# Save Event Meta
		if (isset($_POST['event_start_date']) && ($_POST['event_start_date'] != '') ) {
			$event_start_date = sanitize_text_field( $_POST['event_start_date'] );
			update_post_meta($post_id, 'event_start_date', $event_start_date );
		}
		if (isset($_POST['event_start_time']) && ($_POST['event_start_time'] != '') ) {
			$event_start_time = sanitize_text_field( $_POST['event_start_time'] );
			update_post_meta($post_id, 'event_start_time', $event_start_time );
		}

		# Save End data.
		if (isset($_POST['event_end_date']) && ($_POST['event_end_date'] != '')) {
			$event_end_date = sanitize_text_field( $_POST['event_end_date'] );
			update_post_meta($post_id, 'event_end_date', $event_end_date );
		}

		if (isset($_POST['event_end_time']) && ($_POST['event_end_time'] != '')) {
			update_post_meta($post_id, 'event_end_time', esc_html($_POST['event_end_time']));
		}

		if (isset($_POST['event_organizer']) && ($_POST['event_organizer'] != '')) {
			update_post_meta($post_id, 'event_organizer', esc_html($_POST['event_organizer']));
		}

		if (isset($_POST['event_location']) && ($_POST['event_location'] != '')) {
			update_post_meta($post_id, 'event_location', esc_html($_POST['event_location']));
		}

	}
	# End Save Function.
}
