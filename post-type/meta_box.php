<?php
/**
 * Admin feature for Custom Meta Box
 *
 * @author 		Themeum
 * @category 	Admin Core
 * @package 	Varsity
 *-------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Registering meta boxes
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themeum_core_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_core_register_meta_boxes( $meta_boxes )
{

	/**
	* Prefix of meta keys (optional)
	* Use underscore (_) at the beginning to make keys hidden
	* Alt.: You also can make prefix empty to disable it
	*/

	# Better has an underscore as last sign
	$prefix = 'themeum_';
		$contact_forms = array();
	    $contact_forms = get_all_posts('wpcf7_contact_form');
	    $contact_forms['Select'] = 'Select';

	/**
	* Register Post Meta for Movie Post Type
	*
	* @return array
	*/


	# -----------------------------------------------------------
	# --------------------- Post Open ---------------------------
	# -----------------------------------------------------------
	$meta_boxes[] = array(
		'id' => 'post-meta-quote',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Quote Settings', 'eventco-core' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Text', 'eventco-core' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => esc_html__( 'Write Your Quote Here', 'eventco-core' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Author', 'eventco-core' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => esc_html__( 'Write Quote Author or Source', 'eventco-core' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);



	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Link Settings', 'eventco-core' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Link URL', 'eventco-core' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => esc_html__( 'Write Your Link', 'eventco-core' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Audio Settings', 'eventco-core' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Audio Embed Code', 'eventco-core' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}audio_code",
				'desc'  => esc_html__( 'Write Your Audio Embed Code Here', 'eventco-core' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)

		)
	);

	$meta_boxes[] = array(
		'id' 		=> 'post-meta-video',
		'title' 	=> esc_html__( 'Post Video Settings', 'eventco-core' ),
		'pages' 	=> array( 'post'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Video Embed Code/ID', 'eventco-core' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => esc_html__( 'Write Your Vedio Embed Code/ID Here', 'eventco-core' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'  => __( 'Video Durations', 'eventco-core' ),
				'id'    => "{$prefix}video_durations",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'     => esc_html__( 'Select Vedio Type/Source', 'eventco-core' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'eventco-core' ),
					'2' => esc_html__( 'YouTube', 'eventco-core' ),
					'3' => esc_html__( 'Vimeo', 'eventco-core' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1'
			),

		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Gallery Settings', 'eventco-core' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => esc_html__( 'Gallery Image Upload', 'eventco-core' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)
		)
	);



	// ------------------------------------------------------------------------------
	// ----------------------------- Post Close --------------------------------------
	// ------------------------------------------------------------------------------


	/*==================================
	* Speakers Information MetaBox
	*===================================*/
	$meta_boxes[] = array(
		'id' 		=> 'speaker-meta-setting',
		'title' 	=> esc_html__( 'Speaker Infomation', 'eventex' ),
		'pages' 	=> array( 'speaker'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(

			array(
				'name'             => __( 'Speaker Image', 'eventex' ),
				'id'               => "speaker_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Speaker Full Name', 'eventex' ),
				'id'    => "speaker_fullname",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Speaker Designation', 'eventex' ),
				'id'    => "{$prefix}designation",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Speaker Short Description', 'eventex' ),
				'id'    => "{$prefix}short_descrp",
				'type'  => 'textarea',
				'std'   => ''
			),
		)
	);


	# Speaker Session List.
	$meta_boxes[] = array(
		'id' 		=> 'speaker-session-meta-setting',
		'title' 	=> esc_html__( 'Speaker Session Infomation', 'eventex' ),
		'pages' 	=> array( 'speaker'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(


			array(
				'name'   => esc_html__( 'Speaker Session List', 'eventco-core' ),
				'id'     => 'session_info_group',
				'type'   => 'group',
				'fields' => array(		
					array(
						'name'          => esc_html__( 'Session No', 'eventco-core' ),
						'id'            => "{$prefix}session_nbr",
						'type'          => 'text',
						'std'           => '',
						'desc'  		=> esc_html__( '01', 'eventco-core' ),
					),
					array(
						'name'          => esc_html__( 'Day Name', 'eventco-core' ),
						'id'            => "{$prefix}session_day",
						'type'          => 'text',
						'std'           => '',
						'desc'  		=> esc_html__( 'Day 1', 'eventco-core' ),
					),
					array(
						'name'          => esc_html__( 'Session Start Time', 'eventco-core' ),
						'id'            => "{$prefix}start_datetime",
						'type'          => 'datetime',
						'std'           => '',
						'desc'  		=> esc_html__( 'Start Time', 'eventco-core' ),
					),
					array(
						'name'          => esc_html__( 'Session Topic', 'eventco-core' ),
						'id'            => "{$prefix}session_topic",
						'type'          => 'textarea',
						'std'           => '',
						'desc'  		=> esc_html__( 'Introduction to Material Design', 'eventco-core' ),
					),
					array(
						'name'          => esc_html__( 'Session Venue', 'eventco-core' ),
						'id'            => "{$prefix}session_venue",
						'type'          => 'text',
						'std'           => '',
						'desc'  		=> esc_html__( 'Hall 1', 'eventco-core' ),
					),
				),
				'clone'  => true,
			),

		)
	);


	# Event Session List.
	$meta_boxes[] = array(
		'id' 		=> 'event-session-meta-setting',
		'title' 	=> esc_html__( 'Event Infomation', 'eventex' ),
		'pages' 	=> array( 'event'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(

			array(
				'name'          => esc_html__( 'Event Start Time', 'eventco-core' ),
				'id'            => "{$prefix}event_start_datetime",
				'type'          => 'datetime',
				'std'           => '',
				'desc'  		=> esc_html__( 'Start Date Time', 'eventco-core' ),
			),
			array(
				'name'          => esc_html__( 'Event End Time', 'eventco-core' ),
				'id'            => "{$prefix}event_end_datetime",
				'type'          => 'datetime',
				'std'           => '',
				'desc'  		=> esc_html__( 'End Date Time', 'eventco-core' ),
			),
			array(
				'name'          => esc_html__( 'Organizer', 'eventco-core' ),
				'id'            => "{$prefix}event_organizer",
				'type'          => 'text',
				'std'           => '',
				'desc'  		=> esc_html__( 'Organizer', 'eventco-core' ),
			),
			array(
				'name'          => esc_html__( 'Address', 'eventco-core' ),
				'id'            => "{$prefix}event_location",
				'type'          => 'text',
				'std'           => '',
				'desc'  		=> esc_html__( 'Dreamland, Dublin', 'eventco-core' ),
			),

		)
	);


	$meta_boxes[] = array(
		'id' 		=> 'event-meta-setting',
		'title' 	=> esc_html__( 'Event Speakers Infomation', 'eventco-core' ),
		'pages' 	=> array( 'event'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(

			array(
				'name'   => esc_html__( 'Event Information', 'eventco-core' ),
				'id'     => 'event_section',
				'type'   => 'group',
				'fields' => array(
					array(
						'name'  		=> esc_html__( 'Date of Event', 'eventco-core' ),
						'id'    		=> "{$prefix}date_of_event",
						'type'  		=> 'textarea',
						'std'   		=> '',
						'placeholder' 	=> esc_html__( 'Day 1', 'eventco-core' ),
					),
					array(
						'name'          => esc_html__( 'Session Date', 'eventco-core' ),
						'id'            => "{$prefix}event_date",
						'type'          => 'date',
						'std'           => '',
						'desc'  		=> esc_html__( 'Session Date', 'eventco-core' ),
					),
					array(
						'name'   		=> esc_html__( 'Session Information', 'eventco-core' ),
						'id'     		=> 'event_info_group',
						'type'   		=> 'group',
						'fields' 		=> array(
									
							array(
								'name'          => esc_html__( 'Session', 'eventco-core' ),
								'id'            => "{$prefix}session",
								'type'          => 'textarea',
								'std'           => '',
							),
							array(
								'name'          => esc_html__( 'Session Custom Link', 'eventco-core' ),
								'id'            => "{$prefix}session_link",
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => esc_html__( 'Intro Text', 'eventco-core' ),
								'id'            => "{$prefix}intro_text",
								'type'          => 'textarea',
								'std'           => '',
							),
							array(
					            'name'       		=> __( 'Speaker(s)', 'eventco-core' ),
								'id'         		=> "speaker_name",
					            'desc'       		=> __( 'Speakers', 'eventco-core' ),
					            'type'       		=> 'post',
					            'post_type'  		=> 'speaker',
					            'field_type' 		=> 'select_advanced',
					            'query_args' 		=> array(
					             	'post_status'    	=> 'publish',
					             	'posts_per_page' 	=> '-1',
					            ),
					            'multiple'    	=> false,
					            'placeholder' 	=> esc_html__( 'Select Speaker', 'eventco-core' ),
					        ),
							array(
								'name'          => esc_html__( 'Start Time', 'eventco-core' ),
								'id'            => "{$prefix}start_datetime",
								'type'          => 'time',
								'std'           => '',
								'desc'  		=> esc_html__( 'Start Time', 'eventco-core' ),
							),
							array(
								'name'          => esc_html__( 'End Time', 'eventco-core' ),
								'id'            => "{$prefix}end_time",
								'type'          => 'time',
								'std'           => '',
								'desc'  		=> esc_html__( 'End Time', 'eventco-core' ),
							),
							array(
								'name'          => esc_html__( 'Venue', 'eventco-core' ),
								'id'            => "{$prefix}venue",
								'type'          => 'text',
								'std'           => '',
							),
						),
						'clone'  => true,
					),
				),
				'clone'  => true,
			)

		)
	);


	# ------------------------------------------	
	# ------ Event Gallery Open ----------------	
	# ------------------------------------------
	$meta_boxes[] = array(
		'id' 		=> 'event-gallery-meta',
		'title' 	=> __( 'Gallery Items', 'eventex' ),
		'pages' 	=> array( 'event'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,

		'fields' 	=> array(
			array(
				'name'  		=> __( 'Gallery Items', 'eventex' ),
				'id'    		=> "{$prefix}event_glallery_list",
				'type'  		=> 'image_advanced',
				'std'   		=> ''
			),		
		)
	);


	# ------------------------------------------	
	# ------ Event Gallery Open ----------------	
	# ------------------------------------------
	$meta_boxes[] = array(
		'id' 		=> 'event-sponsor-list-meta',
		'title' 	=> __( 'Sponsor Items', 'eventex' ),
		'pages' 	=> array( 'event'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(
			array(
				'name'   		=> esc_html__( 'Sponsor List', 'eventco-core' ),
				'id'     		=> 'event_sponsor_group',
				'type'   		=> 'group',
				'fields' 		=> array(
					array(
						'name'          => esc_html__( 'Sponsor Title', 'eventco-core' ),
						'id'            => "{$prefix}sponsor_title",
						'type'          => 'text',
						'std'           => '',
						'desc'  		=> esc_html__( 'Gold Sponsor', 'eventco-core' ),
					),		
					array(
						'name'  		=> __( 'Sponsor Items', 'eventex' ),
						'id'    		=> "{$prefix}sponsor_list",
						'type'  		=> 'image_advanced',
						'std'   		=> ''
					),	
				),
				'clone'  => true,
			),

		)
	);


	# Speaker Social Media
	$meta_boxes[] = array(
		'id' 		=> 'speaker-social-meta-setting',
		'title' 	=> esc_html__( 'Speaker Social Infomation', 'eventex' ),
		'pages' 	=> array( 'speaker'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(

			array(
				'name'  => esc_html__( 'Facebook URL', 'eventex' ),
				'id'    => "{$prefix}facebook_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Twitter URL', 'eventex' ),
				'id'    => "{$prefix}twitter_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Google Plus  URL', 'eventex' ),
				'id'    => "{$prefix}google_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Pinterest URL', 'eventex' ),
				'id'    => "{$prefix}pinterest_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Youtube URL', 'eventex' ),
				'id'    => "{$prefix}youtube_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Linkedin URL', 'eventex' ),
				'id'    => "{$prefix}linkedin_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Dribbble URL', 'eventex' ),
				'id'    => "{$prefix}dribbble_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Behance URL', 'eventex' ),
				'id'    => "{$prefix}behance_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Flickr URL', 'eventex' ),
				'id'    => "{$prefix}flickr_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'VK URL', 'eventex' ),
				'id'    => "{$prefix}vk_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Skype URL', 'eventex' ),
				'id'    => "{$prefix}skype_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Instagram URL', 'eventex' ),
				'id'    => "{$prefix}instagram_url",
				'type'  => 'text',
				'std'   => ''
			),
		)
	);


	// -----------------------------------------------------------------------------
	// ------------------------- Event Post Open -----------------------------------
	// -----------------------------------------------------------------------------
	// $meta_boxes[] = array(
	// 	'id' 		=> 'schedule-meta-setting',
	// 	'title' 	=> esc_html__( 'Schedule Infomation', 'eventco-core' ),
	// 	'pages' 	=> array( 'schedule'),
	// 	'context' 	=> 'normal',
	// 	'priority' 	=> 'high',
	// 	'autosave' 	=> true,
	// 	'fields' 	=> array(

	// 		array(
	// 			'name'  => esc_html__( 'Date of Event', 'eventco-core' ),
	// 			'id'    => "{$prefix}date_of_event",
	// 			'type'  => 'textarea',
	// 			'std'   => ''
	// 		),
	// 		array(
	// 			'name'   => esc_html__( 'Event Information', 'eventco-core' ),
	// 			'id'     => 'event_info_group',
	// 			'type'   => 'group',
	// 			'fields' => array(		
	// 				array(
	// 					'name'          => esc_html__( 'Session', 'eventco-core' ),
	// 					'id'            => "{$prefix}session",
	// 					'type'          => 'text',
	// 					'std'           => '',
	// 				),
	// 				array(
	// 					'name'          => esc_html__( 'Session Custom Link', 'eventco-core' ),
	// 					'id'            => "{$prefix}session_link",
	// 					'type'          => 'text',
	// 					'std'           => '',
	// 				),
	// 				array(
	// 		            'name'       		=> __( 'Speaker(s)', 'eventco-core' ),
	// 					'id'         		=> "speaker_name",
	// 		            'desc'       		=> __( 'Speakers', 'eventco-core' ),
	// 		            'type'       		=> 'post',
	// 		            'post_type'  		=> 'speaker',
	// 		            'field_type' 		=> 'select_advanced',
	// 		            'query_args' 		=> array(
	// 		             	'post_status'    	=> 'publish',
	// 		             	'posts_per_page' 	=> '-1',
	// 		            ),
	// 		            'multiple'    => false,
	// 		            'placeholder' 	=> esc_html__( 'Select Speaker', 'eventco-core' ),
	// 		        ),
	// 				array(
	// 					'name'          => esc_html__( 'Start Time', 'eventco-core' ),
	// 					'id'            => "{$prefix}start_datetime",
	// 					'type'          => 'time',
	// 					'std'           => '',
	// 					'desc'  		=> esc_html__( 'Start Time', 'eventco-core' ),
	// 				),
	// 				array(
	// 					'name'          => esc_html__( 'End Time', 'eventco-core' ),
	// 					'id'            => "{$prefix}end_time",
	// 					'type'          => 'time',
	// 					'std'           => '',
	// 					'desc'  		=> esc_html__( 'End Time', 'eventco-core' ),
	// 				),
	// 				array(
	// 					'name'             => esc_html__( 'BG color', 'eventco-core' ),
	// 					'id'               => "schedule_color",
	// 					'type'             => 'color',
	// 					'std' 			   => "#f5f5f5"
	// 				),



	// 			),
	// 			'clone'  => true,
	// 		),
	// 	)
	// );




	# ------------------------------------------	
	# ------ Photo Gallery Open ----------------	
	# ------------------------------------------
	$meta_boxes[] = array(
		'id' 		=> 'gallery-meta',
		'title' 	=> __( 'Gallery Items', 'eventex' ),
		'pages' 	=> array( 'gallery'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,

		'fields' 	=> array(
			array(
				'name'  		=> __( 'Gallery Items', 'eventex' ),
				'id'    		=> "{$prefix}photo_gallery",
				'type'  		=> 'image_advanced',
				'std'   		=> ''
			),		
		)
	);


	# ============================================	
	# =============== Page Open ==================
	# ============================================
	$meta_boxes[] = array(
		'id' 			=> 'page-meta-settings',
		'title' 		=> esc_html__( 'Page Settings', 'eventco-core' ),
		'pages' 		=> array( 'page'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'fields' 		=> array(
			array(
				'name'             => esc_html__( 'Upload Subtitle Banner Image', 'eventco-core' ),
				'id'               => $prefix."subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	
			array(
				'name'             => esc_html__( 'Upload Subtitle BG Color', 'eventco-core' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#f0f0f0"
			),	
			array(
				'name'  			=> __( 'Disable Subheader', 'eventco-core' ),
				'id'    			=> "{$prefix}disable_subheader",
				'desc'  			=> __( 'Disable Subheader From Page.', 'eventco-core' ),
				'type'  			=> 'checkbox',
				'std'   			=> 0
			),
					
		)
	);	
	# ============================================	
	# =============== Page Close =================
	# ============================================

	return $meta_boxes;
}


/**
 * Get list of post from any post type
 *
 * @return array
 */

function get_all_posts($post_type)
{
	$args = array(
			'post_type' => $post_type,  // post type name
			'posts_per_page' => -1,   //-1 for all post
		);

	$posts = get_posts($args);

	$post_list = array();

	if (!empty( $posts ))
	{
		foreach ($posts as $post)
		{
			setup_postdata($post);
			$post_list[$post->ID] = $post->post_title;
		}
		wp_reset_postdata();
		return $post_list;
	}
	else
	{
		return $post_list;
	}
}
