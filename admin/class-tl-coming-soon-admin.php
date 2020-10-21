<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeluxury.com/
 * @since      1.0.0
 *
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/admin
 * @author     ThemeLuxury <themeluxury@gmail.com>
 */
class TL_Coming_Soon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}


	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-tl-coming-soon-settings.php';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TL_Coming_Soon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TL_Coming_Soon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.datetimepicker.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'select2', plugin_dir_url( __FILE__ ) . 'assets/css/select2.min.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/tl-coming-soon-admin.css', array('wp-color-picker'), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TL_Coming_Soon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TL_Coming_Soon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		
		wp_enqueue_script( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.datetimepicker.full.min.js', array(), $this->version, true );

		wp_enqueue_script( 'select2', plugin_dir_url( __FILE__ ) . 'assets/js/select2.min.js', array(), $this->version, true );

		wp_enqueue_script( 'tlcs-upload', plugin_dir_url( __FILE__ ) . 'assets/js/upload.js', array(), $this->version, true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/tl-coming-soon-admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), $this->version, true );
		
		wp_enqueue_media();
	}

}
