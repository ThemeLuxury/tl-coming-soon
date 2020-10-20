<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeluxury.com/
 * @since      1.0.0
 *
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    TL_Coming_Soon
 * @subpackage TL_Coming_Soon/includes
 * @author     ThemeLuxury <themeluxury@gmail.com>
 */
class TL_Coming_Soon_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tl-coming-soon',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
