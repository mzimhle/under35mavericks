<?php

//! Social media icons
class air_social {

	private static
		//! Option name
		$option_name = 'air-social',
		//! Options
		$options,
		// Path
		$path,
		// URL
		$url;

	/**
		Get option
		@param $key string
		@param $def string
		@return mixed
	**/
	private function get($key,$std=NULL) {
		return isset(self::$options[$key])?self::$options[$key]:$std;
	}

	/**
		Action : admin_init
		@return NULL
	**/
	static function admin_init() {
		// Register settings
		register_setting(sprintf('%s-settings',self::$option_name),self::$option_name,
			__CLASS__.'::validate_settings');
	}

	/**
		Action : admin_enqueue_scripts
		@return NULL
	**/
	static function admin_enqueue_scripts($hook) {
		// Only load on theme admin pages
		if ( $hook != get_plugin_page_hook('theme-modules','admin.php') )
			return;

		// Only load for social module
		if (isset($_GET['module']) && ('social' == $_GET['module'])) {
			// Enqueue font awesome
			wp_enqueue_style('air-fa',get_template_directory_uri().'/fonts/font-awesome.min.css');
			// Enqueue module style and script
			wp_enqueue_style('air-social',sprintf('%1$s/social.css',self::$url));
			wp_enqueue_script('air-social',sprintf('%1$s/social.js',self::$url),
				array('jquery','jquery-ui-core','jquery-ui-sortable'));
		}
	}

	/**
		Callback : validate_settings
		@param $input array
		@return array
	**/
	static function validate_settings($input) {
		// If no input, return
		if (!$input)
			return;
		
		$action = esc_attr($input['action']);

		// Add new icon
		if ($action == 'new') {
			// Get current options
			$valid = get_option(self::$option_name);

			// Any options exist?
			if (!$valid) { $valid = array(); }

			// Validate input
			$tmp['url'] = esc_url($input['url']);
			$tmp['name'] = esc_attr($input['name']);
			$tmp['icon'] = esc_attr($input['icon']);

			// New Window
			$tmp['new-window'] = isset($input['new-window'])?'1':'0';

			// Add to array
			$valid[] = $tmp;

			// Return validated settings
			return $valid;
		}

		// Update current icons
		if ($action == 'update') {
			// Unset action
			unset($input['action']);
			
			// Create valid array
			$valid = array();
			
			// Loop through items for update
			foreach ($input as $item) {
				$item['url'] = esc_url($item['url']);
				$item['name'] = esc_attr($item['name']);
				$item['icon'] = esc_attr($item['icon']);

				// New Window
				$item['new-window'] = isset($item['new-window'])?'1':'0';

				// Add to valid array
				$valid[] = $item;
				
				// Unset item
				unset($item);
			}

			// Return validated settings
			return $valid;
		}
	}

	/**
		Icons
		@return array
	**/
	static function get_icons() {
		// Icons
		$icons = 'phone|phone-sign|facebook|facebook-sign|twitter|twitter-sign|github|github-alt|'.
			'github-sign|linkedin|linkedin-sign|pinterest|pinterest-sign|google-plus|'.
			'google-plus-sign|sign-blank';
		// Return icons
		return explode('|',$icons);
	}

	/**
		Get icon list
		@return string
	**/
	static function get_icon_list() {
		// Get icons
		$icons = self::get_icons();

		// Start list output
		$output = '<ul class="air-social-icons">';

		// Loop through icons
		foreach ($icons as $icon)
				$output .= sprintf('<li><i class="icon-%s"></i></li>',$icon);

		// End list output
		$output .= '</ul>';

		// Return list
		return $output;
	}

	/**
		Get items
			@public
	**/
	static function get_items() {
		return self::$options;
	}

	/**
		Initialize module
	**/
	static function init() {
		// Set options
		self::$options = get_option(self::$option_name);

		// Set default option
		if (self::$options == FALSE) {
			update_option(self::$option_name,'');
		}

		// Set path and url
		self::$path = AIR_MODULES . '/social';
		self::$url = get_template_directory_uri() . '/air/modules/social';

		// Admin
		if (is_admin()) {
			// Register settings
			add_action('admin_init',__CLASS__.'::admin_init');
			// Enqueue admin styles and scripts
			add_action('admin_enqueue_scripts',__CLASS__.'::admin_enqueue_scripts');
		}
	}

	//! Prohibit cloning
	private function __clone() {
	}

	//! Prohibit instantiation
	private function __construct() {}

}

air_social::init();