<?php
/**
* File containing the class Digital_Event_Calendar_Settings.
*
* @package digital-event-calendar
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Handles the management of plugin settings.
*
* @since 1.0.0
*/
class Digital_Event_Calendar_Settings {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 */
	private static $instance = null;

	/**
	 * Our Settings.
	 *
	 * @var array Settings.
	 */
	protected $settings = [];

	public string $settings_group;

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
		$this->settings_group = 'digital_event_calendar';
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}


	/**
	 * Get Event Calender Settings
	 *
	 * @return array
	 */
	public function get_settings() {
		if ( 0 === count( $this->settings ) ) {
			$this->init_settings();
		}
		return $this->settings;
	}

	/**
	 * Initializes the configuration for the plugin's setting fields.
	 *
	 * @access protected
	 */
	protected function init_settings() {
		// Prepare roles option.
		$roles         = get_editable_roles();
		$account_roles = [];

		foreach ( $roles as $key => $role ) {
			if ( 'administrator' === $key ) {
				continue;
			}
			$account_roles[ $key ] = $role['name'];
		}


		$this->settings = apply_filters(
			'event_calender_settings',
			[

				# Event style
				'event_style' => [
					__( 'Calender Style', 'event-calender' ),
					[
						[
							'name'       => 'event_major_color',
							'type'      => 'text',
							'label'     => __('Major Color', 'event-calender'),
							'default'   => 'ffffff',
						],
					],
				],

				# Event Shortcodes List
				'events_shortcodes'      => [
					__( 'Shortcode', 'event-calender' ),
					[
						[
							'name'  	=> 'shortcode_list_page_id',
							// 'std'   	=> '[event_calender]',
							'desc'      => __( '[event_calender]', 'event-calender' ),
							'label' 	=> __( 'Event Calendar', 'event-calender' ),
							'type'  	=> '',
						],
						[
							'name'  	=> 'shortcode_list_page_id',
							'desc'      => __( '[events_list] or [events_list number="9" column="4"]', 'event-calender' ),
							'label' 	=> __( 'Event Listing', 'event-calender' ),
							'type'  	=> '',
						],
					],
				],

			]
		);



	}

	/**
	 * Registers the plugin's settings with WordPress's Settings API.
	 */
	public function register_settings() {
		$this->init_settings();

		foreach ( $this->settings as $section ) {
			foreach ( $section[1] as $option ) {
				if ( isset( $option['std'] ) ) {
					add_option( $option['name'], $option['std'] );
				}
				register_setting( $this->settings_group, $option['name'] );
			}
		}
	}

	/**
	 * Shows the plugin's settings page.
	 */
	public function output() {
		$this->init_settings();
		?>
		<div class="wrap event-calender-settings-wrap">
			<form class="event-calender-options" method="post" action="options.php">

				<?php settings_fields( $this->settings_group ); ?>

				<h2 class="nav-tab-wrapper">
					<?php
					foreach ( $this->settings as $key => $section ) {
						echo '<a href="#settings-' . esc_attr( sanitize_title( $key ) ) . '" class="nav-tab">' . esc_html( $section[0] ) . '</a>';
					}
					?>
				</h2>

				<?php
				if ( ! empty( $_GET['settings-updated'] ) ) {
					flush_rewrite_rules();
					echo '<div class="updated fade event-calender-updated"><p>' . esc_html__( 'Settings successfully saved', 'event-calender' ) . '</p></div>';
				}

				foreach ( $this->settings as $key => $section ) {
					$section_args = isset( $section[2] ) ? (array) $section[2] : [];
					echo '<div id="settings-' . esc_attr( sanitize_title( $key ) ) . '" class="settings_panel">';
					if ( ! empty( $section_args['before'] ) ) {
						echo '<p class="before-settings">' . wp_kses_post( $section_args['before'] ) . '</p>';
					}
					echo '<table class="form-table settings parent-settings">';

					foreach ( $section[1] as $option ) {
						$value = get_option( $option['name'] );
						$this->output_field( $option, $value );
					}

					echo '</table>';
					if ( ! empty( $section_args['after'] ) ) {
						echo '<p class="after-settings">' . wp_kses_post( $section_args['after'] ) . '</p>';
					}
					echo '</div>';

				}
				?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'event-calender' ); ?>" />
				</p>
			</form>
		</div>

		<script type="text/javascript">
			jQuery('.nav-internal').click(function (e) {
				e.preventDefault();
				jQuery('.nav-tab-wrapper a[href="' + jQuery(this).attr('href') + '"]').click();

				return false;
			});

			jQuery('.nav-tab-wrapper a').click(function() {
				if ( '#' !== jQuery(this).attr( 'href' ).substr( 0, 1 ) ) {
					return false;
				}
				jQuery('.settings_panel').hide();
				jQuery('.nav-tab-active').removeClass('nav-tab-active');
				jQuery( jQuery(this).attr('href') ).show();
				jQuery(this).addClass('nav-tab-active');
				window.location.hash = jQuery(this).attr('href');
				jQuery( 'form.event-calender-options' ).attr( 'action', 'options.php' + jQuery(this).attr( 'href' ) );
				window.scrollTo( 0, 0 );
				return false;
			});
			var goto_hash = window.location.hash;
			if ( '#' === goto_hash.substr( 0, 1 ) ) {
				jQuery( 'form.event-calender-options' ).attr( 'action', 'options.php' + jQuery(this).attr( 'href' ) );
			}
			if ( goto_hash ) {
				var the_tab = jQuery( 'a[href="' + goto_hash + '"]' );
				if ( the_tab.length > 0 ) {
					the_tab.click();
				} else {
					jQuery( '.nav-tab-wrapper a:first' ).click();
				}
			} else {
				jQuery( '.nav-tab-wrapper a:first' ).click();
			}
		</script>
		<?php
	}

	/**
	 * Select input field.
	 *
	 * @param array  $option
	 * @param array  $attributes
	 * @param mixed  $value
	 * @param string $ignored_placeholder
	 */
	protected function input_select( $option, $attributes, $value, $ignored_placeholder ) {
		?>
		<select
			id="setting-<?php echo esc_attr( $option['name'] ); ?>"
			class="regular-text"
			name="<?php echo esc_attr( $option['name'] ); ?>"
			<?php
			echo implode( ' ', $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		>
		<?php
		foreach ( $option['options'] as $key => $name ) {
			echo '<option value="' . esc_attr( $key ) . '" ' . selected( $value, $key, false ) . '>' . esc_html( $name ) . '</option>';
		}
		?>
		</select>
		<?php

		if ( ! empty( $option['desc'] ) ) {
			echo ' <p class="description">' . wp_kses_post( $option['desc'] ) . '</p>';
		}
	}

	/**
	 * Page input field.
	 *
	 * @param array  $option
	 * @param array  $ignored_attributes
	 * @param mixed  $value
	 * @param string $ignored_placeholder
	 */
	protected function input_page( $option, $ignored_attributes, $value, $ignored_placeholder ) {
		$args = [
			'name'             => $option['name'],
			'id'               => $option['name'],
			'sort_column'      => 'menu_order',
			'sort_order'       => 'ASC',
			'show_option_none' => __( '--no page--', 'event-calender' ),
			'echo'             => false,
			'selected'         => absint( $value ),
		];

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Safe output.
		echo str_replace( ' id=', " data-placeholder='" . esc_attr__( 'Select a page&hellip;', 'event-calender' ) . "' id=", wp_dropdown_pages( $args ) );

		if ( ! empty( $option['desc'] ) ) {
			echo ' <p class="description">' . wp_kses_post( $option['desc'] ) . '</p>';
		}
	}

	/**
	 * Hidden input field.
	 *
	 * @param array  $option
	 * @param array  $attributes
	 * @param mixed  $value
	 * @param string $ignored_placeholder
	 */
	protected function input_hidden( $option, $attributes, $value, $ignored_placeholder ) {
		$human_value = $value;
		if ( $option['human_value'] ) {
			$human_value = $option['human_value'];
		}
		?>
		<input
			id="setting-<?php echo esc_attr( $option['name'] ); ?>"
			type="hidden"
			name="<?php echo esc_attr( $option['name'] ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
			<?php
			echo implode( ' ', $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		/><strong><?php echo esc_html( $human_value ); ?></strong>
		<?php

		if ( ! empty( $option['desc'] ) ) {
			echo ' <p class="description">' . wp_kses_post( $option['desc'] ) . '</p>';
		}
	}



	/**
	 * Number input field.
	 *
	 * @param array  $option
	 * @param array  $attributes
	 * @param mixed  $value
	 * @param string $placeholder
	 */
	protected function input_number( $option, $attributes, $value, $placeholder ) {
		echo isset( $option['before'] ) ? wp_kses_post( $option['before'] ) : '';
		?>
		<input
			id="setting-<?php echo esc_attr( $option['name'] ); ?>"
			class="small-text"
			type="number"
			name="<?php echo esc_attr( $option['name'] ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
			<?php
			echo implode( ' ', $attributes ) . ' '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $placeholder; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		/>
		<?php
		echo isset( $option['after'] ) ? wp_kses_post( $option['after'] ) : '';
		if ( ! empty( $option['desc'] ) ) {
			echo ' <p class="description">' . wp_kses_post( $option['desc'] ) . '</p>';
		}
	}

	/**
	 * Text input field.
	 *
	 * @param array  $option
	 * @param array  $attributes
	 * @param mixed  $value
	 * @param string $placeholder
	 */
	protected function input_text( $option, $attributes, $value, $placeholder ) {
		?>
		<input
			id="setting-<?php echo esc_attr( $option['name'] ); ?>"
			class="regular-text"
			type="text"
			name="<?php echo esc_attr( $option['name'] ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
			<?php
			echo implode( ' ', $attributes ) . ' '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $placeholder; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		/>
		<?php

		if ( ! empty( $option['desc'] ) ) {
			echo ' <p class="description">' . wp_kses_post( $option['desc'] ) . '</p>';
		}
	}

	/**
	 * Outputs the field row.
	 *
	 * @param array $option
	 * @param mixed $value
	 */
	protected function output_field( $option, $value ) {
		$placeholder    = ( ! empty( $option['placeholder'] ) ) ? 'placeholder="' . esc_attr( $option['placeholder'] ) . '"' : '';
		$class          = ! empty( $option['class'] ) ? $option['class'] : '';
		$option['type'] = ! empty( $option['type'] ) ? $option['type'] : 'text';
		$attributes     = [];
		if ( ! empty( $option['attributes'] ) && is_array( $option['attributes'] ) ) {
			foreach ( $option['attributes'] as $attribute_name => $attribute_value ) {
				$attributes[] = esc_attr( $attribute_name ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		echo '<tr valign="top" class="' . esc_attr( $class ) . '">';

		if ( ! empty( $option['label'] ) ) {
			echo '<th scope="row"><label for="setting-' . esc_attr( $option['name'] ) . '">' . esc_html( $option['label'] ) . '</a></th><td>';
		} else {
			echo '<td colspan="2">';
		}

		$method_name = 'input_' . $option['type'];
		if ( method_exists( $this, $method_name ) ) {
			$this->$method_name( $option, $attributes, $value, $placeholder );
		} else {
			do_action( 'wp_event_calender_admin_field_' . $option['type'], $option, $attributes, $value, $placeholder );
		}
		echo '</td></tr>';
	}
}
