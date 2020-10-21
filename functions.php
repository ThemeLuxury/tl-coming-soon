<?php 

/**
 * -------------------------------------------------------------------------------
 *  Subscribe configs
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_subscribe_configs' ) ) {

	add_action('admin_enqueue_scripts', 'tlcs_subscribe_configs');
	function tlcs_subscribe_configs() {
		
		$args = array(
			'url'	           => esc_url( admin_url('admin-ajax.php') ),
			'nonce'            => tlcs_create_nonce('subscribe-nonce'),
		);
		wp_enqueue_script( 'tlcs_subscribe_configs', TL_COMING_SOON_URL . 'admin/assets/js/subscribe.js', array(), '1.0.0', true );
		wp_localize_script('tlcs_subscribe_configs', 'doSubscribe', $args);

	}
}

/**
 * -------------------------------------------------------------------------------
 *  CampaignMonitor function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_campaign_monitor_subscribe' ) ) {

	add_action('wp_ajax_campaign_monitor', 'tlcs_campaign_monitor_subscribe');
	add_action('wp_ajax_nopriv_campaign_monitor', 'tlcs_campaign_monitor_subscribe');
	function tlcs_campaign_monitor_subscribe() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'subscribe-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		$options = '';

		if (isset($_POST['api_key']) && $_POST['api_key'] != '') {

			require_once( 'includes/services/CampaignMonitor/csrest_general.php');
			require_once( 'includes/services/CampaignMonitor/csrest_clients.php');
			
			$auth = array('api_key' => sanitize_text_field( $_POST['api_key']  ));
			
			$wrap = new CS_REST_General($auth);
			
			$result = $wrap->get_clients();

			if ($result->was_successful()) {

				$clients = array();

				foreach( $result->response as $client ) {
					$clients[$client->ClientID] = $client->Name;
				}

				$wrap = new CS_REST_Clients($client->ClientID, sanitize_text_field( $_POST['api_key'] ) );
				
				$result = $wrap->get_lists();
				
				if ($result->was_successful()) {

					$lists = array();

					foreach( $result->response as $list ) {
						$lists[$list->ListID] = $list->Name;
					}

				}
			}
		}

		update_option( 'tlcs_design_options_campaign_monitor_clients', $clients );
		update_option( 'tlcs_design_options_campaign_monitor_lists', $lists );

		wp_send_json(array(
			'success' => true,
			'clients' => $clients,
			'lists' => $lists
		));
		
	    die(); 
	}
}

/**
 * -------------------------------------------------------------------------------
 *  ConvertKit function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_convertkit_subscribe' ) ) {

	add_action('wp_ajax_convertkit', 'tlcs_convertkit_subscribe');
	add_action('wp_ajax_nopriv_convertkit', 'tlcs_convertkit_subscribe');
	function tlcs_convertkit_subscribe() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'subscribe-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		$options = '';

		if (isset($_POST['api_key']) && $_POST['api_key'] != '') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/ConvertKit.php');

			$data = new ConvertKit(sanitize_text_field( $_POST['api_key'] ) );
			
			$result = $data->getForms();

			if ( isset($result) ) {

				$forms = array();
				foreach( $result->forms as $key => $form ) {
					$forms[$form->id] = $form->name;
				}

			}

		}

		update_option( 'tlcs_design_options_convertkit_forms', $forms );

		wp_send_json(array(
			'success' => true,
			'forms' => $forms
		));
		
	    die(); 
	}
}

/**
 * -------------------------------------------------------------------------------
 *  GetResponse function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_getresponse_subscribe' ) ) {

	add_action('wp_ajax_getresponse', 'tlcs_getresponse_subscribe');
	add_action('wp_ajax_nopriv_getresponse', 'tlcs_getresponse_subscribe');
	function tlcs_getresponse_subscribe() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'subscribe-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		if (isset($_POST['api_key']) && $_POST['api_key'] != '') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/GetResponse.php');

			$data = new GetResponse(sanitize_text_field( $_POST['api_key'] ) );
			
			$result = $data->getCampaigns();

			if ( isset($result) ) {

				$campaigns = array();

				foreach ($result as $key => $campaign) {
					$campaigns[$campaign->campaignId] = $campaign->name;
				}

			}

		}

		update_option( 'tlcs_design_options_getresponse_campaigns', $campaigns );

		wp_send_json(array(
			'success' => true,
			'campaigns' => $campaigns
		));
		
	    die(); 
	}
}

/**
 * -------------------------------------------------------------------------------
 *  Mailchimp function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_mailchimp_subscribe' ) ) {

	add_action('wp_ajax_mailchimp', 'tlcs_mailchimp_subscribe');
	add_action('wp_ajax_nopriv_mailchimp', 'tlcs_mailchimp_subscribe');
	function tlcs_mailchimp_subscribe() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'subscribe-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		if (isset($_POST['api_key']) && $_POST['api_key'] != '') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/MailChimp.php');

			$MailChimp = new MailChimp(sanitize_text_field( $_POST['api_key'] ) );
			
			$result = $MailChimp->get('lists');

			if (isset($result) && is_array($result)) {
				$lists = array();
				foreach ($result['lists'] as $list) {
					$lists[$list['id']] = $list['name'];
				}

			}
		}

		update_option( 'tlcs_design_options_mailchimp_lists', $lists );

		wp_send_json(array(
			'success' => true,
			'lists' => $lists
		));
		
	    die(); 
	}
}

/**
 * -------------------------------------------------------------------------------
 *  SendinBlue function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_sendinblue_subscribe' ) ) {

	add_action('wp_ajax_sendinblue', 'tlcs_sendinblue_subscribe');
	add_action('wp_ajax_nopriv_sendinblue', 'tlcs_sendinblue_subscribe');
	function tlcs_sendinblue_subscribe() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'subscribe-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		if (isset($_POST['api_key']) && $_POST['api_key'] != '') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/SendinBlue.php');

			$SendinBlue = new SendinBlue(sanitize_text_field( $_POST['api_key'] ) );
			
			$result = $SendinBlue->getLists();

			if ( isset($result) ) {

				$lists = array();
				foreach( $result->lists as $key => $list ) {
					$lists[$list->id] = $list->name;
				}

			}

		}

		update_option( 'tlcs_design_options_sendinblue_lists', $lists );

		wp_send_json(array(
			'success' => true,
			'lists' => $lists
		));

	    die(); 
	}
}


function tlcs_get_service_list( $name = '' ) {

	if( !$name ) {
		return;
	}

	$list = get_option( 'tlcs_design_options_'. $name );

	return empty( $list ) ? array() : $list;
}

/**
 * -------------------------------------------------------------------------------
 *  Subscribe form on the Public page configs
 * -------------------------------------------------------------------------------
**/

