<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}


/**
* Admin functions for the Event post type
*
* @author 		Themeum
* @category 	Admin
* @package 		Eventco
* @version      1.0
*-------------------------------------------------------------*/

/**
* Register post Type Event
*
* @return Eventco
*/

function themeum_post_type_event(){
	$labels = array( 
		'name'                	=> _x( 'Events', 'Events', 'eventco-core' ),
		'singular_name'       	=> _x( 'Event', 'Event', 'eventco-core' ),
		'menu_name'           	=> __( 'Events', 'eventco-core' ),
		'parent_item_colon'   	=> __( 'Parent Event:', 'eventco-core' ),
		'all_items'           	=> __( 'All Events', 'eventco-core' ),
		'view_item'           	=> __( 'View Event', 'eventco-core' ),
		'add_new_item'        	=> __( 'Add New Event', 'eventco-core' ),
		'add_new'             	=> __( 'New Event', 'eventco-core' ),
		'edit_item'           	=> __( 'Edit Event', 'eventco-core' ),
		'update_item'         	=> __( 'Update Event', 'eventco-core' ),
		'search_items'        	=> __( 'Search Event', 'eventco-core' ),
		'not_found'           	=> __( 'No article found', 'eventco-core' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'eventco-core' )
	);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> true,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> 'dashicons-welcome-write-blog',
		'supports'           	=> array( 'title','editor','thumbnail','comments')
	);

	register_post_type('event', $args);

}

add_action('init','themeum_post_type_event');


/**
* View Message When Updated Project
*
* @param array $messages Existing post update messages.
* @return array
*/

function themeum_update_message_event( $messages ){
	global $post, $post_ID;

	$message['event'] = array(
		0 => '',
		1 => sprintf( __('Event updated. <a href="%s">View Event</a>', 'eventco-core' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'eventco-core' ),
		3 => __('Custom field deleted.', 'eventco-core' ),
		4 => __('Event updated.', 'eventco-core' ),
		5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'eventco-core' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Event published. <a href="%s">View Event</a>', 'eventco-core' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Event saved.', 'eventco-core' ),
		8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'eventco-core' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'eventco-core' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'eventco-core' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
	return $message;
}

add_filter( 'post_updated_messages', 'themeum_update_message_event' );


/**
* Register Event Category Taxonomies
*
* @return void
*/

function themeum_register_event_cat_taxonomy(){
	$labels = array(
		'name'              	=> _x( 'Event Categories', 'taxonomy general name', 'eventco-core' ),
		'singular_name'     	=> _x( 'Event Category', 'taxonomy singular name', 'eventco-core' ),
		'search_items'      	=> __( 'Search Event Category', 'eventco-core' ),
		'all_items'         	=> __( 'All Event Category', 'eventco-core' ),
		'parent_item'       	=> __( 'Event Parent Category', 'eventco-core' ),
		'parent_item_colon' 	=> __( 'Event Parent Category:', 'eventco-core' ),
		'edit_item'         	=> __( 'Edit Event Category', 'eventco-core' ),
		'update_item'       	=> __( 'Update Event Category', 'eventco-core' ),
		'add_new_item'      	=> __( 'Add New Event Category', 'eventco-core' ),
		'new_item_name'     	=> __( 'New Event Category Name', 'eventco-core' ),
		'menu_name'         	=> __( 'Event Category', 'eventco-core' )
		);

	$args = array(	'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
	);

	register_taxonomy('event_cat',array( 'event' ),$args);
}

add_action('init','themeum_register_event_cat_taxonomy');




