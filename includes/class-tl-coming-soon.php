<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeluxury.com/
 * @since      1.0.0
 *
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/includes
 * @author     ThemeLuxury <themeluxury@gmail.com>
 */
class TL_Coming_Soon {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      TL_Coming_Soon_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'TL_COMING_SOON_VERSION' ) ) {
			$this->version = TL_COMING_SOON_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tl-coming-soon';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

		$countdown = ( isset( get_option('tlcs_general_options')['countdown'] ) ? get_option('tlcs_general_options')['countdown'] : 0 );
		
		$status = ( isset( get_option('tlcs_general_options')['status'] ) ? get_option('tlcs_general_options')['status'] : 0 );

		if( isset($_GET['tlcs-preview']) ){

			$this->define_public_hooks();

		}
		else if ( $countdown != '' && current_time('Y-m-d H:i:s') > $countdown ) {

			$options = get_option('tlcs_general_options');

			$options['status'] = 0;

			update_option('tlcs_general_options', $options);

		}
		else if ( $status == 1 ) {

			if ( !isset( get_option('tlcs_general_options')['roles'] ) || !$this->check_user_role( get_option('tlcs_general_options')['roles'] )) {

				$this->define_public_hooks();
			}
			
		}


	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Check User Role
	 * -------------------------------------------------------------------------------
	**/
	private function check_user_role($roles, $user_id = null) {
		include_once(ABSPATH . 'wp-includes/pluggable.php');
		if ($user_id) $user = get_userdata($user_id);
		else $user = wp_get_current_user();
		if (empty($user)) return false;
		foreach ($user->roles as $role) {
			if (in_array($role, $roles)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - TL_Coming_Soon_Loader. Orchestrates the hooks of the plugin.
	 * - TL_Coming_Soon_i18n. Defines internationalization functionality.
	 * - TL_Coming_Soon_Admin. Defines all hooks for the admin area.
	 * - TL_Coming_Soon_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tl-coming-soon-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tl-coming-soon-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tl-coming-soon-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tl-coming-soon-public.php';

		/**
		 * The functions
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions.php';

		$this->loader = new TL_Coming_Soon_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the TL_Coming_Soon_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new TL_Coming_Soon_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		global $pagenow;

		$plugin_admin    = new TL_Coming_Soon_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_settings = new TL_Coming_Soon_Admin_Settings( $this->get_plugin_name(), $this->get_version() );

		if( $pagenow == ( isset( $_GET['page'] ) && $_GET['page'] == 'tl_coming_soon_options') ) {
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		}

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		
		$this->loader->add_action( 'admin_menu', $plugin_settings, 'setup_plugin_options_menu' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_general_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_template_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_design_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_social_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_translation_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_support_options' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new TL_Coming_Soon_Public( $this->get_plugin_name(), $this->get_version() );
		$plugin_settings = new TL_Coming_Soon_Public_Settings( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		( isset($_GET['tlcs-preview']) ) ? $this->loader->add_action( 'template_include', $plugin_settings, 'tlcs_load_preview_page') : $this->loader->add_action( 'template_include', $plugin_settings, 'tlcs_load_public_page');


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    TL_Coming_Soon_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