if ( !function_exists( 'tlcs_subscribe_form_configs' ) ) {

	add_action('tlcs_subscribe_form_ajax', 'tlcs_subscribe_form_configs');
	function tlcs_subscribe_form_configs() {
		
			$args = array(
				'url'	           => esc_url( admin_url('admin-ajax.php') )
			);
		?>

			<script id='tlcs_subscribe_configs-js-extra'>
				var onSubscribe = <?php echo json_encode($args) ?>;
			</script>

		<?php

	}
}

/**
 * -------------------------------------------------------------------------------
 *  Subscribe form on the Public page
 * -------------------------------------------------------------------------------
**/

if ( ! function_exists( 'tlcs_subscribe_form' ) ) {

	add_action( 'wp_ajax_subscribe_form', 'tlcs_subscribe_form' );
	add_action( 'wp_ajax_nopriv_subscribe_form', 'tlcs_subscribe_form' );

	function tlcs_subscribe_form()
	{
		$options = get_option('tlcs_design_options');
		
		// MailChimp
		if ($_POST['type'] == 'mailchimp') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/MailChimp.php');

			if (!isset($options['subscribe']['mailchimp']['api_key']) || $options['subscribe']['mailchimp']['api_key'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_wrong_setup'] ) ? get_option('tlcs_translation_options')['subform_error_wrong_setup'] : ''),
				));

				die();
			}

			if (!isset($options['subscribe']['mailchimp']['list']) || $options['subscribe']['mailchimp']['list'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_no_list'] ) ? get_option('tlcs_translation_options')['subform_error_no_list'] : 'No list specified.')
				));

				die();
			}

			$MailChimp = new MailChimp($options['subscribe']['mailchimp']['api_key']);
			
			$result = $MailChimp->post('lists/'.$options['subscribe']['mailchimp']['list'].'/members', [
				'email_address' => sanitize_email( $_POST['email'] ),
				'status'        => 'subscribed',
            ]);

            if ($result) {

	            if (isset($result['email_address'])) {

					echo json_encode(array(
						'status'		=> 'subscribed',
						'message'		=> (!empty( get_option('tlcs_translation_options')['subform_success'] ) ? get_option('tlcs_translation_options')['subform_success'] : 'Thank you! You have successfully subscribed.'),
					));

					die();
	            }

	            else {
					echo json_encode(array(
						'status'		=> 'error',
						'message'		=> $result['detail'],
					));

					die();
	            }
            } else {

	            echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_unable'] ) ? get_option('tlcs_translation_options')['subform_error_unable'] : 'Oops! Unable to subscribe.'),
				));

				die();
            }

		}
		//ConvertKit
		elseif ($_POST['type'] == 'convertkit') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/ConvertKit.php');

			if (!isset($options['subscribe']['convertkit']['api_key']) || $options['subscribe']['convertkit']['api_key'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_wrong_setup'] ) ? get_option('tlcs_translation_options')['subform_error_wrong_setup'] : ''),
				));

				die();
			}

			if (!isset($options['subscribe']['convertkit']['form']) || $options['subscribe']['convertkit']['form'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_no_form'] ) ? get_option('tlcs_translation_options')['subform_error_no_form'] : 'No form specified.'),
				));

				die();
			}

			$ConvertKit = new ConvertKit($options['subscribe']['convertkit']['api_key']);
			
			$result = $ConvertKit->addSubscribe($options['subscribe']['convertkit']['form'], array(
				'api_key' => $options['subscribe']['convertkit']['api_key'],
				'email'   => sanitize_email( $_POST['email'] ),
            ));

            if ($result) {

	            if (isset($result->subscription)) {

	            	if ( $result->subscription->state == 'active' ) {

						echo json_encode(array(
							'status'		=> 'subscribed',
							'message'		=> (!empty( get_option('tlcs_translation_options')['subform_success'] ) ? get_option('tlcs_translation_options')['subform_success'] : 'Thank you! You have successfully subscribed.'),
						));

	            	}
	            	else{
						echo json_encode(array(
							'status'		=> 'subscribed',
							'message'		=> (!empty( get_option('tlcs_translation_options')['subform_confirm'] ) ? get_option('tlcs_translation_options')['subform_confirm'] : 'Congratulations! You are almost signed up. Please go to your inbox and confirm your subscription!'),
						));
					}

					die();
	            }

	            else {
					echo json_encode(array(
						'status'		=> 'error',
						'message'		=> (!empty( get_option('tlcs_translation_options')['subform_error_undefined'] ) ? get_option('tlcs_translation_options')['subform_error_undefined'] : 'Oops! Something went wrong. Please try again later.'),
					));

					die();
	            }
            } else {

	            echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_unable'] ) ? get_option('tlcs_translation_options')['subform_error_unable'] : 'Oops! Unable to subscribe.'),
				));

				die();
            }

		}
		// CampaignMonitor
		elseif ( $_POST['type'] == 'campaign_monitor' ) {

			// No First Name
			if (!isset($_POST['first_name'])) {
				$_POST['first_name'] = '';
			}

			// No Last Name
			if (!isset($_POST['last_name'])) {
				$_POST['last_name'] = '';
			}

			require_once('includes/services/CampaignMonitor/csrest_subscribers.php');
			$wrap = new CS_REST_Subscribers($options['subscribe']['campaign_monitor']['list'], $options['subscribe']['campaign_monitor']['api_key']);

			// Check if subscribor is already subscribed

			$result = $wrap->get(sanitize_email( $_POST['email'] ));

			if ($result->was_successful()) {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_already_subscribed'] ) ? get_option('tlcs_translation_options')['subform_error_already_subscribed'] : 'Oops! This email address is already subscribed.'),
				));

				die();
			}

			$result = $wrap->add(array(
				'EmailAddress' 	=> sanitize_email($_POST['email']),
				'Name' 			=> sanitize_text_field( $_POST['first_name'] ). ' ' . sanitize_text_field( $_POST['last_name'] ),
				'Resubscribe' 	=> true
			));

			if ($result->was_successful()) {

				echo json_encode(array(
					'status'		=> 'subscribed',
					'message'		=> (!empty( get_option('tlcs_translation_options')['subform_success'] ) ? get_option('tlcs_translation_options')['subform_success'] : 'Thank you! You have successfully subscribed.'),
				));

				die();

			} else {

				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> $result->response->Message,
				));

				die();
			}
			
		}
		//Getresponse
		elseif ($_POST['type'] == 'getresponse') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/GetResponse.php');

			if (!isset($options['subscribe']['getresponse']['api_key']) || $options['subscribe']['getresponse']['api_key'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_wrong_setup'] ) ? get_option('tlcs_translation_options')['subform_error_wrong_setup'] : ''),
				));

				die();
			}

			if (!isset($options['subscribe']['getresponse']['campaignId']) || $options['subscribe']['getresponse']['campaignId'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_no_campaign'] ) ? get_option('tlcs_translation_options')['subform_error_no_campaign'] : 'No Campaign specified.'),
				));

				die();
			}

			$data = new GetResponse($options['subscribe']['getresponse']['api_key']);
			
			$result = $data->addContact([
				'email' => sanitize_email( $_POST['email'] ),
				"campaign" => [
					"campaignId" => $options['subscribe']['getresponse']['campaignId']
				]
            ]);

            if ($result && isset( $result->message )) {

				echo json_encode(array(
					'status'		=> 'error',
					'message'		=> $result->message,
				));

				die();
	            
            } else {

				echo json_encode(array(
					'status'		=> 'subscribed',
					'message'		=> (!empty( get_option('tlcs_translation_options')['subform_success'] ) ? get_option('tlcs_translation_options')['subform_success'] : 'Thank you! You have successfully subscribed.'),
				));

				die();
            }

		}
		//SendinBlue
		elseif ($_POST['type'] == 'sendinblue') {

			require_once( TL_COMING_SOON_DIR . 'includes/services/SendinBlue.php');

			if (!isset($options['subscribe']['sendinblue']['api_key']) || $options['subscribe']['sendinblue']['api_key'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_wrong_setup'] ) ? get_option('tlcs_translation_options')['subform_error_wrong_setup'] : 'Account is not setup properly.'),
				));

				die();
			}

			if (!isset($options['subscribe']['sendinblue']['list']) || $options['subscribe']['sendinblue']['list'] == '') {
				echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_no_list'] ) ? get_option('tlcs_translation_options')['subform_error_no_list'] : 'No list specified.'),
				));

				die();
			}

			$SendinBlue = new SendinBlue($options['subscribe']['sendinblue']['api_key']);
			
			$result = $SendinBlue->addContact(array(
				"listIds" => [(int)$options['subscribe']['sendinblue']['list']],
				"email" => sanitize_email( $_POST['email'] )
            ));

            if ($result) {

	            if (isset($result->id)) {

					echo json_encode(array(
						'status'		=> 'subscribed',
						'message'		=> (!empty( get_option('tlcs_translation_options')['subform_success'] ) ? get_option('tlcs_translation_options')['subform_success'] : 'Thank you! You have successfully subscribed.'),
					));

					die();
	            }

	            else {
					echo json_encode(array(
						'status'		=> 'error',
						'message'		=> $result->message,
					));

					die();
	            }
            } else {

	            echo json_encode(array(
					'status'	=> 'error',
					'message'	=> (!empty( get_option('tlcs_translation_options')['subform_error_unable'] ) ? get_option('tlcs_translation_options')['subform_error_unable'] : 'Oops! Unable to subscribe.'),
				));

				die();
            }

		}

		//
		die(); 

	}
}

