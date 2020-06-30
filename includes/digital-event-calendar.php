<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Digital_Event_Calendar {

	private static $instance = null;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	* Constructor.
	*/
	public function __construct() {

		include_once DEC_PLUGIN_DIR . '/includes/class-event-post-types.php';

		if ( is_admin() ) {
			include_once DEC_PLUGIN_DIR . '/includes/admin/class-calendar-type-admin.php';
		} 

		# Init Classes
		$this->post_types = DEC_Post_Types::instance();
		
		add_action('admin_enqueue_scripts', 	array($this, 'admin_script')); 
		add_action('wp_enqueue_scripts', 		array($this, 'frontend_scripts'));
		add_action( 'after_switch_theme', [ $this->post_types, 'register_post_types' ], 11 );
	}

	public function activate() {
		$this->post_types->register_post_types();
	}

	public function frontend_scripts() {
	    # CSS
	    wp_enqueue_style('event-calender', DEC_URI .'assets/css/event-calender.css');
	    wp_enqueue_style('event-main', DEC_URI .'assets/css/main.css');

	    # JS
	    wp_enqueue_script( 'jquery' );
	    wp_enqueue_script( 'event-main' );
	    wp_localize_script( 'event-main', 'eajax_objects', array( 
	    		'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	    		'ajax_nonce' 		=> wp_create_nonce('event-calendar-nonce')
	    	) 
	    );  
	}

	public function admin_script() {   
      	wp_enqueue_style( 'wp-color-picker' ); 
      	wp_enqueue_style('admin', DEC_URI .'assets/css/admin.css');

		wp_enqueue_script( 'calender-admin', DEC_URI .'assets/js/admin.js', array('jquery', 'wp-color-picker'), '', true );
	}

	function limit_word_text($text, $limit) {
        if ( $this->mb_str_word_count($text, 0) > $limit ) {
            $words  = $this->mb_str_word_count($text, 2);
            $pos    = array_keys($words);
            $text   = mb_substr($text, 0, $pos[$limit]);
        }
        return $text;
    }
    function mb_str_word_count($string, $format = 0, $charlist = '[]') {
        mb_internal_encoding( 'UTF-8');
        mb_regex_encoding( 'UTF-8');
        $words = mb_split('[^\x{0600}-\x{06FF}]', $string);
        switch ($format) {
            case 0:
                return count($words);
                break;
            case 1:
            case 2:
                return $words;
                break;
            default:
                return $words;
                break;
        }
    }
	
}
