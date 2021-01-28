<?php 

class TL_Coming_Soon_Admin_Settings {

	private $plugin_name;
	private $version;
	private $plugin_slug;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_slug = 'tl-coming-soon';

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Menu
	 * -------------------------------------------------------------------------------
	**/
	public function setup_plugin_options_menu() {

		//Add the menu to the Plugins set of menu items
		add_menu_page(
			'Coming Soon', 												// The title to be displayed in the browser window for this page.
			'Coming Soon',												// The text to be displayed for this menu item
			'manage_options',											// Which type of users can see this menu item
			'tl_coming_soon_options',									// The unique ID - that is, the slug - for this menu item
			array( $this, 'render_settings_page_content')				// The name of the function to call when rendering this menu's page
		);

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Renders a simple page to display for the theme menu defined above
	 * -------------------------------------------------------------------------------
	**/
	public function render_settings_page_content( $active_tab = '' ){
		?>
			
			<!-- Begin::wrap -->
			<div class="wrap tlcs-container">
				
				<h2><?php _e( 'TL Coming Soon - Maintenance Mode &amp; Under Construction', $this->plugin_slug ); ?></h2>
				
				<?php settings_errors(); ?>
					
				<?php if( isset( $_GET['tab'] ) ) {
					$active_tab = sanitize_title( $_GET['tab'] );
				} else if( $active_tab == 'templates' ) {
					$active_tab = 'templates';
				} else if( $active_tab == 'design' ) {
					$active_tab = 'design';
				} else if( $active_tab == 'socials' ) {
					$active_tab = 'socials';
				} else if( $active_tab == 'translation' ) {
					$active_tab = 'translation';
				} else if( $active_tab == 'support' ) {
					$active_tab = 'support';
				} else {
					$active_tab = 'general';
				} // end if/else ?>
				
				<!-- Begin::Tab -->
				<div id="tlcs-tabs" class="nav-tab-wrapper">

					<a href="?page=tl_coming_soon_options&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-admin-settings"></span></span>
						<span class="label"><?php _e( 'General', $this->plugin_slug ); ?></span>
					</a>

					<a href="?page=tl_coming_soon_options&tab=templates" class="nav-tab <?php echo $active_tab == 'templates' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-welcome-widgets-menus"></span></span>
						<span class="label ml-1"><?php _e( 'Templates', $this->plugin_slug ); ?></span>
					</a>

					<a href="?page=tl_coming_soon_options&tab=design" class="nav-tab <?php echo $active_tab == 'design' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-admin-customizer"></span></span>
						<span class="label"><?php _e( 'Design', $this->plugin_slug ); ?></span>
					</a>

					<a href="?page=tl_coming_soon_options&tab=socials" class="nav-tab <?php echo $active_tab == 'socials' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-share"></span></span>
						<span class="label"><?php _e( 'Socials', $this->plugin_slug ); ?></span>
					</a>

					<a href="?page=tl_coming_soon_options&tab=translation" class="nav-tab <?php echo $active_tab == 'translation' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-translation"></span></span>
						<span class="label ml-5"><?php _e( 'Translation', $this->plugin_slug ); ?></span>
					</a>

					<a href="<?php echo esc_url( home_url( '/?tlcs-preview' ) ); ?>" target="_blank" class="nav-tab">
						<span class="icon"><span class="dashicons dashicons-visibility"></span></span>
						<span class="label"><?php _e( 'Preview', $this->plugin_slug ); ?></span>
					</a>

					<a href="?page=tl_coming_soon_options&tab=support" class="nav-tab <?php echo $active_tab == 'support' ? 'active' : ''; ?>">
						<span class="icon"><span class="dashicons dashicons-sos"></span></span>
						<span class="label"><?php _e( 'Support', $this->plugin_slug ); ?></span>
					</a>

				</div>
				<!-- End::Tab -->
				
				<!-- Begin:form -->
				<form id="tlcs-main-form" class="<?php echo $active_tab; ?>" method="post" action="options.php">
					<?php 

						if( $active_tab == 'general' ) {

							settings_fields( 'tlcs_general_options' );
							do_settings_sections( 'tlcs_general_options' );

						} elseif( $active_tab == 'templates' ) {

							settings_fields( 'tlcs_template_options' );
							do_settings_sections( 'tlcs_template_options' );

						} elseif( $active_tab == 'design' ) {

							settings_fields( 'tlcs_design_options' );
							do_settings_sections( 'tlcs_design_options' );

						} elseif( $active_tab == 'socials' ) {

							settings_fields( 'tlcs_social_options' );
							do_settings_sections( 'tlcs_social_options' );

						} elseif( $active_tab == 'translation' ) {

							settings_fields( 'tlcs_translation_options' );
							do_settings_sections( 'tlcs_translation_options' );

						} elseif( $active_tab == 'support' ) {

							settings_fields( 'tlcs_support_options' );
							do_settings_sections( 'tlcs_support_options' );
						}
						
						if ( $active_tab != 'support' ) submit_button();

					?>
				</form>
				<!-- End::form -->

				<div id="tlcs-widget">

					<div class="donate postbox">
						<p><img src="<?php echo plugin_dir_url( __FILE__ ); ?>assets/images/tl-logo.png" alt="ThemeLuxury"></p>

						<p>If you really love our plugin, you can also donate a cup of coffee by clicking the Donate button below. <i class="dashicons dashicons-smiley"></i></p>

						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					</div>

					<div class="feedback postbox">
						<span class="dashicons dashicons-awards"></span>
						<h3 class="title">Rating to support us!</h3>
						<p>If you find our plugin useful, please give 5 stars feedback to support us by clicking the button below.</p>
						<a href="https://wordpress.org/support/plugin/tl-coming-soon/reviews/?rate=5#new-post" target="_blank">
							<p>⭐⭐⭐⭐⭐</p>
							<p class="button button-primary">Leave Feedback</p>
						</a>
						<p>We understand that sometimes you need help. So, we are always happy to assist on <a href="http://wordpress.org/support/plugin/tl-coming-soon" target="_blank">WordPress Support forum</a> in case you run into some issues.</p>
					</div>

					<div class="features postbox">
						<span class="dashicons dashicons-megaphone"></span>
						<h3 class="title">Request new features</h3>
						<p>If you have any ideas to help us improve this plugin? Please let us know by <a href="http://wordpress.org/support/plugin/tl-coming-soon" target="_blank">request feature</a> on the official WordPress Support forum.</p>
					</div>

				</div>

			</div>
			<!-- End::wrap -->

		<?php
	}

	/**
	 * ===============================================================================
	 * General
	 * ===============================================================================
	**/

	/**
	 * -------------------------------------------------------------------------------
	 *  General Options page
	 * -------------------------------------------------------------------------------
	**/
	public function general_options_callback() {
		$options = get_option('tlcs_general_options');
		//echo '<pre>'; print_r($options); echo '</pre>';
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the General Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_general_options_default() {

		$defaults = array(
			'status'             =>	'0',
			'roles'              => array('administrator'),
			'noindex_meta'       =>	'',
			'countdown'          =>	'',
			'google_analytics'   =>	'',
			'insert_header_code' =>	'',
			'insert_footer_code' =>	'',
			'custom_css'         =>	'',
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize General Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_general_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_general_options' ) ) {
			$default_array = $this->tlcs_general_options_default();
			add_option( 'tlcs_general_options', $default_array );
		}

		//Add general_options section
		add_settings_section(
			'general_settings_section',			            // ID used to identify this section and with which to register options
			'', 											// Title to be displayed on the administration page
			array( $this, 'general_options_callback'),	    // Callback used to render the description of the section
			'tlcs_general_options'		                	// Page on which to add this section of options
		);

		// Status
		add_settings_field(
			'status',						        		// ID used to identify the field throughout the theme
			__( 'Status', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_status_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		//Roles
		add_settings_field(
			'roles',						        		// ID used to identify the field throughout the theme
			__( 'Roles', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_roles_callback'),			// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section',	        		// The name of the section to which this field belongs
		);

		// No-Index Meta
		add_settings_field(
			'noindex_meta',						        		// ID used to identify the field throughout the theme
			__( 'No-Index Meta', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_noindex_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		// Countdown
		add_settings_field(
			'countdown',						        		// ID used to identify the field throughout the theme
			__( 'Countdown', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_countdown_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		// Google Analytics Tracking
		add_settings_field(
			'google_analytics',						        		// ID used to identify the field throughout the theme
			__( 'Google Analytics Tracking', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_google_analytics_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		// Insert Header Code
		add_settings_field(
			'insert_header_code',						        		// ID used to identify the field throughout the theme
			__( 'Insert Header Code', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_insert_header_code_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		// Insert Footer Code
		add_settings_field(
			'insert_footer_code',						        		// ID used to identify the field throughout the theme
			__( 'Insert Footer Code', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_insert_footer_code_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		// Custom CSS
		add_settings_field(
			'custom_css',						        		// ID used to identify the field throughout the theme
			__( 'Custom CSS', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_custom_css_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_general_options',	            			// The page on which this option will be displayed
			'general_settings_section'		        		// The name of the section to which this field belongs
		);

		register_setting(
			'tlcs_general_options',
			'tlcs_general_options'
		);
		
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Status element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_status_callback($args) {

		$options = get_option('tlcs_general_options');

		$html = '<label for="status_on">';
		$html .= '<input type="radio" id="status_on" name="tlcs_general_options[status]" value="1"' . checked( 1, isset( $options['status'] ) ? $options['status'] : 0, false ) . '/>';
		$html .= 'On</label>';
		$html .= '<br>';
		$html .= '<label for="status_off">';
		$html .= '<input type="radio" id="status_off" name="tlcs_general_options[status]" value="0" ' . checked( 0, isset( $options['status'] ) ? $options['status'] : 0, false ) . '/>';
		$html .= 'Off</label>';

		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Roles element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_roles_callback($args) {

		$options = get_option('tlcs_general_options', []);

	    $tmp_roles = get_editable_roles();

	    foreach ($tmp_roles as $tmp_role => $details) {
	      $name = translate_user_role($details['name']);
	      $roles[] = array('val' => $tmp_role,  'label' => $name);
	    }

	    $tmp_users = get_users(array('fields' => array('id', 'display_name')));
	    foreach ($tmp_users as $user) {
	      $users[] = array('val' => $user->id, 'label' => $user->display_name);
	    }

	    foreach ($roles as $tmp_role) {
	      echo  '<input name="tlcs_general_options[roles][]" id="roles-' . $tmp_role['val'] . '" ' . self::checked($tmp_role['val'], isset( $options['roles'] ) ? $options['roles'] : '', false) . ' value="' . (isset($tmp_role['val']) ? $tmp_role['val'] : '') . '" type="checkbox" /> <label for="roles-' . $tmp_role['val'] . '">' . $tmp_role['label'] . '</label><br />';
	    }

		$html = '<p class="description">The user roles enabled to see the frontend. Check a role to enable it to show the website with maintenance mode active.</p>';

		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Noindex element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_noindex_callback($args) {

		$options = get_option('tlcs_general_options');

		$html  = '<p class="description">';
		$html .= '<label for="noindex_meta"></label>';
		$html .= '<input type="checkbox" id="noindex_meta" name="tlcs_general_options[noindex_meta]" value="1" ' . checked( 1, isset( $options['noindex_meta'] ) ? $options['noindex_meta'] : 0, false ) . '/>';
		$html .= '</p>';
		$html .= '<p class="description">Just enable, if you want to prevent search engines from indexing this coming soon page.</p>';
		
		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Countdown element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_countdown_callback($args) {

		$options = get_option('tlcs_general_options');

		$html = '<label for="countdown"></label>';
		$html .= '<input type="text" id="countdown" class="regular-text" name="tlcs_general_options[countdown]" value="'.(isset($options['countdown']) ? $options['countdown'] : '').'" autocomplete="off"/>';
		$html .= '<p class="description">Set countdown at specified time (leave it blank if you want to disable this feature).</p>';
		
		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Countdown element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_google_analytics_callback($args) {

		$options = get_option('tlcs_general_options');

		$html = '<label for="google_analytics"></label>';
		$html .= '<input type="text" id="google_analytics" class="regular-text" name="tlcs_general_options[google_analytics]" value="'.(isset($options['google_analytics']) ? $options['google_analytics'] : '').'" placeholder="UA-XXXXXX-XX"/>';
		$html .= '<p class="description">'.__( 'Enter the unique tracking ID found in your Google Analytics tracking profile settings to track visits to pages.', $this->plugin_slug ).'</p>';
		
		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Insert Header Code element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_insert_header_code_callback($args) {

		$options = get_option('tlcs_general_options');

		$html  = '<textarea id="insert_header_code" class="insert_header_code" rows="6" name="tlcs_general_options[insert_header_code]">'.(isset($options['insert_header_code']) ? $options['insert_header_code'] : '').'</textarea>';

		$html .= '<p class="description">'.__( 'Only accepts javascript code wrapped with &lt;script&gt; tags and HTML markup that is valid inside the &lt;/head&gt; tag.', $this->plugin_slug ).'</p>';
		
		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Insert Footer Code element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_insert_footer_code_callback($args) {

		$options = get_option('tlcs_general_options');

		$html  = '<textarea id="insert_footer_code" rows="6" name="tlcs_general_options[insert_footer_code]">'.(isset($options['insert_footer_code']) ? $options['insert_footer_code'] : '').'</textarea>';

		$html .= '<p class="description">'.__( 'Only accepts javascript code, wrapped with &lt;script&gt; tags and valid HTML markup inside the &lt;/body&gt; tag.', $this->plugin_slug ).'</p>';
		
		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Custom CSS element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_custom_css_callback($args) {

		$options = get_option('tlcs_general_options');

		$html  = '<textarea id="custom_css" rows="6" name="tlcs_general_options[custom_css]">'.(isset($options['custom_css']) ? $options['custom_css'] : '').'</textarea>';

		$html .= '<p class="description">'.__( 'Do not include any tags or HTML in the field. Custom CSS entered here will override the template CSS. In some cases, the <code>!important</code> tag may be needed.', $this->plugin_slug ).'</p>';
		
		echo $html;
	}

	/**
	 * ===============================================================================
	 * Templates
	 * ===============================================================================
	**/

	/**
	 * -------------------------------------------------------------------------------
	 *  Template Options page
	 * -------------------------------------------------------------------------------
	**/
	public function template_options_callback() {
		$options = get_option('tlcs_template_options');
		// var_dump($options);
		//echo '<pre>'; print_r($options); echo '</pre>';
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the Template Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_template_options_default() {

		$defaults = array(
			'template'       =>	'cosmos',
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize Template Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_template_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_template_options' ) ) {
			$default_array = $this->tlcs_template_options_default();
			add_option( 'tlcs_template_options', $default_array );
		}

		//Add template_options section
		add_settings_section(
			'template_settings_section',			            // ID used to identify this section and with which to register options
			'', 											// Title to be displayed on the administration page
			array( $this, 'template_options_callback'),	    // Callback used to render the description of the section
			'tlcs_template_options'		                	// Page on which to add this section of options
		);

		// Templates
		add_settings_field(
			'template',						        		// ID used to identify the field throughout the theme
			__( '', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_template_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_template_options',	            			// The page on which this option will be displayed
			'template_settings_section'		        		// The name of the section to which this field belongs
		);

		register_setting(
			'tlcs_template_options',
			'tlcs_template_options'
		);
		
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Template element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_template_callback($args) {

		$options = get_option('tlcs_template_options');

		$html  = '<h4 class="font-weight-normal">Select the default template style you want to use below.</h4>';
		$html .= '<div id="tlcs-templates">';
		$html .= '<input type="radio" name="tlcs_template_options[template]" id="forest" value="forest"' . checked( 'forest', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="forest" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/forest.jpg" width="250" />';
	    $html .= '<span>Forest</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="cosmos" value="cosmos"' . checked( 'cosmos', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="cosmos" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/cosmos.jpg" width="250" />';
	    $html .= '<span>Cosmos</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="particles" value="particles"' . checked( 'particles', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="particles" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/particles.jpg" width="250" />';
	    $html .= '<span>Particles</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="polygonal" value="polygonal"' . checked( 'polygonal', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="polygonal" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/polygonal.jpg" width="250" />';
	    $html .= '<span>Polygonal</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="cloud" value="cloud"' . checked( 'cloud', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="cloud" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/cloud.jpg" width="250" />';
	    $html .= '<span>Cloud</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="3dbox" value="3dbox"' . checked( '3dbox', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="3dbox" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/3dbox.jpg" width="250" />';
	    $html .= '<span>3D Box</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="medical" value="medical"' . checked( 'medical', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="medical" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/medical.jpg" width="250" />';
	    $html .= '<span>Medical</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="creative" value="creative"' . checked( 'creative', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="creative" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/creative.jpg" width="250" />';
	    $html .= '<span>Creative</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="sport" value="sport"' . checked( 'sport', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="sport" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/sport.jpg" width="250" />';
	    $html .= '<span>Sport</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="wedding" value="wedding"' . checked( 'wedding', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="wedding" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/wedding.jpg" width="250" />';
	    $html .= '<span>Wedding</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="restaurant" value="restaurant"' . checked( 'restaurant', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="restaurant" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/restaurant.jpg" width="250" />';
	    $html .= '<span>Restaurant</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="pacman" value="pacman"' . checked( 'pacman', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="pacman" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/pacman.jpg" width="250" />';
	    $html .= '<span>Pacman</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="building" value="building"' . checked( 'building', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="building" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/building.jpg" width="250" />';
	    $html .= '<span>Building</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="seminar" value="seminar"' . checked( 'seminar', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="seminar" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/seminar.jpg" width="250" />';
	    $html .= '<span>Seminar</span>';
	    $html .= '</label>';

		$html .= '<input type="radio" name="tlcs_template_options[template]" id="app" value="app"' . checked( 'app', isset( $options['template'] ) ? $options['template'] : 0, false ) . '/>';
	    $html .= '<label for="app" class="tlcs-single-template">';
	    $html .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/images/templates/app.jpg" width="250" />';
	    $html .= '<span>App</span>';
	    $html .= '</label>';

	    $html .= '</div>';

		echo $html;

	}

	/**
	 * ===============================================================================
	 * Design
	 * ===============================================================================
	**/

	/**
	 * -------------------------------------------------------------------------------
	 *  Design Options page
	 * -------------------------------------------------------------------------------
	**/
	public function design_options_callback() {
		$options = get_option('tlcs_design_options');
		// var_dump($options);
		//echo '<pre>'; print_r($options); echo '</pre>';
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the Design Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_design_options_default() {

		$defaults = array(
				'favicon'           => '',
				'logo'              => '',
				'title'             => 'This site is undergoing maintenance',
				'headline'          => 'Coming Soon...',
				'content'           => 'Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly. Thank you for your patience!',
				'footer'			=> 'Powered by WordPress | <a href="https://wordpress.org/plugins/tl-coming-soon">TL Coming Soon</a> Plugin by <a href="https://themeluxury.com">ThemeLuxury</a>',
				'background'        => array(
					'type'        => 'solid_color',
					'solid_color' => '',
					'gradient_color' => array(
						'first'    => '',
						'second'   => '',
						'position' => ''
					),
					'single_image' => '',
					'image_slider' => array(
						'data'     => '',
						'duration' => ''
					),
					'pattern' => '',
					'video'   => '',
					'overlay' => array(
						'type'           => '',
						'solid_color'    => '',
						'gradient_color' => array(
							'first'          => '',
							'second'         => '',
							'position'       =>''
						),
						'opacity'        => '',
						'blur'           => ''
					)

				),
				'more_info'         => array(
					'show_button' => 1,
					'headline'    => 'About us',
					'content'     => '',
				),
				'subscribe'    => array(
					'show_button' => 1,
					'service'     => 'mailchimp',
					'campaign_monitor' => array(
						'api_key' => '',
						'client'  => '',
						'list'    => ''
					),
					'convertkit' => array(
						'api_key' => '',
						'form'    => ''
					),
					'feedburner'        => array( 
						'username' => '' 
					),
					'getresponse' => array(
						'api_key'    => '',
						'campaignId' => ''
					),
					'mailchimp'         => array( 
						'api_key' => '',
						'list'    => ''
					),
					'sendinblue' => array(
						'api_key' => '',
						'list'    => ''
					)
				)
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize Design Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_design_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_design_options' ) ) {
			$default_array = $this->tlcs_design_options_default();
			add_option( 'tlcs_design_options', $default_array );
		}

		//Add design_options section
		add_settings_section(
			'design_settings_section',			            // ID used to identify this section and with which to register options
			'', 											// Title to be displayed on the administration page
			array( $this, 'design_options_callback'),	    // Callback used to render the description of the section
			'tlcs_design_options'		                	// Page on which to add this section of options
		);

		// Favicon
		add_settings_field(
			'favicon',						        		// ID used to identify the field throughout the theme
			__( 'Favicon', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_favicon_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'		        		// The name of the section to which this field belongs
		);

		// Logo
		add_settings_field(
			'logo',						        			// ID used to identify the field throughout the theme
			__( 'Logo', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_logo_callback'),			// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'		        		// The name of the section to which this field belongs
		);

		// Title
		add_settings_field(
			'title',						        		// ID used to identify the field throughout the theme
			__( 'Page Title', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_title_callback'),			// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'		        		// The name of the section to which this field belongs
		);

		// Headline
		add_settings_field(
			'headline',						        		// ID used to identify the field throughout the theme
			__( 'Headline', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_headline_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'		        		// The name of the section to which this field belongs
		);

		// Content
		add_settings_field(
			'content',						        	// ID used to identify the field throughout the theme
			__( 'Content', $this->plugin_slug ),		// The label to the left of the option interface element
			array( $this, 'toggle_content_callback'),	// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'
     		// The name of the section to which this field belongs
		);

		// Footer
		add_settings_field(
			'footer',						        	// ID used to identify the field throughout the theme
			__( 'Footer', $this->plugin_slug ),		// The label to the left of the option interface element
			array( $this, 'toggle_footer_callback'),	// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'
     		// The name of the section to which this field belongs
		);

		// Background
		add_settings_field(
			'background',						        	// ID used to identify the field throughout the theme
			__( 'Background Type', $this->plugin_slug ),										// The label to the left of the option interface element
			array( $this, 'toggle_background_callback'),	// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'design_settings_section'		        		// The name of the section to which this field belongs
		);

		/**
		 * -------------------------------------------------------------------------------
		 *  Add More Info Options section
		 * -------------------------------------------------------------------------------
		**/
		add_settings_section(
			'more_info_settings_section',			            // ID used to identify this section and with which to register options
			'More Info <div class="is-divider small"></div>', 											// Title to be displayed on the administration page
			array( $this, 'design_options_callback'),	    // Callback used to render the description of the section
			'tlcs_design_options'		                	// Page on which to add this section of options
		);

		// Show button
		add_settings_field(
			'more_info_button',						        		// ID used to identify the field throughout the theme
			__( 'Show button?', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_more_info_button_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'more_info_settings_section'		        		// The name of the section to which this field belongs
		);

		// Headline
		add_settings_field(
			'more_info_headline',						        		// ID used to identify the field throughout the theme
			__( 'Headline', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_more_info_headline_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'more_info_settings_section'		        		// The name of the section to which this field belongs
		);

		// Content
		add_settings_field(
			'more_info_content',						        		// ID used to identify the field throughout the theme
			__( 'Content', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_more_info_content_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'more_info_settings_section'		        		// The name of the section to which this field belongs
		);

		/**
		 * -------------------------------------------------------------------------------
		 *  Add Subscribe Options section
		 * -------------------------------------------------------------------------------
		**/
		add_settings_section(
			'subscribe_settings_section',			            // ID used to identify this section and with which to register options
			'Subscribe <div class="is-divider small"></div>', 											// Title to be displayed on the administration page
			array( $this, 'design_options_callback'),	    // Callback used to render the description of the section
			'tlcs_design_options'		                	// Page on which to add this section of options
		);

		// Show button
		add_settings_field(
			'subscribe_button',						        		// ID used to identify the field throughout the theme
			__( 'Show button?', $this->plugin_slug ),				// The label to the left of the option interface element
			array( $this, 'toggle_subscribe_button_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'subscribe_settings_section'		        		// The name of the section to which this field belongs
		);

		// Subscribe
		add_settings_field(
			'subscribe',						        		// ID used to identify the field throughout the theme
			__( 'Email Provider', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_subscribe_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_design_options',	            			// The page on which this option will be displayed
			'subscribe_settings_section'		        		// The name of the section to which this field belongs
		);

		register_setting(
			'tlcs_design_options',
			'tlcs_design_options',
			//array( $this, 'validate_input')
		);
		
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Favicon element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_favicon_callback($args) {

		$options = get_option('tlcs_design_options');

		$html  = '<input id="design_favicon" class="regular-text" name="tlcs_design_options[favicon]" type="text" value="'.(isset($options['favicon']) ? esc_attr( $options['favicon'] ) : '').'" />';
		
		$html .= '<input id="favicon_upload_button" class="button-secondary upload-button" type="button" value="'. __( 'Upload', $this->plugin_slug ) .'" />';

		$html .= '<p class="description">Favicon for your website at (16px x 16px) or (32px x 32px).</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Logo element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_logo_callback($args) {

		$options = get_option('tlcs_design_options');

		$html  = '<input id="design_logo" class="regular-text" name="tlcs_design_options[logo]" type="text" value="'.(isset($options['logo']) ? esc_attr( $options['logo'] ) : '').'" />';
		
		$html .= '<input id="logo_upload_button" class="button-secondary upload-button" type="button" value="'. __( 'Upload', $this->plugin_slug ) .'" />';

		$html .= '<p class="description">Select an image file for your logo on the coming soon page.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Title element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_title_callback($args) {

		$options = get_option('tlcs_design_options');

		$html  = '<input type="text" id="title" class="regular-text" name="tlcs_design_options[title]" value="'.(isset($options['title']) ? $options['title'] : '').'">';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Headline element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_headline_callback($args) {

		$options = get_option('tlcs_design_options');

		$html  = '<input type="text" id="headline" class="regular-text" name="tlcs_design_options[headline]" value="'.(isset($options['headline']) ? $options['headline'] : '').'">';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Content element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_content_callback($args) {

		$options = get_option('tlcs_design_options');

        wp_editor(stripslashes( isset( $options['content'] ) ? $options['content'] : '' ), 'main_content', array(
			'textarea_name'  => 'tlcs_design_options[content]',
			'textarea_rows'  => 8,
        ));

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Footer element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_footer_callback($args) {

		$options = get_option('tlcs_design_options');

        wp_editor(stripslashes( isset( $options['footer'] ) ? $options['footer'] : '' ), 'main_footer', array(
			'textarea_name'  => 'tlcs_design_options[footer]',
			'textarea_rows'  => 4,
        ));

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Background element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_background_callback($args) {

		$options = get_option('tlcs_design_options');

		$html  = '<select id="tlcs_design_options_background" class="regular-text tlcs_select2 background_type" name="tlcs_design_options[background][type]">';
		$html .= '<option value="solid_color" ' . selected( 'solid_color', $options['background']['type'], false ) . '>Solid Color</option>';
		$html .= '<option value="gradient_color" ' . selected( 'gradient_color', $options['background']['type'], false ) . '>Gradient Color</option>';
		$html .= '<option value="single_image" ' . selected( 'single_image', $options['background']['type'], false ) . '>Single Image</option>';
		$html .= '<option value="image_slider" ' . selected( 'image_slider', $options['background']['type'], false ) . '>Image Slider (Slideshow)</option>';
		$html .= '<option value="pattern" ' . selected( 'pattern', $options['background']['type'], false ) . '>Pattern</option>';
		$html .= '<option value="video" ' . selected( 'video', $options['background']['type'], false ) . '>Video</option>';
		$html .= '</select>';
		
		$html .= '<tr class="tlcs_design_options-solid_color background_type solid_color">';
		$html .= '<th><label for="tlcs_design_options-solid_color">Choose Solid Color</label></th>';
		$html .= '<td><div class="color-preview"></div><input type="text" id="tlcs_design_options-solid_color" class="solid_color_picker solid-color" name="tlcs_design_options[background][solid_color]" value="'. (isset($options['background']['solid_color']) ? esc_attr(stripslashes( $options['background']['solid_color'] )) : '') .'"></td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-gradient_color background_type gradient_color">';
		$html .= '<th><label for="tlcs_design_options-gradient_color">Add Gradient Color</label></th>';
		$html .= '<td>';
		$html .= '<div class="color-preview"></div>';
		$html .= '<div class="gradient-wrapper">';

		$html .= '<div>';
		$html .= '<input type="text" id="tlcs_design_options-gradient_first_color" class="gradient_first_color color_picker_trigger" name="tlcs_design_options[background][gradient_color][first]" value="'. (isset($options['background']['gradient_color']['first']) ? esc_attr(stripslashes( $options['background']['gradient_color']['first'] )) : '') .'"><p class="description">Set first color</p>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<input type="text" id="tlcs_design_options-gradient_second_color" class="gradient_second_color color_picker_trigger" name="tlcs_design_options[background][gradient_color][second]" value="'. (isset($options['background']['gradient_color']['second']) ? esc_attr(stripslashes( $options['background']['gradient_color']['second'] )) : '') .'"><p class="description">Set second color</p>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<select class="gradient-position" name="tlcs_design_options[background][gradient_color][position]">';
		$html .= '<option value="to top" ' . selected( 'to top', $options['background']['gradient_color']['position'], false ) . '>To Top</option>';
		$html .= '<option value="to right" ' . selected( 'to right', $options['background']['gradient_color']['position'], false ) . '>To Right</option>';
		$html .= '<option value="to bottom" ' . selected( 'to bottom', $options['background']['gradient_color']['position'], false ) . '>To Bottom</option>';
		$html .= '<option value="to left" ' . selected( 'to left', $options['background']['gradient_color']['position'], false ) . '>To Left</option>';
		$html .= '</select>';
		$html .= '<p class="description mt10">Set position</p>';
		$html .= '</div>';

		$html .= '</div></td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-single_image background_type single_image">';
		$html .= '<th><label for="tlcs_design_options-single_image">Add an Image</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-single_image" class="regular-text" name="tlcs_design_options[background][single_image]" type="text" value="'. (isset($options['background']['single_image']) ? esc_attr( $options['background']['single_image'] ) : '') .'" />';
		$html .= '<input id="background-image_upload_button" class="button-secondary upload-button" type="button" value="'. __( 'Upload', $this->plugin_slug ) .'" />';
		$html .= '<p class="description">Leave it blank if you want to use the default template image.</p>';
		$html .= '<div class="screenshot"><div class="overlay-preview"></div>';
		$html .= '<img class="image-preview" src="'. ( isset( $options['background']['single_image'] ) ? $options['background']['single_image'] : '' ) .'">';		
		$html .= '</div>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-image_slider background_type image_slider">';
		$html .= '<th><label for="tlcs_design_options-image_slider">Add an Image Gallery</label></th>';
		$html .= '<td>';
		$html .= '<input id="background-image_slider_upload_button" class="button-secondary upload-button-gallery" type="button" value="'. __( 'Upload Images', $this->plugin_slug ) .'" />';
		$html .= '<p class="description">Leave it blank if you want to use the default template image.</p>';

		$html .= '<div id="image-gallery">';
			if ( isset($options['background']['image_slider']['data']) && $options['background']['image_slider']['data'] != '' ) {
				foreach ($options['background']['image_slider']['data'] as $value) {
					$html .= '<div class="grid-square"><div class="screenshot"><div class="overlay-preview"></div><img class="image-preview" src="'. $value .'"></div><div class="remove-image-button"><span class="dashicons dashicons-no-alt"></span></div><input name="tlcs_design_options[background][image_slider][data][]" type="hidden" value="'.$value.'" /></div>';
				}
				
			}
		$html .= '</div>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-duration background_type image_slider">';
		$html .= '<th><label for="tlcs_design_options-duration">Duration</label></th>';
		$html .= '<td>';
		$html .= '<input type="text" id="tlcs_design_options-duration" class="regular-text" name="tlcs_design_options[background][image_slider][duration]" value="'.(isset($options['background']['image_slider']['duration']) ? $options['background']['image_slider']['duration'] : '3').'">';
		$html .= '<p class="Description">Time between image transitions in slider (the unit is milliseconds).</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-pattern background_type pattern">';
		$html .= '<th><label for="tlcs_design_options-pattern">Upload Pattern</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-pattern" class="regular-text" name="tlcs_design_options[background][pattern]" type="text" value="'. (isset($options['background']['pattern']) ? esc_attr( $options['background']['pattern'] ) : '') .'" />';
		$html .= '<input id="background-pattern_upload_button" class="button-secondary upload-button-pattern" type="button" value="'. __( 'Upload', $this->plugin_slug ) .'" />';
		$html .= '<p class="description">Leave it blank if you want to use the default template image.</p>';
		$html .= '<div class="screenshot pattern-wrapper" style="background-image:url('. (isset($options['background']['pattern']) ? esc_attr( $options['background']['pattern'] ) : '') .')"><div class="overlay-preview"></div>';
		$html .= '</div>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-video background_type video">';
		$html .= '<th><label for="tlcs_design_options-video">Upload Video</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-video" class="regular-text" name="tlcs_design_options[background][video]" type="text" value="'. (isset($options['background']['video']) ? esc_attr( $options['background']['video'] ) : '') .'" />';
		$html .= '<input id="background-video_upload_button" class="button-secondary upload-button" type="button" value="'. __( 'Upload', $this->plugin_slug ) .'" />';
		$html .= '<p class="description">Upload video or use direct link (Support Youtube, MP4 file).</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<table class="form-table background_type single_image image_slider pattern video table-overlay" role="presentation"><tbody>';
		$html .= '<tr class="tlcs_design_options-overlay">';
		$html .= '<th><label for="tlcs_design_options-overlay">Overlay Type</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options_overlay" class="regular-text tlcs_select2 overlay_type" name="tlcs_design_options[background][overlay][type]">';
		$html .= '<option value="solid_color" ' . selected( 'solid_color', $options['background']['overlay']['type'], false ) . '>Solid Color</option>';
		$html .= '<option value="gradient_color" ' . selected( 'gradient_color', $options['background']['overlay']['type'], false ) . '>Gradient Color</option>';
		$html .= '</select>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-overlay_solid_color overlay_type solid_color">';
		$html .= '<th><label for="tlcs_design_options-overlay_solid_color">Choose Solid Color</label></th>';
		$html .= '<td><input type="text" id="tlcs_design_options-overlay_solid_color" class="overlay_solid_color_picker overlay-solid" name="tlcs_design_options[background][overlay][solid_color]" value="'. (isset($options['background']['overlay']['solid_color']) ? esc_attr(stripslashes( $options['background']['overlay']['solid_color'] )) : '') .'"></td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-overlay_gradient_color overlay_type gradient_color">';
		$html .= '<th><label for="tlcs_design_options-overlay_gradient_color">Custom Gradient Color</label></th>';
		$html .= '<td>';

		$html .= '<div class="gradient-wrapper">';

		$html .= '<div>';
		$html .= '<input type="text" id="tlcs_design_options-overlay_gradient_first_color" class="overlay_gradient_first_color color_picker_trigger" name="tlcs_design_options[background][overlay][gradient_color][first]" value="'. (isset($options['background']['overlay']['gradient_color']['first']) ? esc_attr(stripslashes( $options['background']['overlay']['gradient_color']['first'] )) : '') .'"><p class="description">Set first color</p>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<input type="text" id="tlcs_design_options-overlay_gradient_second_color" class="overlay_gradient_second_color color_picker_trigger" name="tlcs_design_options[background][overlay][gradient_color][second]" value="'. (isset($options['background']['overlay']['gradient_color']['second']) ? esc_attr(stripslashes( $options['background']['overlay']['gradient_color']['second'] )) : '') .'"><p class="description">Set second color</p>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<select class="overlay-gradient-position" name="tlcs_design_options[background][overlay][gradient_color][position]">';
		$html .= '<option value="to top" ' . selected( 'to top', $options['background']['overlay']['gradient_color']['position'], false ) . '>To Top</option>';
		$html .= '<option value="to right" ' . selected( 'to right', $options['background']['overlay']['gradient_color']['position'], false ) . '>To Right</option>';
		$html .= '<option value="to bottom" ' . selected( 'to bottom', $options['background']['overlay']['gradient_color']['position'], false ) . '>To Bottom</option>';
		$html .= '<option value="to left" ' . selected( 'to left', $options['background']['overlay']['gradient_color']['position'], false ) . '>To Left</option>';
		$html .= '</select>';
		$html .= '<p class="description mt10">Set position</p>';
		$html .= '</div>';

		$html .= '</div></td>';

		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-opacity">';
		$html .= '<th><label for="tlcs_design_options-opacity">Opacity</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-opacity" class="overlay-opacity" name="tlcs_design_options[background][overlay][opacity]" type="range" min="0" max="1" step="0.1" value="'. (isset($options['background']['overlay']['opacity']) ? esc_attr( $options['background']['overlay']['opacity'] ) : 0) .'" />';
		$html .= '<p class="description">Opacity: <span>'. (isset($options['background']['overlay']['opacity']) ? esc_attr( $options['background']['overlay']['opacity'] ) : 0) .'</span></p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-blur background_type single_image image_slider video table-overlay">';
		$html .= '<th><label for="tlcs_design_options-blur">Blur</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-blur" class="background-blur" name="tlcs_design_options[background][overlay][blur]" type="range" min="0.0" max="10" step="0.5" value="'. (isset($options['background']['overlay']['blur']) ? esc_attr( $options['background']['overlay']['blur'] ) : 0) .'" />';
		$html .= '<p class="description">Amount: <span>'. (isset($options['background']['overlay']['blur']) ? esc_attr( $options['background']['overlay']['blur'] ) : 0) .'</span>px</p>';
		$html .= '</td>';
		$html .= '</tr></tbody></table>';

		echo $html;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  More Info Button
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_more_info_button_callback($args)
	{
		$options = get_option('tlcs_design_options');

		$html  = '<select name="tlcs_design_options[more_info][show_button]" class="regular-text tlcs_select2">
                    <option value="1" ' . selected( 1, $options['more_info']['show_button'], false ) . '>Yes</option>
                    <option value="0" ' . selected( 0, $options['more_info']['show_button'], false ) . '>No</option>
                </select>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  More Info Title element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_more_info_headline_callback($args)
	{
		$options = get_option('tlcs_design_options');

		$html  = '<input type="text" id="more_info_headline" class="regular-text" name="tlcs_design_options[more_info][headline]" value="'. (isset($options['more_info']['headline']) ? $options['more_info']['headline'] : '') .'">';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  More Info Content element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_more_info_content_callback($args)
	{
		$options = get_option('tlcs_design_options');

        wp_editor(stripslashes( isset( $options['more_info']['content'] ) ? $options['more_info']['content'] : '' ), 'more_info_content', array(
			'textarea_name'  => 'tlcs_design_options[more_info][content]',
			'textarea_rows'  => 8,
        ));
	}

	/**
	 * -------------------------------------------------------------------------------
	 * Subscribe Button element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_subscribe_button_callback($args)
	{
		$options = get_option('tlcs_design_options');

		$html  = '<select name="tlcs_design_options[subscribe][show_button]" class="regular-text tlcs_select2">
                    	<option value="1" ' . selected( 1, $options['subscribe']['show_button'], false ) . '>Yes</option>
                    	<option value="0" ' . selected( 0, $options['subscribe']['show_button'], false ) . '>No</option>
                	</select>';

        echo $html;
	}


	/**
	 * -------------------------------------------------------------------------------
	 * Subscribe Content element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_subscribe_callback($args)
	{
		$options = get_option('tlcs_design_options');

		$html = '<select id="tlcs_design_options_service" class="regular-text tlcs_select2 service_type" name="tlcs_design_options[subscribe][service]">';
	    $html .= '<option value="campaign_monitor" ' . selected( 'campaign_monitor', $options['subscribe']['service'], false ) . '>CampaignMonitor</option>';
	    $html .= '<option value="convertkit" ' . selected( 'convertkit', $options['subscribe']['service'], false ) . '>ConvertKit</option>';
	    $html .= '<option value="feedburner" ' . selected( 'feedburner', $options['subscribe']['service'], false ) . '>Feedburner</option>';
	    $html .= '<option value="getresponse" ' . selected( 'getresponse', $options['subscribe']['service'], false ) . '>GetResponse</option>';
	    $html .= '<option value="mailchimp" ' . selected( 'mailchimp', $options['subscribe']['service'], false ) . '>MailChimp</option>';
	    $html .= '<option value="sendinblue" ' . selected( 'sendinblue', $options['subscribe']['service'], false ) . '>SendinBlue</option>';
		$html .= '</select>';
		$html .= '<p class="description">Select the Email Provider you want to setup.</p>';

		/**
		 * CampaignMonitor
		**/
		$html .= '<tr class="tlcs_design_options-campaign_monitor service_type campaign_monitor">';
		$html .= '<th><label for="tlcs_design_options-campaign_monitor_api_key">API Key</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-campaign_monitor_api_key" class="regular-text" name="tlcs_design_options[subscribe][campaign_monitor][api_key]" type="text" value="'.(isset($options['subscribe']['campaign_monitor']['api_key']) ? esc_attr( $options['subscribe']['campaign_monitor']['api_key'] ) : '').'" />';
		$html .= '<button type="button" class="button button-primary" id="tlcs_design_options-campaign_monitor_authorize" name="tlcs_design_options-campaign_monitor_authorize">'. (isset($options['subscribe']['campaign_monitor']['api_key']) && ($options['subscribe']['campaign_monitor']['api_key'] == '') ? __( 'Authorize', 'tl-coming-soon' ) : __( 'Re-Authorize', 'tl-coming-soon' ) ) .'</button>';
		$html .= '<p class="description">Please read this article to know how to <a href="https://docs.themeluxury.com/tl-coming-soon/" title="Get an API Key" target="_blank">Get an API Key</a>.</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-campaign_monitor_client service_type campaign_monitor">';
		$html .= '<th><label for="tlcs_design_options-campaign_monitor_client">Client</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-campaign_monitor_client" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][campaign_monitor][client]">';
		
		if ( is_array( tlcs_get_service_list('campaign_monitor_clients') ) ) {

			foreach (tlcs_get_service_list('campaign_monitor_clients') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['campaign_monitor']['client'], false ) . '>'. $value .'</option>';
			}

		}

		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-campaign_monitor_list service_type campaign_monitor">';
		$html .= '<th><label for="tlcs_design_options-campaign_monitor_list">List</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-campaign_monitor_list" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][campaign_monitor][list]">';
		
		if ( is_array( tlcs_get_service_list('campaign_monitor_lists') ) ) {

			foreach (tlcs_get_service_list('campaign_monitor_lists') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['campaign_monitor']['list'], false ) . '>'. $value .'</option>';
			}

		}

		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		/**
		 * ConvertKit
		**/
		$html .= '<tr class="tlcs_design_options-convertkit service_type convertkit">';
		$html .= '<th><label for="tlcs_design_options-convertkit_api_key">API Key</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-convertkit_api_key" class="regular-text" name="tlcs_design_options[subscribe][convertkit][api_key]" type="text" value="'.(isset($options['subscribe']['convertkit']['api_key']) ? esc_attr( $options['subscribe']['convertkit']['api_key'] ) : '').'" />';
		$html .= '<button type="button" class="button button-primary" id="tlcs_design_options-convertkit_authorize" name="tlcs_design_options-convertkit_authorize">'. (isset($options['subscribe']['convertkit']['api_key']) && ($options['subscribe']['convertkit']['api_key'] == '') ? __( 'Authorize', 'tl-coming-soon' ) : __( 'Re-Authorize', 'tl-coming-soon' ) ) .'</button>';
		$html .= '<p class="description">Please read this article to know how to <a href="https://docs.themeluxury.com/tl-coming-soon/" title="Get an API Key" target="_blank">Get an API Key</a>.</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-convertkit_form service_type convertkit">';
		$html .= '<th><label for="tlcs_design_options-convertkit_form">Form</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-convertkit_form" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][convertkit][form]">';
		
		if ( is_array( tlcs_get_service_list('convertkit_forms') ) ) {

			foreach (tlcs_get_service_list('convertkit_forms') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['convertkit']['form'], false ) . '>'. $value .'</option>';
			}

		}

		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		/**
		 * Feedburner
		**/
		$html .= '<tr class="tlcs_design_options-feedburner service_type feedburner">';
		$html .= '<th><label for="tlcs_design_options-feedburner">Username</label></th>';
		$html .= '<td><input type="text" class="regular-text" name="tlcs_design_options[subscribe][feedburner][username]" value="'. (isset($options['subscribe']['feedburner']['username']) ? esc_attr(stripslashes( $options['subscribe']['feedburner']['username'] )) : '') .'" id="tlcs_design_options-feedburner"></td>';
		$html .= '</tr>';

		/**
		 * GetResponse
		**/
		$html .= '<tr class="tlcs_design_options-getresponse service_type getresponse">';
		$html .= '<th><label for="tlcs_design_options-getresponse_api_key">API Key</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-getresponse_api_key" class="regular-text" name="tlcs_design_options[subscribe][getresponse][api_key]" type="text" value="'.(isset($options['subscribe']['getresponse']['api_key']) ? esc_attr( $options['subscribe']['getresponse']['api_key'] ) : '').'" />';
		$html .= '<button type="button" class="button button-primary" id="tlcs_design_options-getresponse_authorize" name="tlcs_design_options-getresponse_authorize">'. (isset($options['subscribe']['getresponse']['api_key']) && ($options['subscribe']['getresponse']['api_key'] == '') ? __( 'Authorize', 'tl-coming-soon' ) : __( 'Re-Authorize', 'tl-coming-soon' ) ) .'</button>';
		$html .= '<p class="description">Please read this article to know how to <a href="https://docs.themeluxury.com/tl-coming-soon/" title="Get an API Key" target="_blank">Get an API Key</a>.</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-getresponse_campaign service_type getresponse">';
		$html .= '<th><label for="tlcs_design_options-getresponse_campaign">Campaign</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-getresponse_campaign" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][getresponse][campaignId]">';

		if ( is_array( tlcs_get_service_list('getresponse_campaigns') ) ) {

			foreach (tlcs_get_service_list('getresponse_campaigns') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['getresponse']['campaignId'], false ) . '>'. $value .'</option>';
			}

		}

		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		/**
		 * MailChimp
		**/
		$html .= '<tr class="tlcs_design_options-mailchimp service_type mailchimp">';
		$html .= '<th><label for="tlcs_design_options-mailchimp_api_key">API Key</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-mailchimp_api_key" class="regular-text" name="tlcs_design_options[subscribe][mailchimp][api_key]" type="text" value="'.(isset($options['subscribe']['mailchimp']['api_key']) ? esc_attr( $options['subscribe']['mailchimp']['api_key'] ) : '').'" />';
		$html .= '<button type="button" class="button button-primary" id="tlcs_design_options-mailchimp_authorize" name="tlcs_design_options-mailchimp_authorize">'. (isset($options['subscribe']['mailchimp']['api_key']) && ($options['subscribe']['mailchimp']['api_key'] == '') ? __( 'Authorize', 'tl-coming-soon' ) : __( 'Re-Authorize', 'tl-coming-soon' ) ) .'</button>';
		$html .= '<p class="description">Please read this article to know how to <a href="https://docs.themeluxury.com/tl-coming-soon/" title="Get an API Key" target="_blank">Get an API Key</a>.</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-mailchimp_list service_type mailchimp">';
		$html .= '<th><label for="tlcs_design_options-mailchimp_list">List</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-mailchimp_list" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][mailchimp][list]">';
		
		if ( is_array( tlcs_get_service_list('mailchimp_lists') ) ) {

			foreach (tlcs_get_service_list('mailchimp_lists') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['mailchimp']['list'], false ) . '>'. $value .'</option>';
			}

		}

		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		/**
		 * SendinBlue
		**/
		$html .= '<tr class="tlcs_design_options-sendinblue service_type sendinblue">';
		$html .= '<th><label for="tlcs_design_options-sendinblue_api_key">API Key</label></th>';
		$html .= '<td>';
		$html .= '<input id="tlcs_design_options-sendinblue_api_key" class="regular-text" name="tlcs_design_options[subscribe][sendinblue][api_key]" type="text" value="'.(isset($options['subscribe']['sendinblue']['api_key']) ? esc_attr( $options['subscribe']['sendinblue']['api_key'] ) : '').'" />';
		$html .= '<button type="button" class="button button-primary" id="tlcs_design_options-sendinblue_authorize" name="tlcs_design_options-sendinblue_authorize">'. (isset($options['subscribe']['sendinblue']['api_key']) && ($options['subscribe']['sendinblue']['api_key'] == '') ? __( 'Authorize', 'tl-coming-soon' ) : __( 'Re-Authorize', 'tl-coming-soon' ) ) .'</button>';
		$html .= '<p class="description">Please read this article to know how to <a href="https://docs.themeluxury.com/tl-coming-soon/" title="Get an API Key" target="_blank">Get an API Key</a>.</p>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '<tr class="tlcs_design_options-sendinblue_list service_type sendinblue">';
		$html .= '<th><label for="tlcs_design_options-sendinblue_list">List</label></th>';
		$html .= '<td>';
		$html .= '<select id="tlcs_design_options-sendinblue_list" class="regular-text tlcs_select2" name="tlcs_design_options[subscribe][sendinblue][list]">';
		
		if ( is_array( tlcs_get_service_list('sendinblue_lists') ) ) {

			foreach (tlcs_get_service_list('sendinblue_lists') as $key => $value) {
				$html .= '<option value="'. $key .'" ' . selected( $key, $options['subscribe']['sendinblue']['list'], false ) . '>'. $value .'</option>';
			}

		}
		
		$html .= '</select><div class="spinner"></div>';
		$html .= '</td>';
		$html .= '</tr>';

		echo $html;
	}



	/**
	 * ===============================================================================
	 * Socials
	 * ===============================================================================
	**/

	/**
	 * -------------------------------------------------------------------------------
	 *  Social Options Page
	 * -------------------------------------------------------------------------------
	**/
	public function social_options_callback() {
		$options = get_option('tlcs_social_options');
		//var_dump($options);
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the Social Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_social_options_default() {

		$defaults = array(
			'facebook'     => '',
			'twitter'      => '',
			'instagram'    => '',
			'youtube'      => '',
			'linkedin'     => '',
			'skype'        => '',
			'github'       => '',
			'behance'      => '',
			'dribble'      => '',
			'flickr'       => '',
			'pinterest'    => '',
			'tumblr'       => '',
			'vimeo'        => '',
			'vk'           => '',
			'telegram'     => '',
			'whatsapp'     => '',
			'email'        => '',
			'phone' => '',
			'rss'          => '',
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize Social Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_social_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_social_options' ) ) {
			$default_array = $this->tlcs_social_options_default();
			add_option( 'tlcs_social_options', $default_array );
		}

		//Add social options section
		add_settings_section(
			'social_settings_section',			            // ID used to identify this section and with which to register options
			'', 											// Title to be displayed on the administration page
			array( $this, 'social_options_callback'),	    // Callback used to render the description of the section
			'tlcs_social_options'		                	// Page on which to add this section of options
		);

		// Facebook
		add_settings_field(
			'facebook',						        		// ID used to identify the field throughout the theme
			__( 'Facebook', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_facebook_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Twitter
		add_settings_field(
			'twitter',						        		// ID used to identify the field throughout the theme
			__( 'Twitter', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_twitter_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Instagram
		add_settings_field(
			'instagram',						        		// ID used to identify the field throughout the theme
			__( 'Instagram', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_instagram_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Youtube
		add_settings_field(
			'youtube',						        		// ID used to identify the field throughout the theme
			__( 'Youtube', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_youtube_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// LinkedIn
		add_settings_field(
			'linkedin',						        		// ID used to identify the field throughout the theme
			__( 'LinkedIn', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_linkedin_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Skype
		add_settings_field(
			'skype',						        		// ID used to identify the field throughout the theme
			__( 'Skype', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_skype_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);


		// Github
		add_settings_field(
			'github',						        		// ID used to identify the field throughout the theme
			__( 'Github', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_github_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Behance
		add_settings_field(
			'behance',						        		// ID used to identify the field throughout the theme
			__( 'Behance', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_behance_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Dribble
		add_settings_field(
			'dribble',						        		// ID used to identify the field throughout the theme
			__( 'Dribble', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_dribble_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Flickr
		add_settings_field(
			'flickr',						        		// ID used to identify the field throughout the theme
			__( 'Flickr', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_flickr_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Pinterest
		add_settings_field(
			'pinterest',						        		// ID used to identify the field throughout the theme
			__( 'Pinterest', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_pinterest_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Tumblr
		add_settings_field(
			'tumblr',						        		// ID used to identify the field throughout the theme
			__( 'Tumblr', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_tumblr_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Vimeo
		add_settings_field(
			'vimeo',						        		// ID used to identify the field throughout the theme
			__( 'Vimeo', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_vimeo_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// VK
		add_settings_field(
			'vk',						        		// ID used to identify the field throughout the theme
			__( 'VK', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_vk_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Telegram
		add_settings_field(
			'telegram',						        		// ID used to identify the field throughout the theme
			__( 'Telegram', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_telegram_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// WhatsApp
		add_settings_field(
			'whatsapp',						        		// ID used to identify the field throughout the theme
			__( 'WhatsApp', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_whatsapp_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Email
		add_settings_field(
			'email',						        		// ID used to identify the field throughout the theme
			__( 'Email', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_email_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// Phone Number
		add_settings_field(
			'phone',						        		// ID used to identify the field throughout the theme
			__( 'Phone Number', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_phone_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		// RSS
		add_settings_field(
			'rss',						        		// ID used to identify the field throughout the theme
			__( 'RSS', $this->plugin_slug ),			// The label to the left of the option interface element
			array( $this, 'toggle_rss_callback'),		// The name of the function responsible for rendering the option interface
			'tlcs_social_options',	            			// The page on which this option will be displayed
			'social_settings_section'		        		// The name of the section to which this field belongs
		);

		register_setting(
			'tlcs_social_options',
			'tlcs_social_options',
			// array( $this, 'sanitize_social_options')
		);
		
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Facebook element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_facebook_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['facebook'] ) ) {
			$url = esc_url( $options['facebook'] );
		}

		$html  = '<input type="text" id="facebook" class="regular-text" name="tlcs_social_options[facebook]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Facebook profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Twitter element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_twitter_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['twitter'] ) ) {
			$url = esc_url( $options['twitter'] );
		}

		$html  = '<input type="text" id="twitter" class="regular-text" name="tlcs_social_options[twitter]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Twitter profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Instagram element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_instagram_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['instagram'] ) ) {
			$url = esc_url( $options['instagram'] );
		}

		$html  = '<input type="text" id="instagram" class="regular-text" name="tlcs_social_options[instagram]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Instagram profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Youtube element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_youtube_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['youtube'] ) ) {
			$url = esc_url( $options['youtube'] );
		}

		$html  = '<input type="text" id="youtube" class="regular-text" name="tlcs_social_options[youtube]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Youtube profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  LinkedIn element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_linkedin_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['linkedin'] ) ) {
			$url = esc_url( $options['linkedin'] );
		}

		$html  = '<input type="text" id="linkedin" class="regular-text" name="tlcs_social_options[linkedin]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your LinkedIn profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Skype element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_skype_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['skype'] ) ) {
			$url = esc_url( $options['skype'] );
		}

		$html  = '<input type="text" id="skype" class="regular-text" name="tlcs_social_options[skype]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Skype profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Github element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_github_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['github'] ) ) {
			$url = esc_url( $options['github'] );
		}

		$html  = '<input type="text" id="github" class="regular-text" name="tlcs_social_options[github]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Github profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Behance element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_behance_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['behance'] ) ) {
			$url = esc_url( $options['behance'] );
		}

		$html  = '<input type="text" id="behance" class="regular-text" name="tlcs_social_options[behance]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Behance profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Dribble element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_dribble_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['dribble'] ) ) {
			$url = esc_url( $options['dribble'] );
		}

		$html  = '<input type="text" id="dribble" class="regular-text" name="tlcs_social_options[dribble]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Dribble profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Flickr element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_flickr_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['flickr'] ) ) {
			$url = esc_url( $options['flickr'] );
		}

		$html  = '<input type="text" id="flickr" class="regular-text" name="tlcs_social_options[flickr]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Flickr profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Pinterest element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_pinterest_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['pinterest'] ) ) {
			$url = esc_url( $options['pinterest'] );
		}

		$html  = '<input type="text" id="pinterest" class="regular-text" name="tlcs_social_options[pinterest]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Pinterest profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Tumblr element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_tumblr_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['tumblr'] ) ) {
			$url = esc_url( $options['tumblr'] );
		}

		$html  = '<input type="text" id="tumblr" class="regular-text" name="tlcs_social_options[tumblr]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Tumblr profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Vimeo element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_vimeo_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['vimeo'] ) ) {
			$url = esc_url( $options['vimeo'] );
		}

		$html  = '<input type="text" id="vimeo" class="regular-text" name="tlcs_social_options[vimeo]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Vimeo profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  VK element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_vk_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['vk'] ) ) {
			$url = esc_url( $options['vk'] );
		}

		$html  = '<input type="text" id="vk" class="regular-text" name="tlcs_social_options[vk]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your VK profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Telegram element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_telegram_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['telegram'] ) ) {
			$url = esc_url( $options['telegram'] );
		}

		$html  = '<input type="text" id="telegram" class="regular-text" name="tlcs_social_options[telegram]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your Telegram profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  WhatsApp element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_whatsapp_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['whatsapp'] ) ) {
			$url = esc_url( $options['whatsapp'] );
		}

		$html  = '<input type="text" id="whatsapp" class="regular-text" name="tlcs_social_options[whatsapp]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your WhatsApp profile.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Email element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_email_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['email'] ) ) {
			$url = esc_attr( $options['email'] );
		}

		$html  = '<input type="text" id="email" class="regular-text" name="tlcs_social_options[email]" value="'.$url.'">';
		$html .= '<p class="description">Set your Email address.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Phone number element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_phone_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['phone'] ) ) {
			$url = esc_attr( $options['phone'] );
		}

		$html  = '<input type="text" id="phone" class="regular-text" name="tlcs_social_options[phone]" value="'.$url.'" placeholder="+1-123-456-789">';
		$html .= '<p class="description">Set the Phone number in full international format.</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  RSS element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_rss_callback($args) {

		$options = get_option('tlcs_social_options');

		$url = '';
		if( isset( $options['rss'] ) ) {
			$url = esc_url( $options['rss'] );
		}

		$html  = '<input type="text" id="rss" class="regular-text" name="tlcs_social_options[rss]" value="'.$url.'">';
		$html .= '<p class="description">Set the URL of your RSS feed.</p>';

		echo $html;
	}


	/**
	 * -------------------------------------------------------------------------------
	 *  Translation Options Page
	 * -------------------------------------------------------------------------------
	**/
	public function translation_options_callback() {

		$options = get_option('tlcs_translation_options');
		// echo '<pre>'; print_r($options); echo '</pre>';

		$html = '<p>You can edit any text on TL Coming Soon page like button labels, countdowns, subscribe form, etc.</p>';
		$html .= '<table class="table">';
		$html .= '<thead><tr>';
		$html .= '<th>String</th>';
		$html .= '<th>Translation</th>';
		$html .= '</tr></thead>';

		$html .= '<tbody>';

		$html .= '<tr>';
		$html .= '<td>Days</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[days]" value="'.(!empty( $options['days'] ) ? $options['days'] : 'Days').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Hours</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[hours]" value="'.(!empty( $options['hours'] ) ? $options['hours'] : 'Hours').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Minutes</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[minutes]" value="'.(!empty( $options['minutes'] ) ? $options['minutes'] : 'Minutes').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Seconds</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[seconds]" value="'.(!empty( $options['seconds'] ) ? $options['seconds'] : 'Seconds').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>More Info</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[more_info]" value="'.(!empty( $options['more_info'] ) ? $options['more_info'] : 'More Info').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Notify Me</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[notify_me]" value="'.(!empty( $options['notify_me'] ) ? $options['notify_me'] : 'Notify Me').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Follow us on</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[follow]" value="'.(!empty( $options['follow'] ) ? $options['follow'] : 'Follow us on').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Call now</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[call_now]" value="'.(!empty( $options['call_now'] ) ? $options['call_now'] : 'Call now').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Notify me  when its ready</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_headline]" value="'.(!empty( $options['subform_headline'] ) ? $options['subform_headline'] : 'Notify me when its ready').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Our website is under construction, we are working very hard to give you.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_description]" value="'.(!empty( $options['subform_description'] ) ? $options['subform_description'] : 'Our website is under construction, we are working very hard to give you.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Enter your email</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[enter_email]" value="'.(!empty( $options['enter_email'] ) ? $options['enter_email'] : 'Enter your email').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Send</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[send]" value="'.(!empty( $options['send'] ) ? $options['send'] : 'Send').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Account is not setup properly.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_wrong_setup]" value="'.(!empty( $options['subform_error_wrong_setup'] ) ? $options['subform_error_wrong_setup'] : 'Account is not setup properly.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>No list specified.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_no_list]" value="'.(!empty( $options['subform_error_no_list'] ) ? $options['subform_error_no_list'] : 'No list specified.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>No form specified.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_no_form]" value="'.(!empty( $options['subform_error_no_form'] ) ? $options['subform_error_no_form'] : 'No form specified.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>No Campaign specified.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_no_campaign]" value="'.(!empty( $options['subform_error_no_campaign'] ) ? $options['subform_error_no_campaign'] : 'No Campaign specified.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Oops! Unable to subscribe.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_unable]" value="'.(!empty( $options['subform_error_unable'] ) ? $options['subform_error_unable'] : 'Oops! Unable to subscribe.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Oops! Something went wrong. Please try again later.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_undefined]" value="'.(!empty( $options['subform_error_undefined'] ) ? $options['subform_error_undefined'] : 'Oops! Something went wrong. Please try again later.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Oops! This email address is already subscribed.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_error_already_subscribed]" value="'.(!empty( $options['subform_error_already_subscribed'] ) ? $options['subform_error_already_subscribed'] : 'Oops! This email address is already on our list.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Thank you! You have successfully subscribed.</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_success]" value="'.(!empty( $options['subform_success'] ) ? $options['subform_success'] : 'Thank you! You have successfully subscribed.').'"></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>Congratulations! You are almost signed up. Please go to your inbox and confirm your subscription!</td>';
		$html .= '<td><input type="text" name="tlcs_translation_options[subform_confirm]" value="'.(!empty( $options['subform_confirm'] ) ? $options['subform_confirm'] : 'Congratulations! You are almost signed up. Please go to your inbox and confirm your subscription!').'"></td>';
		$html .= '</tr>';

		$html .= '</tbody></table>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the Translation Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_translation_options_default() {

		$defaults = array(
			"days"                             => "Days",
			"hours"                            => "Hours",
			"minutes"                          => "Minutes",
			"seconds"                          => "Seconds",
			"more_info"                        => "More Info",
			"notify_me"                        => "Notify Me",
			"subform_headline"                 => "Notify me when its ready",
			"subform_description"              => "Our website is under construction, we are working very hard to give you.",
			"enter_email"                      => "Enter your email",
			"send"                             => "Send",
			"subform_error_wrong_setup"        => "Account is not setup properly.",
			"subform_error_no_list"            => "No list specified.",
			"subform_error_unable"             => "Oops! Unable to subscribe.",
			"subform_error_undefined"          => "Oops! Something went wrong. Please try again later.",
			"subform_error_already_subscribed" => "Oops! This email address is already on our list.",
			"subform_success"                  => "Thank you! You have successfully subscribed.",
			"subform_confirm"                  => "Congratulations! You are almost signed up. Please go to your inbox and confirm your subscription!",
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize Translation Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_translation_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_translation_options' ) ) {
			$default_array = $this->tlcs_translation_options_default();
			add_option( 'tlcs_translation_options', $default_array );
		}

		//Add social options section
		add_settings_section(
			'translation_settings_section',			            // ID used to identify this section and with which to register options
			'', 											// Title to be displayed on the administration page
			array( $this, 'translation_options_callback'),	    // Callback used to render the description of the section
			'tlcs_translation_options'		                	// Page on which to add this section of options
		);

		register_setting(
			'tlcs_translation_options',
			'tlcs_translation_options'
		);
		
	}


	/**
	 * ===============================================================================
	 * Support
	 * ===============================================================================
	**/

	/**
	 * -------------------------------------------------------------------------------
	 *  Support Options Page
	 * -------------------------------------------------------------------------------
	**/
	public function support_options_callback() {
		$options = get_option('tlcs_support_options');
		// var_dump($options);
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Provides default values for the Support Options
	 * -------------------------------------------------------------------------------
	**/
	public function tlcs_support_options_default() {

		$defaults = array(
			'content'     => ''
		);

		return $defaults;

	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Initialize Support Options
	 * -------------------------------------------------------------------------------
	**/
	public function initialize_support_options()
	{
		// If the theme options don't exist, create them.
		if( false == get_option( 'tlcs_support_options' ) ) {
			$default_array = $this->tlcs_support_options_default();
			add_option( 'tlcs_support_options', $default_array );
		}

		//Add support options section
		add_settings_section(
			'support_settings_section',			            	// ID used to identify this section and with which to register options
			'', 												// Title to be displayed on the administration page
			array( $this, 'toggle_support_content_callback'),	// Callback used to render the description of the section
			'tlcs_support_options'		                		// Page on which to add this section of options
		);

		register_setting(
			'tlcs_support_options',
			'tlcs_support_options',
		);
		
	}

	/**
	 * -------------------------------------------------------------------------------
	 *  Content element
	 * -------------------------------------------------------------------------------
	**/
	public function toggle_support_content_callback($args) {

		$options = get_option('tlcs_support_options');

		$html  = '<p>Customer satisfaction is our priority and we understand that sometimes you need help. We provide friendly and helpful support for all our items. If something is not working, don\'t think twice.</p>';
		$html .= '<a class="button button-primary button-large" href="https://wordpress.org/support/plugin/tl-coming-soon/#new-post" target="_blank">OPEN A SUPPORT TICKET NOW</a>';
		$html .= '<p>Our support agents need this info to provide faster and better support. Please include the following data in your message:</p>';
		$html .= '<table>';
		$html .= '<tr><td>WordPress version:</td> <td><code>' . get_bloginfo('version') . '</code></td></tr>';
		$html .= '<tr><td>TL Coming Soon Version:</td> <td><code>'.TL_COMING_SOON_VERSION.'</code></td></tr>';
	    $html .= '<tr><td>PHP Version:</td> <td><code>' . PHP_VERSION . '</code></td></tr>';
	    $html .= '<tr><td>Site URL:</td> <td><code>' . get_bloginfo('url') . '</code></td></tr>';
	    $html .= '<tr><td>WordPress URL:</td> <td><code>' . get_bloginfo('wpurl') . '</code></td></tr>';
	    $html .= '<tr><td>Theme:</td> <td><code>' . wp_get_theme()->get('Name') . ' - Version: ' . wp_get_theme()->get('Version') . '</code></td></tr>';
	    $html .= '</table>';

		$html  .= '<p>If you are satisfied with this product. Please consider leaving positive feedback and rating to support us. Thank you so much!</p>';

		echo $html;
	}

	/**
	 * -------------------------------------------------------------------------------
	 * Checkbox helper function
	 * -------------------------------------------------------------------------------
	**/
	static function checked($value, $current, $echo = false) {
		$out = '';

		if (!is_array($current)) {
			$current = (array) $current;
		}

		if (in_array($value, $current)) {
			$out = ' checked="checked" ';
		}

		if ($echo) {
			echo $out;
		} else {
			return $out;
		}
	}

	/**
	 * -------------------------------------------------------------------------------
	 * Sanitization callback for the social options. Since each of the social options are text inputs,
	 * this function loops through the incoming option and strips all tags and slashes from the value
	 * before serializing it
	 * -------------------------------------------------------------------------------
	**/
	public function sanitize_social_options( $input ) {

		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach( $input as $key => $val ) {

			if( isset ( $input[$key] ) ) {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}

		}

		// Return the new collection
		return apply_filters( 'sanitize_social_options', $output, $input );

	}

	/**
	 * -------------------------------------------------------------------------------
	 * Validate Input element
	 * Strips all tags and slashes from the value before serializing it
	 * -------------------------------------------------------------------------------
	**/
	public function validate_input( $input ) {

		// Create our array for storing the validated options
		$output = array();
		
		// Loop through each of the incoming options
		foreach( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if( isset( $input[$key] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings
				$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );

			}

		}

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'validate_input', $output, $input );

	}

	//End Scripts
	//
}