/**
 * -------------------------------------------------------------------------------
 *  Subscribe configs
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_toggle_status_configs' ) ) {

	add_action('admin_enqueue_scripts', 'tlcs_toggle_status_configs');
	add_action('wp_enqueue_scripts', 'tlcs_toggle_status_configs');
	function tlcs_toggle_status_configs() {
		
		$args = array(
			'url'	           => esc_url( admin_url('admin-ajax.php') )
		);
		wp_enqueue_script( 'tlcs_toggle_status_configs', TL_COMING_SOON_URL . 'admin/assets/js/toggle-status.js', array(), '1.0.0', true );
		wp_localize_script('tlcs_toggle_status_configs', 'doToggle', $args);

	}
}

/**
 * -------------------------------------------------------------------------------
 *  Toggle status function
 * -------------------------------------------------------------------------------
**/
if ( !function_exists( 'tlcs_toggle_status' ) ) {

	add_action('wp_ajax_tlcs_toggle', 'tlcs_toggle_status');
	add_action('wp_ajax_nopriv_tlcs_toggle', 'tlcs_toggle_status');
	function tlcs_toggle_status() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? tlcs_clear( $_REQUEST['nonce'] ) : 0;
		if ( !tlcs_verify_nonce( 'toggle-nonce', $nonce ) ) {
			exit( 'Not permitted' );
		}

		$status = isset( $_POST['status'] ) ? sanitize_key( $_POST['status'] ) : 0;
		
		$options = get_option('tlcs_general_options');

		if ( $status == 1) {
			$options['status'] = 0;
		}
		else $options['status'] = 1;
	    
	    update_option('tlcs_general_options', $options);
	    
	    echo 'success';

	    die(); 
	}
}

