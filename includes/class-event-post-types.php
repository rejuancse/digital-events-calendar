<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Calendar Post type
*/ 
class DEC_Post_Types {

	public static $instance = null;
	public static function instance () {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	* Constructor.
	*/
	public function __construct() {
		add_action( 'init', [ $this, 'register_post_types' ], 0 );
		add_filter( 'post_updated_messages', array($this, 'event_updated_messages') );
	}

	public function register_post_types() {

		$labels = array(
			'name'                	=> _x( 'Events', 'Events', 'event-calender' ),
			'singular_name'       	=> _x( 'Event', 'Event', 'event-calender' ),
			'menu_name'           	=> __( 'Events', 'event-calender' ),
			'parent_item_colon'   	=> __( 'Parent Event:', 'event-calender' ),
			'all_items'           	=> __( 'All Events', 'event-calender' ),
			'view_item'           	=> __( 'View Event', 'event-calender' ),
			'add_new_item'        	=> __( 'Add New Event', 'event-calender' ),
			'add_new'             	=> __( 'New Event', 'event-calender' ),
			'edit_item'           	=> __( 'Edit Event', 'event-calender' ),
			'update_item'         	=> __( 'Update Event', 'event-calender' ),
			'search_items'        	=> __( 'Search Event', 'event-calender' ),
			'not_found'           	=> __( 'No article found', 'event-calender' ),
			'not_found_in_trash'  	=> __( 'No article found in Trash', 'event-calender' )
		);
		$args = array(
			'labels'                    => $labels,
			'public'             	=> true,
			'publicly_queryable' 	=> true,
			'show_in_menu'       	=> true,
			'show_in_admin_bar'   	=> true,
			'can_export'          	=> true,
			'has_archive'        	=> true,
			'hierarchical'       	=> false,
			'menu_position'      	=> null,
			'menu_icon'				=> 'dashicons-art',
			'supports'           	=> array( 'title','editor','thumbnail','comments')
		);
		register_post_type(' event ', $args);

		/**
		* Taxonomy: Category
		*/
		$labels = array(
			'name'                       => _x( 'Event Categories', 'taxonomy general name', 'event-calender' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name', 'event-calender' ),
			'search_items'               => __( 'Search Categories', 'event-calender' ),
			'popular_items'              => __( 'Popular Categories', 'event-calender' ),
			'all_items'                  => __( 'All Categories', 'event-calender' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category', 'event-calender' ),
			'update_item'                => __( 'Update Category', 'event-calender' ),
			'add_new_item'               => __( 'Add New Category', 'event-calender' ),
			'new_item_name'              => __( 'New Category Name', 'event-calender' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'event-calender' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'event-calender' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'event-calender' ),
			'not_found'                  => __( 'No categories found.', 'event-calender' ),
			'menu_name'                  => __( 'Event Categories', 'event-calender' ),
		);
		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'event-category' ),
		);
		register_taxonomy( 'event_cat', 'event', $args );
	}

	function event_updated_messages( $messages ){
		global $post, $post_ID;

		$message['event'] = array(
			0 => '',
			1 => sprintf( __('Event updated. <a href="%s">View Event</a>', 'event-calender' ), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.', 'event-calender' ),
			3 => __('Custom field deleted.', 'event-calender' ),
			4 => __('Event updated.', 'event-calender' ),
			5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'event-calender' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Event published. <a href="%s">View Event</a>', 'event-calender' ), esc_url( get_permalink($post_ID) ) ),
			7 => __('Event saved.', 'event-calender' ),
			8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'event-calender' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'event-calender' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'event-calender' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			);
		return $message;
	}
}
