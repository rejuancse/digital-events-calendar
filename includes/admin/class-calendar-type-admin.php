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

		add_action( 'admin_menu', [ $this, 'admin_menu' ], 12 );
	}

	/**
	* Adds pages to admin menu.
	*/
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=event', __( 'Settings', 'digital-event-calendar' ), __( 'Settings', 'digital-event-calendar' ), 'manage_options', 'digital-event-calendar-settings', [ $this->settings_page, 'output' ] );
	}

}

Digital_Event_Calendar_Admin::instance();