/**
 * -------------------------------------------------------------------------------
 *  Verify nonce
 * -------------------------------------------------------------------------------
**/
if ( ! function_exists( 'tlcs_verify_nonce' ) ) {

	function tlcs_verify_nonce( $id, $value ) {
	    $nonce = get_option( $id );
	    if( $nonce == $value )
	        return true;
	    return false;
	}

}

/**
 * -------------------------------------------------------------------------------
 *  Create nonce
 * -------------------------------------------------------------------------------
**/
if ( ! function_exists( 'tlcs_create_nonce' ) ) {

	function tlcs_create_nonce( $id ) {
	    if( ! get_option( $id ) ) {
	        $nonce = wp_create_nonce( $id );
	        update_option( $id, $nonce );
	    }
	    return get_option( $id );
	}

}

/**
 * -------------------------------------------------------------------------------
 *  Clear text
 * -------------------------------------------------------------------------------
**/
if ( ! function_exists( 'tlcs_clear' ) ) {

	function tlcs_clear($text) {
		return wp_strip_all_tags(html_entity_decode($text));
	}

}

/**
 * -------------------------------------------------------------------------------
 *  Admin bar setup
 * -------------------------------------------------------------------------------
**/

add_action( 'admin_bar_menu', 'tlcs_admin_bar_menu', 500 );
function tlcs_admin_bar_menu ( WP_Admin_Bar $admin_bar ) {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $menu_id = 'tlcs_menu';

    $admin_bar->add_menu( array(
        'id'    => $menu_id,
        'title' => '<span class="ab-icon tl-admin-icon"></span><span class="ab-label">Coming Soon <i class="pulse dot-'.(isset( get_option('tlcs_general_options')['status'] ) ? get_option('tlcs_general_options')['status'] : 0).'"></i></span>', //you can use img tag with image link. it will show the image icon Instead of the title.
        'href'  => admin_url('admin.php?page=tl_coming_soon_options'),
    ) );

    $admin_bar->add_node( array(
        'id'    => 'tlcs_menu_status',
        'parent' => $menu_id,
        'title' => 'Status <div id="tlcs_toggle" class="status-'.(isset( get_option('tlcs_general_options')['status'] ) ? get_option('tlcs_general_options')['status'] : 0).'" data-nonce="'.tlcs_create_nonce('toggle-nonce').'"><span class="toggle_handler"></span><input name="tlcs_toggle_status" id="tlcs_toggle_status" type="hidden" value="'.(isset( get_option('tlcs_general_options')['status'] ) ? get_option('tlcs_general_options')['status'] : 0).'" /></div>'
    ) );

    $admin_bar->add_node( array(
        'id'    => 'tlcs_menu_preview',
        'parent' => $menu_id,
        'title' => 'Preview',
        'href'  => esc_url( home_url('?tlcs-preview') ),
        'meta' => array(	'target' => '_blank')
    ) );

    $admin_bar->add_node( array(
        'id'    => 'tlcs_menu_settings',
        'parent' => $menu_id,
        'title' => 'Settings',
        'href'  => admin_url('admin.php?page=tl_coming_soon_options'),
    ) );

}


//End scripts
?>