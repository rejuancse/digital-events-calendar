<?php
/**
* File containing the class Digital_Event_Calendar_Admin.
*
* @package Digital-Event Calender
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles front admin page for Digital Job Portal.
 *
 * @since 1.0.0
 */
class Digital_Event_Calendar_Admin {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  1.0.0
	 */
	private static $instance = null;

	/**
	* Allows for accessing single instance of class. Class should only be constructed once per call.
	*
	* @since  1.0.0
	* @static
	* @return self Main instance.
	*/
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
		global $wp_version;

		include_once dirname( __FILE__ ) . '/class-digital-event-calendar-settings.php';
		$this->settings_page = Digital_Event_Calendar_Settings::instance();

		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 12 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}


	
	/**
	* Set up actions during admin initialization.
	*/
	public function admin_init() {
		// include_once dirname( __FILE__ ) . '/class-digital-job-portal-taxonomy-meta.php';
	}



	/**
	 * Enqueues CSS and JS assets.
	 */
	public function admin_enqueue_scripts() {
		// Digital_Event_Calendar::register_select2_assets();

		// $screen = get_current_screen();
	
		// wp_enqueue_style( 'jquery-ui' );
		// wp_enqueue_style( 'select2' );
		// wp_enqueue_style( 'event_calender_admin_css', DIGITAL_JOB_PLUGIN_URL . '/assets/css/admin.css', [], DIGITAL_JOB_VERSION );
		// wp_enqueue_script( 'digital-job-portal-datepicker' );
		// wp_register_script( 'jquery-tiptip', DIGITAL_JOB_PLUGIN_URL . '/assets/js/jquery-tiptip/jquery.tipTip.min.js', [ 'jquery' ], DIGITAL_JOB_VERSION, true );
		// wp_enqueue_script( 'event_calender_admin_js', DIGITAL_JOB_PLUGIN_URL . '/assets/js/admin.min.js', [ 'jquery', 'jquery-tiptip', 'select2' ], DIGITAL_JOB_VERSION, true );
		// wp_enqueue_style( 'event_calender_admin_menu_css', DIGITAL_JOB_PLUGIN_URL . '/assets/css/menu.css', [], DIGITAL_JOB_VERSION );
	}

	/**
	* Adds pages to admin menu.
	*/
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=event', __( 'Settings', 'digital-event-calendar' ), __( 'Settings', 'digital-event-calendar' ), 'manage_options', 'digital-event-calendar-settings', [ $this->settings_page, 'output' ] );
		// print_r( $this->settings_page );
	}

}

Digital_Event_Calendar_Admin::instance();