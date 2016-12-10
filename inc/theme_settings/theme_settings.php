<?php


class Theme_Settings {

	private $options;


	public function __construct() {

		$this->options = get_option( THEME_OPTIONS );
		add_action( 'admin_menu', array( $this, 'theme_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'admin_init', array( $this, 'register_and_build_fields' ) );

	}

	public function theme_admin_menu() {
		add_menu_page(
			'Theme Settings',
			'Theme Settings',
			'administrator',
			'the_theme_options',
			array( $this, 'theme_settings_display' ),
			'dashicons-admin-generic',
			83
		);
	}

	/**
	 * Enqueues the scripts used on the settings page
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_media();
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/inc/theme_settings/js/upload_media.js', array( 'jquery' ) );
		wp_enqueue_style( 'theme_settings_styles', get_template_directory_uri() . '/inc/theme_settings/css/theme_settings.css' );
	}

	/**
	 * Registers and builds the fields used in the themes.
	 */
	public function register_and_build_fields() {
		register_setting( THEME_OPTIONS, THEME_OPTIONS, array( $this, 'validate_setting' ) );

		// Kontaktinformationer
		add_settings_section( 'contact_section', 'Kontaktinformationer:', array( $this, 'main_section_callback' ), __FILE__ );
		add_settings_field( 'contact_companyname', 'Firma Navn:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_companyname' ) );
		add_settings_field( 'contact_phone', 'Telefon:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_phone' ) );
		add_settings_field( 'contact_cvr', 'CVR:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_cvr' ) );
		add_settings_field( 'contact_email', 'E-mail:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_email' ) );
		add_settings_field( 'contact_street', 'Vejnavn:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_street' ) );
		add_settings_field( 'contact_zip', 'Post nr.:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_zip' ) );
		add_settings_field( 'contact_city', 'By:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_city' ) );
		add_settings_field( 'contact_ydernummer', 'Ydernummer:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'contact_ydernummer' ) );

		add_settings_field( 'open_monday', 'Mandag:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'open_monday' ) );
		add_settings_field( 'open_tuesday', 'Tirsdag:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'open_tuesday' ) );
		add_settings_field( 'open_wednesday', 'Onsdag:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'open_wednesday' ) );
		add_settings_field( 'open_thursday', 'Torsdag:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'open_thursday' ) );
		add_settings_field( 'open_friday', 'Fredag:', array( $this, 'callback_textfield' ), __FILE__, 'contact_section', array( 'id' => 'open_friday' ) );
	}

	/**
	 * Callback function for a section with no echo.
	 */
	public function main_section_callback() {

		// We don't need a description
	}

	/**
	 * Callback function for displaying text fields.
	 *
	 * @param $args array   The arguments to be passed on from the settings field.
	 */
	public function callback_textfield( $args ) {

		echo "<input type='text' name='" . THEME_OPTIONS . "[" . $args['id'] . "]' value='" . $this->options[ $args['id'] ] . "'>";
	}

	/**
	 * Callback function for displaying checkboxes.
	 *
	 * @param $args array   The arguments to be passed on from the settings field.
	 */
	public function callback_checkbox( $args ) {

		$checked = '';

		if ( $this->options[ $args['id'] ] == 'true' ) {
			$checked = 'checked';
		}

		echo "<input type='checkbox' name='" . esc_( THEME_OPTIONS ) . '[' . $args['id'] . "]' value='true' " . $checked . '> ' . $args['label'] . ' <br>';
	}

	/**
	 * Callback function for displaying textareas.
	 *
	 * @param $args array   The arguments to be passed on from the settings field.
	 */
	public function callback_textarea( $args ) {

		echo "<textarea name='" . THEME_OPTIONS . "[" . $args['id'] . "]' rows='5'>" . $this->options[ $args['id'] ] . "</textarea>";
	}

	/**
	 * Callback function for displaying image uploads.
	 *
	 * @param $args array   The arguments to be passed on from the settings field.
	 */
	public function callback_image( array $args ) {

		$settings = get_option( THEME_OPTIONS );
		$hidden   = '';
		$field    = $args['id'];
		$desc     = $args['desc'];

		if ( empty( $settings[ $field ] ) ) {
			$hidden = 'hidden';
		}

		echo '<div class="ad">';

		if ( ! empty( $desc ) ) {
			echo '<small>' . esc_html( $desc ) . '</small><br><br>';
		}

		echo '<div class="selected-image ' . $hidden . '"><img src="' . $settings[ $field ] . '"></div>';
		echo '<input class="upload_image_button button upload_image" type="button" value="Vælg billede">';
		echo '&nbsp;&nbsp;<a href="#" class="button ' . $hidden . ' remove-selected">Fjern billede</a>';
		echo '<input type="hidden" class="bannerad_url" name="' . THEME_OPTIONS . '[' . $field . ']" value="' . $settings[ $field ] . '">';
		echo '</div>';
	}

	/**
	 * Callback function for rendering the theme settings page.
	 *
	 * @var $page string    The link between these settings and the settings page.
	 */
	public function theme_settings_display() {

		$page = __FILE__;
		require_once( get_template_directory() . '/inc/theme_settings/views/theme_settings_view.php' );
	}

	/**
	 * Callback function for validating the settings fields.
	 *
	 * @param $settings array   The settings to be validated.
	 *
	 * @return array            The settings after they are validated.
	 */
	public function validate_setting( $settings ) {

		return $settings;
	}

}
