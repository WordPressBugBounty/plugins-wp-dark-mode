<?php

/**
 * Contains all the configuration related tasks for WP Dark Mode
 *
 * @package WP Dark Mode
 * @since 5.0.0
 */

// Namespace.


namespace WP_Dark_Mode;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit( 1 );

if ( ! class_exists( __NAMESPACE__ . 'Config' ) ) {
	/**
	 * Contains all the configuration related tasks for WP Dark Mode
	 *
	 * @package WP Dark Mode
	 * @since 5.0.0
	 */
	class Config {

		/**
		 * Instance of the class
		 *
		 * @since 5.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Returns the instance of the class
		 *
		 * @since 5.0.0
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Config();
			}

			return self::$instance;
		}


		/**
		 * Returns the default options for WP Dark Mode
		 *
		 * @since 5.0.0
		 * @var array
		 */
		public static function get_default_options() {
			$options = [
				'frontend' => [
					'enabled' => [
						'type' => 'boolean',
						'default' => true,
					],
					'mode' => array(
						'type' => 'string',
						'default' => 'device',
						'options' => array(
							'default_light' => [
								'name' => 'Default Light Mode',
								'description' => 'Enable this setting if you want light mode as the default mode of your site. Visitors will find the website in light mode first.',
							],
							'default' => [
								'name' => 'Default Dark Mode',
								'description' => 'Enable this setting if you want dark mode as the default mode of your site. Visitors will find the website in dark mode first.',
							],
							'device' => [
								'name' => 'Use system settings',
								'description' => 'Dark mode will be enabled/disabled depending on the user\'s device settings.',
							],
							'time' => [
								'name' => 'Time based dark mode',
								'description' => 'Automatically enable dark mode based on user\'s given time.',
							],
							'sunset' => [
								'name' => 'Sunset Mode',
								'description' => 'Automatically enable dark mode at sunset based on the user\'s location.',
							],
						),
					),
					'time_starts' => array(
						'type' => 'string',
						'default' => '06:00 PM',
					),
					'time_ends' => array(
						'type' => 'string',
						'default' => '06:00 AM',
					),
					'custom_css' => array(
						'type' => 'string',
						'default' => '',
					),
					'remember_choice' => array(
						'type' => 'boolean',
						'default' => true,
					),
				],
				'admin' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'enabled_block_editor' => array(
						'type' => 'boolean',
						'default' => true,
					),
				),
				'floating_switch' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => true,
					),
					'display' => [
						'type' => 'array',
						'default' => [
							'desktop' => true,
							'mobile' => true,
							'tablet' => true,
						],
					],
					'style' => array(
						'type' => 'number',
						'default' => 1,
					),
					'size' => array(
						'type' => 'mixed',
						'default' => 1,
						'options' => array(
							[
								'name' => 'S',
								'value' => 0.8,
							],
							[
								'name' => 'M',
								'value' => 1,
							],
							[
								'name' => 'L',
								'value' => 1.2,
							],
							[
								'name' => 'XL',
								'value' => 1.4,
							],
							[
								'name' => 'XXL',
								'value' => 1.6,
							],
							[
								'name' => 'Custom',
								'value' => 'custom',
							],
						),
					),
					'size_custom' => array(
						'type' => 'number',
						'default' => 100,
					),
					'position' => array(
						'type' => 'string',
						'options' => array(
							[
								'name' => 'Left',
								'value' => 'left',
								'icon' => '<svg class="w-4 stroke-current" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.125 5.625H16.875M3.125 10H16.875M3.125 14.375H10" stroke="stroke-current" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>',
							],
							[
								'name' => 'Right',
								'value' => 'right',
								'icon' => '<svg class="w-4 fill-current" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2 4.75C2 4.33579 2.33579 4 2.75 4H17.25C17.6642 4 18 4.33579 18 4.75C18 5.16421 17.6642 5.5 17.25 5.5H2.75C2.33579 5.5 2 5.16421 2 4.75ZM9 15.25C9 14.8358 9.33579 14.5 9.75 14.5H17.25C17.6642 14.5 18 14.8358 18 15.25C18 15.6642 17.6642 16 17.25 16H9.75C9.33579 16 9 15.6642 9 15.25Z" fill="fill-current"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2 10C2 9.58579 2.33579 9.25 2.75 9.25H17.25C17.6642 9.25 18 9.58579 18 10C18 10.4142 17.6642 10.75 17.25 10.75H2.75C2.33579 10.75 2 10.4142 2 10Z" fill="fill-current"/>
							</svg>',
							],
							[
								'name' => 'Custom',
								'value' => 'custom',
								'icon' => '<svg class="w-4 stroke-current" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.0514 3.73889L15.4576 2.33265C16.0678 1.72245 17.0572 1.72245 17.6674 2.33265C18.2775 2.94284 18.2775 3.93216 17.6674 4.54235L8.81849 13.3912C8.37792 13.8318 7.83453 14.1556 7.23741 14.3335L5 15L5.66648 12.7626C5.84435 12.1655 6.1682 11.6221 6.60877 11.1815L14.0514 3.73889ZM14.0514 3.73889L16.25 5.93749M15 11.6667V15.625C15 16.6605 14.1605 17.5 13.125 17.5H4.375C3.33947 17.5 2.5 16.6605 2.5 15.625V6.87499C2.5 5.83946 3.33947 4.99999 4.375 4.99999H8.33333" stroke="stroke-current" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>',
							],
						),
						'default' => 'right',
					),
					'position_side' => array(
						'type' => 'string',
						'default' => 'right',
					),
					'position_side_value' => array(
						'type' => 'number',
						'default' => '10',
					),
					'position_bottom_value' => array(
						'type' => 'number',
						'default' => '10',
					),
					'enabled_attention_effect' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'attention_effect' => array(
						'type' => 'string',
						'options' => array(
							'wobble' => 'Wobble',
							'vibrate' => 'Vibrate',
							'flicker' => 'Flicker',
							'shake' => 'Shake',
							'jello' => 'Jello',
							'bounce' => 'Bounce',
							'heartbeat' => 'Heartbeat',
							'blink' => 'Blink',
						),
						'default' => 'wobble',
					),
					'enabled_cta' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'cta_text' => array(
						'type' => 'string',
						'default' => 'Enable Dark Mode',
					),
					'cta_color' => array(
						'type' => 'string',
						'default' => '#ffffff',
					),
					'cta_background' => array(
						'type' => 'string',
						'default' => '#000000',
					),
					'enabled_custom_icons' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'icon_light' => array(
						'type' => 'string',
						'default' => '',
					),
					'icon_dark' => array(
						'type' => 'string',
						'default' => '',
					),
					'enabled_custom_texts' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'text_light' => array(
						'type' => 'string',
						'default' => 'Light',
					),
					'text_dark' => array(
						'type' => 'string',
						'default' => 'Dark',
					),
				),
				'menu_switch' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => false,
					),
				),
				'content_switch' => array(
					'enabled_top_of_posts' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'enabled_top_of_pages' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'style' => array(
						'type' => 'number',
						'default' => 1,
					),
				),
				'color' => array(
					'mode' => array(
						'type' => 'string',
						'options' => array( 'automatic', 'presets', 'custom' ),
						'default' => 'automatic',
					),

					'presets' => [
						'type' => 'array',
						'default' => self::predefined_presets(),
					],

					'preset_id' => array(
						'type' => 'number',
						'default' => null,
					),
					'filter_brightness' => array(
						'type' => 'number',
						'default' => 100,
					),
					'filter_contrast' => array(
						'type' => 'number',
						'default' => 90,
					),
					'filter_grayscale' => array(
						'type' => 'number',
						'default' => 0,
					),
					'filter_sepia' => array(
						'type' => 'number',
						'default' => 10,
					),
				),
				'image' => array(
					'replaces' => array(
						'type' => 'array',
						'default' => array(),
					),
					'enabled_low_brightness' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'brightness' => array(
						'type' => 'number',
						'default' => 80,
					),
					'low_brightness_excludes' => array(
						'type' => 'array',
						'default' => [],
					),
					'enabled_low_grayscale' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'grayscale' => array(
						'type' => 'number',
						'default' => 0,
					),
					'low_grayscale_excludes' => array(
						'type' => 'array',
						'default' => [],
					),
				),
				'video' => array(
					'replaces' => array(
						'type' => 'array',
						'default' => array(),
					),
					'enabled_low_brightness' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'brightness' => array(
						'type' => 'number',
						'default' => 80,
					),
					'low_brightness_excludes' => array(
						'type' => 'array',
						'default' => [],
					),
					'enabled_low_grayscale' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'grayscale' => array(
						'type' => 'number',
						'default' => 0,
					),
					'low_grayscale_excludes' => array(
						'type' => 'array',
						'default' => [],
					),
				),
				'animation' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'name' => array(
						'type' => 'string',
						'options' => array(
							'fade-in' => 'Fade In',
							'pulse' => 'Pulse',
							'flip' => 'Flip',
							'roll' => 'Roll',
							'slide-left' => 'Slide Left',
							'slide-up' => 'Slide Up',
							'slide-right' => 'Slide Right',
							'slide-down' => 'Slide Down',
						),
						'default' => 'fade-in',
					),
				),
				'performance' => array(
					'track_dynamic_content' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'load_scripts_in_footer' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'execute_as' => array(
						'type' => 'string',
						'options' => array(
							'sync' => [
								'name' => 'Best Dark Mode Performance',
								'description' => 'The dark mode scripts will load before the parsing and rendering of your page. Choose this option when executing dark mode is the first priority for you.',
							],
							'async' => [
								'name' => 'Balanced Performance for My Website and Dark Mode',
								'description' => 'The dark mode scripts will be executed at the same time as your page. Choose this option to get a moderate dark mode loading time without compromising website loading speed.',
							],
							'defer' => [
								'name' => 'Prioritize My Website Loading',
								'description' => 'The dark mode script will be fetched asynchronously and executed after page parsing, just before the "DOMContentLoaded" event. Choose this option if your focus is on optimizing your website\'s performance over the WP Dark Mode.',
							],
						),
						'default' => 'sync',
					),
					'exclude_cache' => array(
						'type' => 'boolean',
						'default' => false,
					),
				),
				'excludes' => array(
					'elements' => array(
						'type' => 'string',
						'default' => '',
					),
					'elements_includes' => array(
						'type' => 'string',
						'default' => '',
					),

					'posts' => array(
						'type' => 'array',
						'default' => [],
					),
					'posts_all' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'posts_except' => array(
						'type' => 'array',
						'default' => [],
					),

					'taxonomies' => array(
						'type' => 'array',
						'default' => [],
					),
					'taxonomies_all' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'taxonomies_except' => array(
						'type' => 'array',
						'default' => [],
					),

					// WooCommerce.
					'wc_products' => array(
						'type' => 'array',
						'default' => [],
					),
					'wc_products_all' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'wc_products_except' => array(
						'type' => 'array',
						'default' => [],
					),
					'wc_categories' => array(
						'type' => 'array',
						'default' => [],
					),
					'wc_categories_all' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'wc_categories_except' => array(
						'type' => 'array',
						'default' => [],
					),
				),
				'accessibility' => array(
					'enabled_keyboard_shortcut' => array(
						'type' => 'boolean',
						'default' => true,
					),
					'enabled_url_param' => array(
						'type' => 'boolean',
						'default' => false,
					),
				),
				'typography' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'font_size' => array(
						'type' => 'mixed',
						'default' => '1.2',
					),
					'font_size_custom' => array(
						'type' => 'number',
						'default' => 100,
					),
				),
				'analytics' => array(
					'enabled' => array(
						'type' => 'boolean',
						'default' => true,
					),
					'enabled_dashboard_widget' => array(
						'type' => 'boolean',
						'default' => true,
					),
					'enabled_email_reporting' => array(
						'type' => 'boolean',
						'default' => false,
					),
					'email_reporting_frequency' => array(
						'type' => 'string',
						'options' => array(
							'daily' => 'Daily',
							'weekly' => 'Weekly',
							'biweekly' => 'Bi-Weekly',
							'monthly' => 'Monthly',
							'quarterly' => 'Quarterly',
							'yearly' => 'Yearly',
						),
						'default' => 'daily',
					),
					'email_reporting_address' => array(
						'type' => 'string',
						'default' => '',
					),
					'email_reporting_subject' => array(
						'type' => 'string',
						'default' => 'WP Dark Mode Analytics Report',
					),
				),
			];

			return apply_filters( 'wp_dark_mode_default_options', $options );
		}

		/**
		 * Default presets
		 *
		 * @since 5.0.0
		 * @return array
		 */
		public static function predefined_presets() {
			$presets = [
				[
					'name' => 'Gold',
					'bg' => '#000',
					'secondary_bg' => '#000',
					'text' => '#dfdedb',
					'link' => '#e58c17',
					'link_hover' => '#e58c17',
					'input_bg' => '#000',
					'input_text' => '#dfdedb',
					'input_placeholder' => '#dfdedb',
					'button_text' => '#dfdedb',
					'button_hover_text' => '#dfdedb',
					'button_bg' => '#141414',
					'button_hover_bg' => '#141414',
					'button_border' => '#1e1e1e',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#141414',
					'scrollbar_thumb' => '#dfdedb',
				],
				[
					'name' => 'Sapphire',
					'bg' => '#1B2836',
					'secondary_bg' => '#1B2836',
					'text' => '#fff',
					'link' => '#459BE6',
					'link_hover' => '#459BE6',
					'input_bg' => '#1B2836',
					'input_text' => '#fff',
					'input_placeholder' => '#fff',
					'button_text' => '#fff',
					'button_hover_text' => '#fff',
					'button_bg' => '#2f3c4a',
					'button_hover_bg' => '#2f3c4a',
					'button_border' => '#394654',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#1B2836',
					'scrollbar_thumb' => '#fff',
				],
				[
					'name' => 'Fuchsia',
					'bg' => '#1E0024',
					'secondary_bg' => '#1E0024',
					'text' => '#fff',
					'link' => '#E251FF',
					'link_hover' => '#E251FF',
					'input_bg' => '#1E0024',
					'input_text' => '#fff',
					'input_placeholder' => '#fff',
					'button_text' => '#fff',
					'button_hover_text' => '#fff',
					'button_bg' => '#321438',
					'button_hover_bg' => '#321438',
					'button_border' => '#321438',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#1E0024',
					'scrollbar_thumb' => '#fff',
				],
				[
					'name' => 'Rose',
					'bg' => '#270000',
					'secondary_bg' => '#270000',
					'text' => '#fff',
					'link' => '#FF7878',
					'link_hover' => '#FF7878',
					'input_bg' => '#270000',
					'input_text' => '#fff',
					'input_placeholder' => '#fff',
					'button_text' => '#fff',
					'button_hover_text' => '#fff',
					'button_bg' => '#3b1414',
					'button_hover_bg' => '#3b1414',
					'button_border' => '#451e1e',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#270000',
					'scrollbar_thumb' => '#fff',
				],
				[
					'name' => 'Violet',
					'bg' => '#160037',
					'secondary_bg' => '#160037',
					'text' => '#EBEBEB',
					'link' => '#B381FF',
					'link_hover' => '#B381FF',
					'input_bg' => '#160037',
					'input_text' => '#EBEBEB',
					'input_placeholder' => '#EBEBEB',
					'button_text' => '#EBEBEB',
					'button_hover_text' => '#EBEBEB',
					'button_bg' => '#2a144b',
					'button_hover_bg' => '#2a144b',
					'button_border' => '#341e55',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#160037',
					'scrollbar_thumb' => '#EBEBEB',
				],
				[
					'name' => 'Pink',
					'bg' => '#121212',
					'secondary_bg' => '#121212',
					'text' => '#E6E6E6',
					'link' => '#FF9191',
					'link_hover' => '#FF9191',
					'input_bg' => '#121212',
					'input_text' => '#E6E6E6',
					'input_placeholder' => '#E6E6E6',
					'button_text' => '#E6E6E6',
					'button_hover_text' => '#E6E6E6',
					'button_bg' => '#262626',
					'button_hover_bg' => '#262626',
					'button_border' => '#303030',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#121212',
					'scrollbar_thumb' => '#E6E6E6',
				],
				[
					'name' => 'Kelly',
					'bg' => '#000A3B',
					'secondary_bg' => '#000A3B',
					'text' => '#FFFFFF',
					'link' => '#3AFF82',
					'link_hover' => '#3AFF82',
					'input_bg' => '#000A3B',
					'input_text' => '#FFFFFF',
					'input_placeholder' => '#FFFFFF',
					'button_text' => '#FFFFFF',
					'button_hover_text' => '#FFFFFF',
					'button_bg' => '#141e4f',
					'button_hover_bg' => '#141e4f',
					'button_border' => '#1e2859',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#000A3B',
					'scrollbar_thumb' => '#FFFFFF',
				],
				[
					'name' => 'Magenta',
					'bg' => '#171717',
					'secondary_bg' => '#171717',
					'text' => '#BFB7C0',
					'link' => '#F776F0',
					'link_hover' => '#F776F0',
					'input_bg' => '#171717',
					'input_text' => '#BFB7C0',
					'input_placeholder' => '#BFB7C0',
					'button_text' => '#BFB7C0',
					'button_hover_text' => '#BFB7C0',
					'button_bg' => '#2b2b2b',
					'button_hover_bg' => '#2b2b2b',
					'button_border' => '#353535',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#171717',
					'scrollbar_thumb' => '#BFB7C0',
				],
				[
					'name' => 'Green',
					'bg' => '#003711',
					'secondary_bg' => '#003711',
					'text' => '#FFFFFF',
					'link' => '#84FF6D',
					'link_hover' => '#84FF6D',
					'input_bg' => '#003711',
					'input_text' => '#FFFFFF',
					'input_placeholder' => '#FFFFFF',
					'button_text' => '#FFFFFF',
					'button_hover_text' => '#FFFFFF',
					'button_bg' => '#144b25',
					'button_hover_bg' => '#144b25',
					'button_border' => '#1e552f',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#003711',
					'scrollbar_thumb' => '#FFFFFF',
				],
				[
					'name' => 'Orange',
					'bg' => '#23243A',
					'secondary_bg' => '#23243A',
					'text' => '#D6CB99',
					'link' => '#FF9323',
					'link_hover' => '#FF9323',
					'input_bg' => '#23243A',
					'input_text' => '#D6CB99',
					'input_placeholder' => '#D6CB99',
					'button_text' => '#D6CB99',
					'button_hover_text' => '#D6CB99',
					'button_bg' => '#37384e',
					'button_hover_bg' => '#37384e',
					'button_border' => '#414258',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#23243A',
					'scrollbar_thumb' => '#D6CB99',
				],

				[
					'name' => 'Yellow',
					'bg' => '#151819',
					'secondary_bg' => '#151819',
					'text' => '#D5D6D7',
					'link' => '#DAA40B',
					'link_hover' => '#DAA40B',
					'input_bg' => '#151819',
					'input_text' => '#D5D6D7',
					'input_placeholder' => '#D5D6D7',
					'button_text' => '#D5D6D7',
					'button_hover_text' => '#D5D6D7',
					'button_bg' => '#292c2d',
					'button_hover_bg' => '#292c2d',
					'button_border' => '#333637',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#151819',
					'scrollbar_thumb' => '#D5D6D7',
				],
				[
					'name' => 'Facebook',
					'bg' => '#18191A',
					'secondary_bg' => '#18191A',
					'text' => '#DCDEE3',
					'link' => '#2D88FF',
					'link_hover' => '#2D88FF',
					'input_bg' => '#18191A',
					'input_text' => '#DCDEE3',
					'input_placeholder' => '#DCDEE3',
					'button_text' => '#DCDEE3',
					'button_hover_text' => '#DCDEE3',
					'button_bg' => '#2c2d2e',
					'button_hover_bg' => '#2c2d2e',
					'button_border' => '#363738',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#18191A',
					'scrollbar_thumb' => '#DCDEE3',
				],

				[
					'name' => 'Twitter',
					'bg' => '#141d26',
					'secondary_bg' => '#141d26',
					'text' => '#fff',
					'link' => '#1C9CEA',
					'link_hover' => '#1C9CEA',
					'input_bg' => '#141d26',
					'input_text' => '#fff',
					'input_placeholder' => '#fff',
					'button_text' => '#fff',
					'button_hover_text' => '#fff',
					'button_bg' => '#28313a',
					'button_hover_bg' => '#28313a',
					'button_border' => '#323b44',
					'enable_scrollbar' => false,
					'scrollbar_track' => '#141d26',
					'scrollbar_thumb' => '#fff',
				],
			];

			return apply_filters( 'wp_dark_mode_default_presets', $presets );
		}


		/**
		 * Get SVG icons
		 *
		 * @since 5.0.0
		 * @return array
		 */
		public function get_svg_icons() {
			$svg_icons = [
				'HalfMoonFilled' => '<svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.8956 0.505198C11.2091 0.818744 11.3023 1.29057 11.1316 1.69979C10.4835 3.25296 10.125 4.95832 10.125 6.75018C10.125 13.9989 16.0013 19.8752 23.25 19.8752C25.0419 19.8752 26.7472 19.5167 28.3004 18.8686C28.7096 18.6979 29.1814 18.7911 29.495 19.1046C29.8085 19.4182 29.9017 19.89 29.731 20.2992C27.4235 25.8291 21.9642 29.7189 15.5938 29.7189C7.13689 29.7189 0.28125 22.8633 0.28125 14.4064C0.28125 8.036 4.17113 2.57666 9.70097 0.269199C10.1102 0.098441 10.582 0.191653 10.8956 0.505198Z" fill="currentColor"/></svg>',
				'HalfMoonOutlined' => '<svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path d="M23.3773 16.5026C22.0299 17.0648 20.5512 17.3753 19 17.3753C12.7178 17.3753 7.625 12.2826 7.625 6.00031C7.625 4.44912 7.9355 2.97044 8.49773 1.62305C4.38827 3.33782 1.5 7.39427 1.5 12.1253C1.5 18.4076 6.59276 23.5003 12.875 23.5003C17.606 23.5003 21.6625 20.612 23.3773 16.5026Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
				'CurvedMoonFilled' => '<svg  viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M6.11767 1.57622C8.52509 0.186296 11.2535 -0.171447 13.8127 0.36126C13.6914 0.423195 13.5692 0.488292 13.4495 0.557448C9.41421 2.88721 8.09657 8.15546 10.503 12.3234C12.9105 16.4934 18.1326 17.9833 22.1658 15.6547C22.2856 15.5855 22.4031 15.5123 22.5174 15.4382C21.6991 17.9209 20.0251 20.1049 17.6177 21.4948C12.2943 24.5683 5.40509 22.5988 2.23017 17.0997C-0.947881 11.5997 0.79427 4.64968 6.11767 1.57622ZM4.77836 10.2579C4.70178 10.3021 4.6784 10.4022 4.72292 10.4793C4.76861 10.5585 4.86776 10.5851 4.94238 10.542C5.01896 10.4978 5.04235 10.3977 4.99783 10.3206C4.95331 10.2435 4.85495 10.2137 4.77836 10.2579ZM14.0742 19.6608C14.1508 19.6166 14.1741 19.5165 14.1296 19.4394C14.0839 19.3603 13.9848 19.3336 13.9102 19.3767C13.8336 19.4209 13.8102 19.521 13.8547 19.5981C13.8984 19.6784 13.9976 19.705 14.0742 19.6608ZM6.11345 5.87243C6.19003 5.82822 6.21341 5.72814 6.16889 5.65103C6.1232 5.57189 6.02405 5.54526 5.94943 5.58835C5.87285 5.63256 5.84947 5.73264 5.89399 5.80975C5.93654 5.88799 6.03687 5.91665 6.11345 5.87243ZM9.42944 18.3138C9.50603 18.2696 9.52941 18.1695 9.48489 18.0924C9.4392 18.0133 9.34004 17.9867 9.26543 18.0297C9.18885 18.074 9.16546 18.174 9.20998 18.2511C9.25254 18.3294 9.35286 18.358 9.42944 18.3138ZM6.25969 15.1954L7.35096 16.3781L6.87234 14.8416L8.00718 13.7644L6.50878 14.2074L5.41751 13.0247L5.89613 14.5611L4.76326 15.6372L6.25969 15.1954Z" fill="white"/></svg>',
				'CurvedMoonOutlined' => '<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path d="M5.99222 9.70618C8.30834 12.0223 12.0339 12.0633 14.4679 9.87934C14.1411 11.0024 13.5331 12.0648 12.643 12.9549C9.85623 15.7417 5.38524 15.7699 2.65685 13.0415C-0.0715325 10.3132 -0.0432656 5.84217 2.74352 3.05539C3.63362 2.16529 4.69605 1.55721 5.81912 1.23044C3.63513 3.66445 3.67608 7.39004 5.99222 9.70618Z" stroke="currentColor"/> </svg>',
				'SunFilled' => '<svg viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.9999 3.73644C11.1951 3.73644 11.3548 3.57676 11.3548 3.3816V0.354838C11.3548 0.159677 11.1951 0 10.9999 0C10.8048 0 10.6451 0.159677 10.6451 0.354838V3.38515C10.6451 3.58031 10.8048 3.73644 10.9999 3.73644ZM10.9998 4.61291C7.47269 4.61291 4.6127 7.4729 4.6127 11C4.6127 14.5271 7.47269 17.3871 10.9998 17.3871C14.5269 17.3871 17.3868 14.5271 17.3868 11C17.3868 7.4729 14.5269 4.61291 10.9998 4.61291ZM10.9998 6.3871C8.45559 6.3871 6.38688 8.4558 6.38688 11C6.38688 11.1951 6.22721 11.3548 6.03205 11.3548C5.83688 11.3548 5.67721 11.1951 5.67721 11C5.67721 8.06548 8.06526 5.67742 10.9998 5.67742C11.1949 5.67742 11.3546 5.8371 11.3546 6.03226C11.3546 6.22742 11.1949 6.3871 10.9998 6.3871ZM10.6451 18.6184C10.6451 18.4232 10.8048 18.2635 10.9999 18.2635C11.1951 18.2635 11.3548 18.4197 11.3548 18.6148V21.6451C11.3548 21.8403 11.1951 22 10.9999 22C10.8048 22 10.6451 21.8403 10.6451 21.6451V18.6184ZM6.88367 4.58091C6.95109 4.69446 7.06819 4.75833 7.19238 4.75833C7.2527 4.75833 7.31302 4.74414 7.3698 4.7122C7.54012 4.61285 7.59689 4.3964 7.50109 4.22608L5.98593 1.60383C5.88658 1.43351 5.67013 1.37673 5.4998 1.47254C5.32948 1.57189 5.27271 1.78834 5.36851 1.95867L6.88367 4.58091ZM14.6298 17.2877C14.8001 17.1919 15.0166 17.2487 15.1159 17.419L16.6311 20.0413C16.7269 20.2116 16.6701 20.428 16.4998 20.5274C16.443 20.5593 16.3827 20.5735 16.3224 20.5735C16.1982 20.5735 16.0811 20.5096 16.0137 20.3961L14.4985 17.7738C14.4027 17.6035 14.4595 17.3871 14.6298 17.2877ZM1.60383 5.98611L4.22608 7.50127C4.28285 7.5332 4.34317 7.5474 4.4035 7.5474C4.52769 7.5474 4.64478 7.48353 4.7122 7.36998C4.81156 7.19966 4.75124 6.98321 4.58091 6.88385L1.95867 5.36869C1.78834 5.26934 1.57189 5.32966 1.47254 5.49998C1.37673 5.67031 1.43351 5.88676 1.60383 5.98611ZM17.774 14.4986L20.3963 16.0137C20.5666 16.1131 20.6234 16.3295 20.5276 16.4999C20.4601 16.6134 20.3431 16.6773 20.2189 16.6773C20.1585 16.6773 20.0982 16.6631 20.0414 16.6312L17.4192 15.116C17.2489 15.0166 17.1885 14.8002 17.2879 14.6299C17.3873 14.4596 17.6037 14.3992 17.774 14.4986ZM3.73644 10.9999C3.73644 10.8048 3.57676 10.6451 3.3816 10.6451H0.354837C0.159677 10.6451 0 10.8048 0 10.9999C0 11.1951 0.159677 11.3548 0.354837 11.3548H3.38515C3.58031 11.3548 3.73644 11.1951 3.73644 10.9999ZM18.6148 10.6451H21.6451C21.8403 10.6451 22 10.8048 22 10.9999C22 11.1951 21.8403 11.3548 21.6451 11.3548H18.6148C18.4197 11.3548 18.26 11.1951 18.26 10.9999C18.26 10.8048 18.4197 10.6451 18.6148 10.6451ZM4.7122 14.6299C4.61285 14.4596 4.3964 14.4028 4.22608 14.4986L1.60383 16.0138C1.43351 16.1131 1.37673 16.3296 1.47254 16.4999C1.53996 16.6135 1.65705 16.6773 1.78125 16.6773C1.84157 16.6773 1.90189 16.6631 1.95867 16.6312L4.58091 15.116C4.75124 15.0167 4.80801 14.8002 4.7122 14.6299ZM17.5963 7.54732C17.4721 7.54732 17.355 7.48345 17.2876 7.36991C17.1918 7.19958 17.2486 6.98313 17.4189 6.88378L20.0412 5.36862C20.2115 5.27282 20.4279 5.32959 20.5273 5.49991C20.6231 5.67023 20.5663 5.88669 20.396 5.98604L17.7737 7.5012C17.717 7.53313 17.6566 7.54732 17.5963 7.54732ZM7.37009 17.2877C7.19976 17.1883 6.98331 17.2487 6.88396 17.419L5.3688 20.0412C5.26945 20.2115 5.32977 20.428 5.50009 20.5274C5.55687 20.5593 5.61719 20.5735 5.67751 20.5735C5.8017 20.5735 5.9188 20.5096 5.98622 20.3961L7.50138 17.7738C7.59718 17.6035 7.54041 17.387 7.37009 17.2877ZM14.8072 4.7583C14.7469 4.7583 14.6866 4.7441 14.6298 4.71217C14.4595 4.61281 14.4027 4.39636 14.4985 4.22604L16.0137 1.60379C16.113 1.43347 16.3295 1.37315 16.4998 1.4725C16.6701 1.57186 16.7304 1.78831 16.6311 1.95863L15.1159 4.58088C15.0485 4.69443 14.9314 4.7583 14.8072 4.7583ZM8.68659 3.73643C8.72917 3.89611 8.87111 3.99901 9.02724 3.99901C9.05917 3.99901 9.08756 3.99546 9.11949 3.98837C9.30756 3.93869 9.4211 3.74353 9.37143 3.55546L8.86401 1.65708C8.81433 1.46902 8.61917 1.35547 8.43111 1.40515C8.24304 1.45483 8.1295 1.64999 8.17917 1.83805L8.68659 3.73643ZM12.8805 18.0152C13.0686 17.9655 13.2637 18.079 13.3134 18.2671L13.8208 20.1655C13.8705 20.3535 13.757 20.5487 13.5689 20.5984C13.537 20.6055 13.5086 20.609 13.4766 20.609C13.3205 20.609 13.1786 20.5061 13.136 20.3464L12.6286 18.4481C12.5789 18.26 12.6925 18.0648 12.8805 18.0152ZM5.36172 5.86548C5.43269 5.93645 5.5214 5.96838 5.61365 5.96838C5.70591 5.96838 5.79462 5.9329 5.86559 5.86548C6.00397 5.72709 6.00397 5.50355 5.86559 5.36516L4.47817 3.97775C4.33979 3.83936 4.11624 3.83936 3.97785 3.97775C3.83947 4.11613 3.83947 4.33968 3.97785 4.47807L5.36172 5.86548ZM16.138 16.1346C16.2764 15.9962 16.4999 15.9962 16.6383 16.1346L18.0293 17.522C18.1677 17.6604 18.1677 17.8839 18.0293 18.0223C17.9583 18.0897 17.8696 18.1252 17.7774 18.1252C17.6851 18.1252 17.5964 18.0933 17.5254 18.0223L16.138 16.6349C15.9996 16.4965 15.9996 16.273 16.138 16.1346ZM1.65365 8.86392L3.55203 9.37134C3.58396 9.37843 3.61235 9.38198 3.64429 9.38198C3.80041 9.38198 3.94235 9.27908 3.98493 9.1194C4.03461 8.93134 3.92461 8.73618 3.73299 8.6865L1.83461 8.17908C1.64655 8.1294 1.45139 8.2394 1.40171 8.43102C1.35203 8.61908 1.46558 8.81069 1.65365 8.86392ZM18.4517 12.6287L20.3466 13.1361C20.5346 13.1894 20.6482 13.381 20.5985 13.569C20.5595 13.7287 20.414 13.8316 20.2578 13.8316C20.2259 13.8316 20.1975 13.8281 20.1656 13.821L18.2708 13.3135C18.0791 13.2639 17.9691 13.0687 18.0188 12.8806C18.0685 12.689 18.2637 12.579 18.4517 12.6287ZM1.74579 13.835C1.77773 13.835 1.80612 13.8315 1.83805 13.8244L3.73643 13.317C3.9245 13.2673 4.03804 13.0721 3.98837 12.8841C3.93869 12.696 3.74353 12.5825 3.55546 12.6321L1.65708 13.1395C1.46902 13.1892 1.35547 13.3844 1.40515 13.5725C1.44418 13.7286 1.58967 13.835 1.74579 13.835ZM18.2671 8.68643L20.1619 8.17901C20.35 8.12579 20.5451 8.23934 20.5948 8.43095C20.6445 8.61901 20.5309 8.81417 20.3429 8.86385L18.4481 9.37127C18.4161 9.37837 18.3877 9.38191 18.3558 9.38191C18.1997 9.38191 18.0577 9.27901 18.0151 9.11933C17.9655 8.93127 18.079 8.73611 18.2671 8.68643ZM5.86559 16.1346C5.7272 15.9962 5.50365 15.9962 5.36527 16.1346L3.97785 17.522C3.83947 17.6604 3.83947 17.8839 3.97785 18.0223C4.04882 18.0933 4.13753 18.1252 4.22979 18.1252C4.32204 18.1252 4.41075 18.0897 4.48172 18.0223L5.86914 16.6349C6.00397 16.4965 6.00397 16.273 5.86559 16.1346ZM16.3865 5.96838C16.2942 5.96838 16.2055 5.93645 16.1346 5.86548C15.9962 5.72709 15.9962 5.50355 16.1381 5.36516L17.5255 3.97775C17.6639 3.83936 17.8875 3.83936 18.0258 3.97775C18.1642 4.11613 18.1642 4.33968 18.0258 4.47807L16.6384 5.86548C16.5675 5.9329 16.4788 5.96838 16.3865 5.96838ZM9.11929 18.0151C8.93123 17.9654 8.73607 18.0754 8.68639 18.267L8.17897 20.1654C8.1293 20.3534 8.2393 20.5486 8.43091 20.5983C8.46284 20.6054 8.49123 20.6089 8.52317 20.6089C8.67929 20.6089 8.82478 20.506 8.86381 20.3463L9.37123 18.448C9.42091 18.2599 9.31091 18.0647 9.11929 18.0151ZM12.973 3.99548C12.9411 3.99548 12.9127 3.99193 12.8808 3.98484C12.6891 3.93516 12.5791 3.74 12.6288 3.55194L13.1362 1.65355C13.1859 1.46194 13.3811 1.35194 13.5691 1.40162C13.7607 1.4513 13.8707 1.64646 13.8211 1.83452L13.3137 3.7329C13.2711 3.89258 13.1291 3.99548 12.973 3.99548Z" fill="currentColor"/></svg>',
				'SunOutlined' => '<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path  fill-rule="evenodd" clip-rule="evenodd" d="M7.39113 2.94568C7.21273 2.94568 7.06816 2.80111 7.06816 2.62271V0.322968C7.06816 0.144567 7.21273 0 7.39113 0C7.56953 0 7.7141 0.144567 7.7141 0.322968V2.62271C7.7141 2.80111 7.56953 2.94568 7.39113 2.94568ZM7.39105 11.5484C6.84467 11.5484 6.31449 11.4414 5.81517 11.2302C5.33308 11.0262 4.9002 10.7344 4.52843 10.3628C4.15665 9.99108 3.86485 9.5582 3.66103 9.07611C3.44981 8.57679 3.34277 8.04661 3.34277 7.50023C3.34277 6.95385 3.44981 6.42367 3.66103 5.92435C3.86496 5.44225 4.15676 5.00937 4.52843 4.6377C4.9001 4.26603 5.33298 3.97413 5.81507 3.7703C6.31439 3.55909 6.84457 3.45205 7.39095 3.45205C7.93733 3.45205 8.46751 3.55909 8.96683 3.7703C9.44893 3.97423 9.88181 4.26603 10.2535 4.6377C10.6251 5.00937 10.917 5.44225 11.1209 5.92435C11.3321 6.42367 11.4391 6.95385 11.4391 7.50023C11.4391 8.04661 11.3321 8.57679 11.1209 9.07611C10.9169 9.5582 10.6251 9.99108 10.2535 10.3628C9.88181 10.7344 9.44893 11.0263 8.96683 11.2302C8.46761 11.4414 7.93743 11.5484 7.39105 11.5484ZM7.39105 4.09778C5.51497 4.09778 3.98871 5.62404 3.98871 7.50013C3.98871 9.37621 5.51497 10.9025 7.39105 10.9025C9.26714 10.9025 10.7934 9.37621 10.7934 7.50013C10.7934 5.62404 9.26714 4.09778 7.39105 4.09778ZM5.41926 3.02731C5.46693 3.15845 5.59079 3.23985 5.72274 3.23985C5.75935 3.23985 5.79667 3.2336 5.83317 3.22037C6.0008 3.15937 6.08724 2.9741 6.02623 2.80646L5.23962 0.645342C5.17862 0.477706 4.99335 0.391273 4.82571 0.452278C4.65808 0.513283 4.57164 0.698554 4.63265 0.86619L5.41926 3.02731ZM4.25602 4.08639C4.16384 4.08639 4.07228 4.04713 4.00841 3.97105L2.53013 2.20928C2.41551 2.07261 2.43335 1.86888 2.56992 1.75426C2.70659 1.63963 2.91031 1.65747 3.02494 1.79404L4.50322 3.5558C4.61784 3.69248 4.6 3.8962 4.46343 4.01083C4.40294 4.06158 4.32922 4.08639 4.25602 4.08639ZM3.00535 5.34148C3.0562 5.3709 3.11177 5.38485 3.16652 5.38485C3.27808 5.38485 3.38665 5.32692 3.44643 5.22326C3.53563 5.06875 3.48273 4.87128 3.32821 4.78208L1.33657 3.63221C1.18206 3.543 0.98459 3.59591 0.895389 3.75042C0.806188 3.90493 0.859094 4.10241 1.01361 4.19161L3.00535 5.34148ZM2.58819 6.97619C2.56953 6.97619 2.55067 6.97455 2.5317 6.97126L0.266921 6.57191C0.0912879 6.54095 -0.0260062 6.37341 0.00495775 6.19778C0.0359217 6.02215 0.203455 5.90485 0.379088 5.93582L2.64387 6.33507C2.8195 6.36603 2.93679 6.53357 2.90583 6.7092C2.87825 6.86597 2.74199 6.97619 2.58819 6.97619ZM0.00495775 8.80286C0.0325382 8.95962 0.1688 9.06984 0.322595 9.06984C0.341153 9.06984 0.36012 9.0682 0.379088 9.06482L2.64387 8.66547C2.8195 8.6345 2.93679 8.46697 2.90583 8.29134C2.87486 8.1157 2.70733 7.99841 2.5317 8.02937L0.266921 8.42873C0.0912879 8.45969 -0.0260062 8.62722 0.00495775 8.80286ZM1.1754 11.4112C1.06374 11.4112 0.955266 11.3533 0.895389 11.2496C0.806188 11.0951 0.859094 10.8976 1.01361 10.8084L3.00524 9.65857C3.15965 9.56937 3.35723 9.62228 3.44643 9.77679C3.53563 9.9313 3.48273 10.1288 3.32821 10.218L1.33657 11.3678C1.28572 11.3972 1.23025 11.4112 1.1754 11.4112ZM2.56995 13.2452C2.63044 13.296 2.70406 13.3208 2.77737 13.3208C2.86954 13.3208 2.9611 13.2815 3.02498 13.2055L4.50325 11.4437C4.61788 11.307 4.60014 11.1033 4.46347 10.9887C4.3268 10.874 4.12307 10.8918 4.00844 11.0284L2.53017 12.7902C2.41554 12.9269 2.43328 13.1306 2.56995 13.2452ZM4.93614 14.5672C4.89943 14.5672 4.86221 14.5609 4.82571 14.5476C4.65808 14.4866 4.57164 14.3012 4.63265 14.1337L5.41926 11.9725C5.48026 11.8049 5.66564 11.7185 5.83317 11.7795C6.0008 11.8405 6.08724 12.0259 6.02623 12.1934L5.23962 14.3545C5.19195 14.4857 5.06809 14.5672 4.93614 14.5672ZM7.06836 14.6774C7.06836 14.8558 7.21293 15.0004 7.39133 15.0004C7.56973 15.0004 7.7143 14.8558 7.7143 14.6774V12.3777C7.7143 12.1993 7.56973 12.0547 7.39133 12.0547C7.21293 12.0547 7.06836 12.1993 7.06836 12.3777V14.6774ZM9.84569 14.5672C9.71374 14.5672 9.58988 14.4857 9.54221 14.3545L8.7556 12.1934C8.69459 12.0258 8.78103 11.8405 8.94866 11.7795C9.1163 11.7185 9.30157 11.8049 9.36257 11.9725L10.1492 14.1337C10.2102 14.3013 10.1238 14.4866 9.95612 14.5476C9.91962 14.5609 9.8823 14.5672 9.84569 14.5672ZM11.757 13.2056C11.8209 13.2816 11.9125 13.3209 12.0046 13.3209C12.0779 13.3209 12.1516 13.2961 12.2121 13.2454C12.3486 13.1307 12.3665 12.927 12.2518 12.7903L10.7736 11.0286C10.6589 10.892 10.4552 10.8741 10.3185 10.9888C10.182 11.1034 10.1641 11.3071 10.2788 11.4438L11.757 13.2056ZM13.6064 11.4112C13.5516 11.4112 13.496 11.3973 13.4452 11.3678L11.4535 10.218C11.299 10.1288 11.2461 9.9313 11.3353 9.77679C11.4245 9.62228 11.622 9.56937 11.7765 9.65857L13.7682 10.8084C13.9227 10.8976 13.9756 11.0951 13.8864 11.2496C13.8265 11.3533 13.718 11.4112 13.6064 11.4112ZM14.4029 9.06482C14.4219 9.0681 14.4407 9.06974 14.4594 9.06974C14.6132 9.06974 14.7494 8.95942 14.777 8.80286C14.808 8.62722 14.6907 8.45969 14.5151 8.42873L12.2502 8.02937C12.0745 7.99841 11.907 8.1157 11.8761 8.29134C11.8451 8.46697 11.9624 8.6345 12.138 8.66547L14.4029 9.06482ZM12.194 6.976C12.0402 6.976 11.9039 6.86578 11.8763 6.70901C11.8454 6.53337 11.9627 6.36584 12.1383 6.33488L14.4032 5.93552C14.5788 5.90456 14.7464 6.02185 14.7773 6.19749C14.8083 6.37312 14.691 6.54065 14.5154 6.57162L12.2505 6.97097C12.2315 6.97435 12.2126 6.976 12.194 6.976ZM11.3353 5.22326C11.3952 5.32692 11.5037 5.38485 11.6153 5.38485C11.6702 5.38485 11.7257 5.3709 11.7765 5.34148L13.7682 4.19161C13.9227 4.10241 13.9756 3.90493 13.8864 3.75042C13.7972 3.59591 13.5996 3.543 13.4452 3.63221L11.4535 4.78208C11.299 4.87128 11.2461 5.06875 11.3353 5.22326ZM10.5259 4.08647C10.4526 4.08647 10.379 4.06166 10.3185 4.01091C10.1818 3.89628 10.1641 3.69255 10.2787 3.55588L11.757 1.79411C11.8716 1.65744 12.0753 1.6396 12.212 1.75433C12.3487 1.86896 12.3664 2.07269 12.2518 2.20936L10.7735 3.97102C10.7096 4.0472 10.6181 4.08647 10.5259 4.08647ZM8.94866 3.22037C8.98516 3.2337 9.02238 3.23996 9.05909 3.23996C9.19094 3.23996 9.3148 3.15855 9.36257 3.02731L10.1492 0.86619C10.2102 0.698657 10.1237 0.513283 9.95612 0.452278C9.78858 0.391273 9.60321 0.477706 9.54221 0.645342L8.7556 2.80646C8.69459 2.97399 8.78103 3.15937 8.94866 3.22037Z"  fill="currentColor"/> </svg>',
				'DoubleUpperT' => '<svg viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M17.1429 6.42857V15H15V6.42857H10.7143V4.28571H21.4286V6.42857H17.1429ZM8.57143 2.14286V15H6.42857V2.14286H0V0H16.0714V2.14286H8.57143Z" fill="currentColor"/></svg>',
				'LowerA' => '',
				'DoubleT' => '<svg viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M0.880682 2.34375V0.454545H12.1378V2.34375H7.59943V15H5.41193V2.34375H0.880682ZM19.5472 4.09091V5.79545H13.5884V4.09091H19.5472ZM15.1864 1.47727H17.31V11.7969C17.31 12.2088 17.3716 12.5189 17.4947 12.7273C17.6178 12.9309 17.7764 13.0705 17.9705 13.1463C18.1694 13.2173 18.3848 13.2528 18.6168 13.2528C18.7873 13.2528 18.9364 13.241 19.0643 13.2173C19.1921 13.1937 19.2915 13.1747 19.3626 13.1605L19.7461 14.9148C19.623 14.9621 19.4478 15.0095 19.2205 15.0568C18.9933 15.1089 18.7092 15.1373 18.3683 15.142C17.8095 15.1515 17.2887 15.0521 16.8058 14.8438C16.3228 14.6354 15.9322 14.3134 15.6339 13.8778C15.3356 13.4422 15.1864 12.8954 15.1864 12.2372V1.47727Z" fill="currentColor"/></svg>',
				'UpperA' => '<svg viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M2.32955 14.5455H0L5.23438 0H7.76989L13.0043 14.5455H10.6747L6.5625 2.64205H6.44886L2.32955 14.5455ZM2.72017 8.84943H10.277V10.696H2.72017V8.84943Z" fill="currentColor"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.9474 8.33333L17.7085 5L15.5029 8.33333H17.1697V11.6667H15.5029L17.7085 15.0001L19.9474 11.6667H18.2808V8.33333H19.9474Z" fill="currentColor"/></svg>',
				'Stars' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 55" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M135.831 3.00688C135.055 3.85027 134.111 4.29946 133 4.35447C134.111 4.40947 135.055 4.85867 135.831 5.71123C136.607 6.55462 136.996 7.56303 136.996 8.72727C136.996 7.95722 137.172 7.25134 137.525 6.59129C137.886 5.93124 138.372 5.39954 138.98 5.00535C139.598 4.60199 140.268 4.39114 141 4.35447C139.88 4.2903 138.936 3.85027 138.16 3.00688C137.384 2.16348 136.996 1.16425 136.996 0C136.996 1.16425 136.607 2.16348 135.831 3.00688ZM31 23.3545C32.1114 23.2995 33.0551 22.8503 33.8313 22.0069C34.6075 21.1635 34.9956 20.1642 34.9956 19C34.9956 20.1642 35.3837 21.1635 36.1599 22.0069C36.9361 22.8503 37.8798 23.2903 39 23.3545C38.2679 23.3911 37.5976 23.602 36.9802 24.0053C36.3716 24.3995 35.8864 24.9312 35.5248 25.5913C35.172 26.2513 34.9956 26.9572 34.9956 27.7273C34.9956 26.563 34.6075 25.5546 33.8313 24.7112C33.0551 23.8587 32.1114 23.4095 31 23.3545ZM0 36.3545C1.11136 36.2995 2.05513 35.8503 2.83131 35.0069C3.6075 34.1635 3.99559 33.1642 3.99559 32C3.99559 33.1642 4.38368 34.1635 5.15987 35.0069C5.93605 35.8503 6.87982 36.2903 8 36.3545C7.26792 36.3911 6.59757 36.602 5.98015 37.0053C5.37155 37.3995 4.88644 37.9312 4.52481 38.5913C4.172 39.2513 3.99559 39.9572 3.99559 40.7273C3.99559 39.563 3.6075 38.5546 2.83131 37.7112C2.05513 36.8587 1.11136 36.4095 0 36.3545ZM56.8313 24.0069C56.0551 24.8503 55.1114 25.2995 54 25.3545C55.1114 25.4095 56.0551 25.8587 56.8313 26.7112C57.6075 27.5546 57.9956 28.563 57.9956 29.7273C57.9956 28.9572 58.172 28.2513 58.5248 27.5913C58.8864 26.9312 59.3716 26.3995 59.9802 26.0053C60.5976 25.602 61.2679 25.3911 62 25.3545C60.8798 25.2903 59.9361 24.8503 59.1599 24.0069C58.3837 23.1635 57.9956 22.1642 57.9956 21C57.9956 22.1642 57.6075 23.1635 56.8313 24.0069ZM81 25.3545C82.1114 25.2995 83.0551 24.8503 83.8313 24.0069C84.6075 23.1635 84.9956 22.1642 84.9956 21C84.9956 22.1642 85.3837 23.1635 86.1599 24.0069C86.9361 24.8503 87.8798 25.2903 89 25.3545C88.2679 25.3911 87.5976 25.602 86.9802 26.0053C86.3716 26.3995 85.8864 26.9312 85.5248 27.5913C85.172 28.2513 84.9956 28.9572 84.9956 29.7273C84.9956 28.563 84.6075 27.5546 83.8313 26.7112C83.0551 25.8587 82.1114 25.4095 81 25.3545ZM136 36.3545C137.111 36.2995 138.055 35.8503 138.831 35.0069C139.607 34.1635 139.996 33.1642 139.996 32C139.996 33.1642 140.384 34.1635 141.16 35.0069C141.936 35.8503 142.88 36.2903 144 36.3545C143.268 36.3911 142.598 36.602 141.98 37.0053C141.372 37.3995 140.886 37.9312 140.525 38.5913C140.172 39.2513 139.996 39.9572 139.996 40.7273C139.996 39.563 139.607 38.5546 138.831 37.7112C138.055 36.8587 137.111 36.4095 136 36.3545ZM101.831 49.0069C101.055 49.8503 100.111 50.2995 99 50.3545C100.111 50.4095 101.055 50.8587 101.831 51.7112C102.607 52.5546 102.996 53.563 102.996 54.7273C102.996 53.9572 103.172 53.2513 103.525 52.5913C103.886 51.9312 104.372 51.3995 104.98 51.0053C105.598 50.602 106.268 50.3911 107 50.3545C105.88 50.2903 104.936 49.8503 104.16 49.0069C103.384 48.1635 102.996 47.1642 102.996 46C102.996 47.1642 102.607 48.1635 101.831 49.0069Z" fill="currentColor"></path></svg>',
				'StarMoonFilled' => '<svg  viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M6.11767 1.57622C8.52509 0.186296 11.2535 -0.171447 13.8127 0.36126C13.6914 0.423195 13.5692 0.488292 13.4495 0.557448C9.41421 2.88721 8.09657 8.15546 10.503 12.3234C12.9105 16.4934 18.1326 17.9833 22.1658 15.6547C22.2856 15.5855 22.4031 15.5123 22.5174 15.4382C21.6991 17.9209 20.0251 20.1049 17.6177 21.4948C12.2943 24.5683 5.40509 22.5988 2.23017 17.0997C-0.947881 11.5997 0.79427 4.64968 6.11767 1.57622ZM4.77836 10.2579C4.70178 10.3021 4.6784 10.4022 4.72292 10.4793C4.76861 10.5585 4.86776 10.5851 4.94238 10.542C5.01896 10.4978 5.04235 10.3977 4.99783 10.3206C4.95331 10.2435 4.85495 10.2137 4.77836 10.2579ZM14.0742 19.6608C14.1508 19.6166 14.1741 19.5165 14.1296 19.4394C14.0839 19.3603 13.9848 19.3336 13.9102 19.3767C13.8336 19.4209 13.8102 19.521 13.8547 19.5981C13.8984 19.6784 13.9976 19.705 14.0742 19.6608ZM6.11345 5.87243C6.19003 5.82822 6.21341 5.72814 6.16889 5.65103C6.1232 5.57189 6.02405 5.54526 5.94943 5.58835C5.87285 5.63256 5.84947 5.73264 5.89399 5.80975C5.93654 5.88799 6.03687 5.91665 6.11345 5.87243ZM9.42944 18.3138C9.50603 18.2696 9.52941 18.1695 9.48489 18.0924C9.4392 18.0133 9.34004 17.9867 9.26543 18.0297C9.18885 18.074 9.16546 18.174 9.20998 18.2511C9.25254 18.3294 9.35286 18.358 9.42944 18.3138ZM6.25969 15.1954L7.35096 16.3781L6.87234 14.8416L8.00718 13.7644L6.50878 14.2074L5.41751 13.0247L5.89613 14.5611L4.76326 15.6372L6.25969 15.1954Z" fill="white"/></svg>',
				'StarMoonOutlined' => '<svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M22.6583 15.6271C21.4552 16.1291 20.135 16.4063 18.75 16.4063C13.1409 16.4063 8.59375 11.8592 8.59375 6.25007C8.59375 4.86507 8.87098 3.54483 9.37297 2.3418C5.70381 3.87285 3.125 7.49468 3.125 11.7188C3.125 17.328 7.67211 21.8751 13.2812 21.8751C17.5054 21.8751 21.1272 19.2963 22.6583 15.6271Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="3" r="1" fill="currentColor"/><circle cx="24" cy="5" r="1" fill="currentColor"/><circle cx="20" cy="11" r="1" fill="currentColor"/></svg>',
				'FullMoonFilled' => '<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M8 14.4C8.0896 14.4 8.0896 10.1336 8 1.6C6.30261 1.6 4.67475 2.27428 3.47452 3.47452C2.27428 4.67475 1.6 6.30261 1.6 8C1.6 9.69739 2.27428 11.3253 3.47452 12.5255C4.67475 13.7257 6.30261 14.4 8 14.4ZM8 16C3.5816 16 0 12.4184 0 8C0 3.5816 3.5816 0 8 0C12.4184 0 16 3.5816 16 8C16 12.4184 12.4184 16 8 16Z" fill="currentColor"/></svg>',
				'RichSunOutlined' => '<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path  fill-rule="evenodd" clip-rule="evenodd" d="M7.39113 2.94568C7.21273 2.94568 7.06816 2.80111 7.06816 2.62271V0.322968C7.06816 0.144567 7.21273 0 7.39113 0C7.56953 0 7.7141 0.144567 7.7141 0.322968V2.62271C7.7141 2.80111 7.56953 2.94568 7.39113 2.94568ZM7.39105 11.5484C6.84467 11.5484 6.31449 11.4414 5.81517 11.2302C5.33308 11.0262 4.9002 10.7344 4.52843 10.3628C4.15665 9.99108 3.86485 9.5582 3.66103 9.07611C3.44981 8.57679 3.34277 8.04661 3.34277 7.50023C3.34277 6.95385 3.44981 6.42367 3.66103 5.92435C3.86496 5.44225 4.15676 5.00937 4.52843 4.6377C4.9001 4.26603 5.33298 3.97413 5.81507 3.7703C6.31439 3.55909 6.84457 3.45205 7.39095 3.45205C7.93733 3.45205 8.46751 3.55909 8.96683 3.7703C9.44893 3.97423 9.88181 4.26603 10.2535 4.6377C10.6251 5.00937 10.917 5.44225 11.1209 5.92435C11.3321 6.42367 11.4391 6.95385 11.4391 7.50023C11.4391 8.04661 11.3321 8.57679 11.1209 9.07611C10.9169 9.5582 10.6251 9.99108 10.2535 10.3628C9.88181 10.7344 9.44893 11.0263 8.96683 11.2302C8.46761 11.4414 7.93743 11.5484 7.39105 11.5484ZM7.39105 4.09778C5.51497 4.09778 3.98871 5.62404 3.98871 7.50013C3.98871 9.37621 5.51497 10.9025 7.39105 10.9025C9.26714 10.9025 10.7934 9.37621 10.7934 7.50013C10.7934 5.62404 9.26714 4.09778 7.39105 4.09778ZM5.41926 3.02731C5.46693 3.15845 5.59079 3.23985 5.72274 3.23985C5.75935 3.23985 5.79667 3.2336 5.83317 3.22037C6.0008 3.15937 6.08724 2.9741 6.02623 2.80646L5.23962 0.645342C5.17862 0.477706 4.99335 0.391273 4.82571 0.452278C4.65808 0.513283 4.57164 0.698554 4.63265 0.86619L5.41926 3.02731ZM4.25602 4.08639C4.16384 4.08639 4.07228 4.04713 4.00841 3.97105L2.53013 2.20928C2.41551 2.07261 2.43335 1.86888 2.56992 1.75426C2.70659 1.63963 2.91031 1.65747 3.02494 1.79404L4.50322 3.5558C4.61784 3.69248 4.6 3.8962 4.46343 4.01083C4.40294 4.06158 4.32922 4.08639 4.25602 4.08639ZM3.00535 5.34148C3.0562 5.3709 3.11177 5.38485 3.16652 5.38485C3.27808 5.38485 3.38665 5.32692 3.44643 5.22326C3.53563 5.06875 3.48273 4.87128 3.32821 4.78208L1.33657 3.63221C1.18206 3.543 0.98459 3.59591 0.895389 3.75042C0.806188 3.90493 0.859094 4.10241 1.01361 4.19161L3.00535 5.34148ZM2.58819 6.97619C2.56953 6.97619 2.55067 6.97455 2.5317 6.97126L0.266921 6.57191C0.0912879 6.54095 -0.0260062 6.37341 0.00495775 6.19778C0.0359217 6.02215 0.203455 5.90485 0.379088 5.93582L2.64387 6.33507C2.8195 6.36603 2.93679 6.53357 2.90583 6.7092C2.87825 6.86597 2.74199 6.97619 2.58819 6.97619ZM0.00495775 8.80286C0.0325382 8.95962 0.1688 9.06984 0.322595 9.06984C0.341153 9.06984 0.36012 9.0682 0.379088 9.06482L2.64387 8.66547C2.8195 8.6345 2.93679 8.46697 2.90583 8.29134C2.87486 8.1157 2.70733 7.99841 2.5317 8.02937L0.266921 8.42873C0.0912879 8.45969 -0.0260062 8.62722 0.00495775 8.80286ZM1.1754 11.4112C1.06374 11.4112 0.955266 11.3533 0.895389 11.2496C0.806188 11.0951 0.859094 10.8976 1.01361 10.8084L3.00524 9.65857C3.15965 9.56937 3.35723 9.62228 3.44643 9.77679C3.53563 9.9313 3.48273 10.1288 3.32821 10.218L1.33657 11.3678C1.28572 11.3972 1.23025 11.4112 1.1754 11.4112ZM2.56995 13.2452C2.63044 13.296 2.70406 13.3208 2.77737 13.3208C2.86954 13.3208 2.9611 13.2815 3.02498 13.2055L4.50325 11.4437C4.61788 11.307 4.60014 11.1033 4.46347 10.9887C4.3268 10.874 4.12307 10.8918 4.00844 11.0284L2.53017 12.7902C2.41554 12.9269 2.43328 13.1306 2.56995 13.2452ZM4.93614 14.5672C4.89943 14.5672 4.86221 14.5609 4.82571 14.5476C4.65808 14.4866 4.57164 14.3012 4.63265 14.1337L5.41926 11.9725C5.48026 11.8049 5.66564 11.7185 5.83317 11.7795C6.0008 11.8405 6.08724 12.0259 6.02623 12.1934L5.23962 14.3545C5.19195 14.4857 5.06809 14.5672 4.93614 14.5672ZM7.06836 14.6774C7.06836 14.8558 7.21293 15.0004 7.39133 15.0004C7.56973 15.0004 7.7143 14.8558 7.7143 14.6774V12.3777C7.7143 12.1993 7.56973 12.0547 7.39133 12.0547C7.21293 12.0547 7.06836 12.1993 7.06836 12.3777V14.6774ZM9.84569 14.5672C9.71374 14.5672 9.58988 14.4857 9.54221 14.3545L8.7556 12.1934C8.69459 12.0258 8.78103 11.8405 8.94866 11.7795C9.1163 11.7185 9.30157 11.8049 9.36257 11.9725L10.1492 14.1337C10.2102 14.3013 10.1238 14.4866 9.95612 14.5476C9.91962 14.5609 9.8823 14.5672 9.84569 14.5672ZM11.757 13.2056C11.8209 13.2816 11.9125 13.3209 12.0046 13.3209C12.0779 13.3209 12.1516 13.2961 12.2121 13.2454C12.3486 13.1307 12.3665 12.927 12.2518 12.7903L10.7736 11.0286C10.6589 10.892 10.4552 10.8741 10.3185 10.9888C10.182 11.1034 10.1641 11.3071 10.2788 11.4438L11.757 13.2056ZM13.6064 11.4112C13.5516 11.4112 13.496 11.3973 13.4452 11.3678L11.4535 10.218C11.299 10.1288 11.2461 9.9313 11.3353 9.77679C11.4245 9.62228 11.622 9.56937 11.7765 9.65857L13.7682 10.8084C13.9227 10.8976 13.9756 11.0951 13.8864 11.2496C13.8265 11.3533 13.718 11.4112 13.6064 11.4112ZM14.4029 9.06482C14.4219 9.0681 14.4407 9.06974 14.4594 9.06974C14.6132 9.06974 14.7494 8.95942 14.777 8.80286C14.808 8.62722 14.6907 8.45969 14.5151 8.42873L12.2502 8.02937C12.0745 7.99841 11.907 8.1157 11.8761 8.29134C11.8451 8.46697 11.9624 8.6345 12.138 8.66547L14.4029 9.06482ZM12.194 6.976C12.0402 6.976 11.9039 6.86578 11.8763 6.70901C11.8454 6.53337 11.9627 6.36584 12.1383 6.33488L14.4032 5.93552C14.5788 5.90456 14.7464 6.02185 14.7773 6.19749C14.8083 6.37312 14.691 6.54065 14.5154 6.57162L12.2505 6.97097C12.2315 6.97435 12.2126 6.976 12.194 6.976ZM11.3353 5.22326C11.3952 5.32692 11.5037 5.38485 11.6153 5.38485C11.6702 5.38485 11.7257 5.3709 11.7765 5.34148L13.7682 4.19161C13.9227 4.10241 13.9756 3.90493 13.8864 3.75042C13.7972 3.59591 13.5996 3.543 13.4452 3.63221L11.4535 4.78208C11.299 4.87128 11.2461 5.06875 11.3353 5.22326ZM10.5259 4.08647C10.4526 4.08647 10.379 4.06166 10.3185 4.01091C10.1818 3.89628 10.1641 3.69255 10.2787 3.55588L11.757 1.79411C11.8716 1.65744 12.0753 1.6396 12.212 1.75433C12.3487 1.86896 12.3664 2.07269 12.2518 2.20936L10.7735 3.97102C10.7096 4.0472 10.6181 4.08647 10.5259 4.08647ZM8.94866 3.22037C8.98516 3.2337 9.02238 3.23996 9.05909 3.23996C9.19094 3.23996 9.3148 3.15855 9.36257 3.02731L10.1492 0.86619C10.2102 0.698657 10.1237 0.513283 9.95612 0.452278C9.78858 0.391273 9.60321 0.477706 9.54221 0.645342L8.7556 2.80646C8.69459 2.97399 8.78103 3.15937 8.94866 3.22037Z"  fill="currentColor"/> </svg>',
				'RichSunFilled' => '<svg viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.9999 3.73644C11.1951 3.73644 11.3548 3.57676 11.3548 3.3816V0.354838C11.3548 0.159677 11.1951 0 10.9999 0C10.8048 0 10.6451 0.159677 10.6451 0.354838V3.38515C10.6451 3.58031 10.8048 3.73644 10.9999 3.73644ZM10.9998 4.61291C7.47269 4.61291 4.6127 7.4729 4.6127 11C4.6127 14.5271 7.47269 17.3871 10.9998 17.3871C14.5269 17.3871 17.3868 14.5271 17.3868 11C17.3868 7.4729 14.5269 4.61291 10.9998 4.61291ZM10.9998 6.3871C8.45559 6.3871 6.38688 8.4558 6.38688 11C6.38688 11.1951 6.22721 11.3548 6.03205 11.3548C5.83688 11.3548 5.67721 11.1951 5.67721 11C5.67721 8.06548 8.06526 5.67742 10.9998 5.67742C11.1949 5.67742 11.3546 5.8371 11.3546 6.03226C11.3546 6.22742 11.1949 6.3871 10.9998 6.3871ZM10.6451 18.6184C10.6451 18.4232 10.8048 18.2635 10.9999 18.2635C11.1951 18.2635 11.3548 18.4197 11.3548 18.6148V21.6451C11.3548 21.8403 11.1951 22 10.9999 22C10.8048 22 10.6451 21.8403 10.6451 21.6451V18.6184ZM6.88367 4.58091C6.95109 4.69446 7.06819 4.75833 7.19238 4.75833C7.2527 4.75833 7.31302 4.74414 7.3698 4.7122C7.54012 4.61285 7.59689 4.3964 7.50109 4.22608L5.98593 1.60383C5.88658 1.43351 5.67013 1.37673 5.4998 1.47254C5.32948 1.57189 5.27271 1.78834 5.36851 1.95867L6.88367 4.58091ZM14.6298 17.2877C14.8001 17.1919 15.0166 17.2487 15.1159 17.419L16.6311 20.0413C16.7269 20.2116 16.6701 20.428 16.4998 20.5274C16.443 20.5593 16.3827 20.5735 16.3224 20.5735C16.1982 20.5735 16.0811 20.5096 16.0137 20.3961L14.4985 17.7738C14.4027 17.6035 14.4595 17.3871 14.6298 17.2877ZM1.60383 5.98611L4.22608 7.50127C4.28285 7.5332 4.34317 7.5474 4.4035 7.5474C4.52769 7.5474 4.64478 7.48353 4.7122 7.36998C4.81156 7.19966 4.75124 6.98321 4.58091 6.88385L1.95867 5.36869C1.78834 5.26934 1.57189 5.32966 1.47254 5.49998C1.37673 5.67031 1.43351 5.88676 1.60383 5.98611ZM17.774 14.4986L20.3963 16.0137C20.5666 16.1131 20.6234 16.3295 20.5276 16.4999C20.4601 16.6134 20.3431 16.6773 20.2189 16.6773C20.1585 16.6773 20.0982 16.6631 20.0414 16.6312L17.4192 15.116C17.2489 15.0166 17.1885 14.8002 17.2879 14.6299C17.3873 14.4596 17.6037 14.3992 17.774 14.4986ZM3.73644 10.9999C3.73644 10.8048 3.57676 10.6451 3.3816 10.6451H0.354837C0.159677 10.6451 0 10.8048 0 10.9999C0 11.1951 0.159677 11.3548 0.354837 11.3548H3.38515C3.58031 11.3548 3.73644 11.1951 3.73644 10.9999ZM18.6148 10.6451H21.6451C21.8403 10.6451 22 10.8048 22 10.9999C22 11.1951 21.8403 11.3548 21.6451 11.3548H18.6148C18.4197 11.3548 18.26 11.1951 18.26 10.9999C18.26 10.8048 18.4197 10.6451 18.6148 10.6451ZM4.7122 14.6299C4.61285 14.4596 4.3964 14.4028 4.22608 14.4986L1.60383 16.0138C1.43351 16.1131 1.37673 16.3296 1.47254 16.4999C1.53996 16.6135 1.65705 16.6773 1.78125 16.6773C1.84157 16.6773 1.90189 16.6631 1.95867 16.6312L4.58091 15.116C4.75124 15.0167 4.80801 14.8002 4.7122 14.6299ZM17.5963 7.54732C17.4721 7.54732 17.355 7.48345 17.2876 7.36991C17.1918 7.19958 17.2486 6.98313 17.4189 6.88378L20.0412 5.36862C20.2115 5.27282 20.4279 5.32959 20.5273 5.49991C20.6231 5.67023 20.5663 5.88669 20.396 5.98604L17.7737 7.5012C17.717 7.53313 17.6566 7.54732 17.5963 7.54732ZM7.37009 17.2877C7.19976 17.1883 6.98331 17.2487 6.88396 17.419L5.3688 20.0412C5.26945 20.2115 5.32977 20.428 5.50009 20.5274C5.55687 20.5593 5.61719 20.5735 5.67751 20.5735C5.8017 20.5735 5.9188 20.5096 5.98622 20.3961L7.50138 17.7738C7.59718 17.6035 7.54041 17.387 7.37009 17.2877ZM14.8072 4.7583C14.7469 4.7583 14.6866 4.7441 14.6298 4.71217C14.4595 4.61281 14.4027 4.39636 14.4985 4.22604L16.0137 1.60379C16.113 1.43347 16.3295 1.37315 16.4998 1.4725C16.6701 1.57186 16.7304 1.78831 16.6311 1.95863L15.1159 4.58088C15.0485 4.69443 14.9314 4.7583 14.8072 4.7583ZM8.68659 3.73643C8.72917 3.89611 8.87111 3.99901 9.02724 3.99901C9.05917 3.99901 9.08756 3.99546 9.11949 3.98837C9.30756 3.93869 9.4211 3.74353 9.37143 3.55546L8.86401 1.65708C8.81433 1.46902 8.61917 1.35547 8.43111 1.40515C8.24304 1.45483 8.1295 1.64999 8.17917 1.83805L8.68659 3.73643ZM12.8805 18.0152C13.0686 17.9655 13.2637 18.079 13.3134 18.2671L13.8208 20.1655C13.8705 20.3535 13.757 20.5487 13.5689 20.5984C13.537 20.6055 13.5086 20.609 13.4766 20.609C13.3205 20.609 13.1786 20.5061 13.136 20.3464L12.6286 18.4481C12.5789 18.26 12.6925 18.0648 12.8805 18.0152ZM5.36172 5.86548C5.43269 5.93645 5.5214 5.96838 5.61365 5.96838C5.70591 5.96838 5.79462 5.9329 5.86559 5.86548C6.00397 5.72709 6.00397 5.50355 5.86559 5.36516L4.47817 3.97775C4.33979 3.83936 4.11624 3.83936 3.97785 3.97775C3.83947 4.11613 3.83947 4.33968 3.97785 4.47807L5.36172 5.86548ZM16.138 16.1346C16.2764 15.9962 16.4999 15.9962 16.6383 16.1346L18.0293 17.522C18.1677 17.6604 18.1677 17.8839 18.0293 18.0223C17.9583 18.0897 17.8696 18.1252 17.7774 18.1252C17.6851 18.1252 17.5964 18.0933 17.5254 18.0223L16.138 16.6349C15.9996 16.4965 15.9996 16.273 16.138 16.1346ZM1.65365 8.86392L3.55203 9.37134C3.58396 9.37843 3.61235 9.38198 3.64429 9.38198C3.80041 9.38198 3.94235 9.27908 3.98493 9.1194C4.03461 8.93134 3.92461 8.73618 3.73299 8.6865L1.83461 8.17908C1.64655 8.1294 1.45139 8.2394 1.40171 8.43102C1.35203 8.61908 1.46558 8.81069 1.65365 8.86392ZM18.4517 12.6287L20.3466 13.1361C20.5346 13.1894 20.6482 13.381 20.5985 13.569C20.5595 13.7287 20.414 13.8316 20.2578 13.8316C20.2259 13.8316 20.1975 13.8281 20.1656 13.821L18.2708 13.3135C18.0791 13.2639 17.9691 13.0687 18.0188 12.8806C18.0685 12.689 18.2637 12.579 18.4517 12.6287ZM1.74579 13.835C1.77773 13.835 1.80612 13.8315 1.83805 13.8244L3.73643 13.317C3.9245 13.2673 4.03804 13.0721 3.98837 12.8841C3.93869 12.696 3.74353 12.5825 3.55546 12.6321L1.65708 13.1395C1.46902 13.1892 1.35547 13.3844 1.40515 13.5725C1.44418 13.7286 1.58967 13.835 1.74579 13.835ZM18.2671 8.68643L20.1619 8.17901C20.35 8.12579 20.5451 8.23934 20.5948 8.43095C20.6445 8.61901 20.5309 8.81417 20.3429 8.86385L18.4481 9.37127C18.4161 9.37837 18.3877 9.38191 18.3558 9.38191C18.1997 9.38191 18.0577 9.27901 18.0151 9.11933C17.9655 8.93127 18.079 8.73611 18.2671 8.68643ZM5.86559 16.1346C5.7272 15.9962 5.50365 15.9962 5.36527 16.1346L3.97785 17.522C3.83947 17.6604 3.83947 17.8839 3.97785 18.0223C4.04882 18.0933 4.13753 18.1252 4.22979 18.1252C4.32204 18.1252 4.41075 18.0897 4.48172 18.0223L5.86914 16.6349C6.00397 16.4965 6.00397 16.273 5.86559 16.1346ZM16.3865 5.96838C16.2942 5.96838 16.2055 5.93645 16.1346 5.86548C15.9962 5.72709 15.9962 5.50355 16.1381 5.36516L17.5255 3.97775C17.6639 3.83936 17.8875 3.83936 18.0258 3.97775C18.1642 4.11613 18.1642 4.33968 18.0258 4.47807L16.6384 5.86548C16.5675 5.9329 16.4788 5.96838 16.3865 5.96838ZM9.11929 18.0151C8.93123 17.9654 8.73607 18.0754 8.68639 18.267L8.17897 20.1654C8.1293 20.3534 8.2393 20.5486 8.43091 20.5983C8.46284 20.6054 8.49123 20.6089 8.52317 20.6089C8.67929 20.6089 8.82478 20.506 8.86381 20.3463L9.37123 18.448C9.42091 18.2599 9.31091 18.0647 9.11929 18.0151ZM12.973 3.99548C12.9411 3.99548 12.9127 3.99193 12.8808 3.98484C12.6891 3.93516 12.5791 3.74 12.6288 3.55194L13.1362 1.65355C13.1859 1.46194 13.3811 1.35194 13.5691 1.40162C13.7607 1.4513 13.8707 1.64646 13.8211 1.83452L13.3137 3.7329C13.2711 3.89258 13.1291 3.99548 12.973 3.99548Z" fill="currentColor"/></svg>',
				'RichMoonFilled' => '<svg viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 11C0 17.0655 4.93454 22 11 22C17.0655 22 21.9999 17.0654 21.9999 11C21.9999 4.93454 17.0654 0 11 0C4.93454 0 0 4.93461 0 11ZM4.57387 2.50047C2.30624 4.21915 0.744669 6.82303 0.408418 9.79286C0.462355 9.83055 0.51419 9.88498 0.54925 9.93864C0.618474 10.0443 0.672687 10.3381 0.672687 10.6078V11.506C0.672687 11.7309 0.729163 11.9933 0.796056 12.0789C0.869323 12.1724 0.974804 12.3422 1.03121 12.4576C1.08659 12.5704 1.16733 12.7331 1.21092 12.8191C1.25506 12.9061 1.32407 13.0723 1.36479 13.1895C1.40337 13.3008 1.46999 13.442 1.51016 13.4978C1.54998 13.5531 1.63236 13.6326 1.68993 13.6714C1.74819 13.7106 1.82906 13.755 1.86642 13.7681C1.90425 13.7815 1.97251 13.7995 2.01542 13.8075C2.05928 13.8155 2.16346 13.8278 2.24769 13.8348C2.3335 13.8419 2.44289 13.8556 2.49148 13.8653C2.54351 13.8757 2.63603 13.9215 2.70196 13.9698C2.76632 14.0167 2.84823 14.1028 2.88441 14.1615C2.91286 14.2075 2.98928 14.2541 3.04781 14.2611C3.10895 14.2683 3.16761 14.2415 3.1805 14.217C3.20346 14.1736 3.25089 14.0903 3.28639 14.0312C3.31216 13.9881 3.3417 13.9791 3.36192 13.9791C3.38111 13.9791 3.4284 13.9886 3.45239 14.0761C3.47254 14.1498 3.54478 14.275 3.61003 14.3496C3.68014 14.4295 3.77507 14.5512 3.82188 14.6208C3.86924 14.691 3.92948 14.8088 3.95635 14.8831C3.98239 14.9553 4.01632 15.0532 4.03167 15.1005C4.04751 15.1491 4.06731 15.2312 4.07574 15.2834C4.08493 15.3391 4.08274 15.417 4.07074 15.4607C4.06019 15.4991 4.04703 15.5547 4.04134 15.5845C4.03407 15.6224 4.00858 15.6699 3.98199 15.695C3.958 15.7177 3.90186 15.7516 3.85423 15.7723C3.8103 15.7912 3.74895 15.8165 3.71804 15.8285C3.6835 15.8418 3.63114 15.8522 3.59865 15.8522C3.5676 15.8522 3.52202 15.847 3.49495 15.8405C3.47994 15.8368 3.45479 15.8431 3.44704 15.8492C3.43896 15.8558 3.41675 15.8952 3.40489 15.9438C3.39358 15.9904 3.37103 16.1423 3.35575 16.2754C3.34115 16.4021 3.37892 16.5697 3.4382 16.6415C3.50366 16.7208 3.64348 16.8963 3.74978 17.0325C3.84971 17.1606 4.01091 17.2834 4.10172 17.3007C4.12146 17.3044 4.14456 17.3064 4.17026 17.3064C4.26073 17.3063 4.36669 17.2829 4.43399 17.2482C4.51836 17.2045 4.58964 17.1007 4.58964 17.0216V16.6382C4.58964 16.516 4.62364 16.3077 4.66538 16.1739C4.70684 16.0409 4.77086 15.8777 4.80801 15.81C4.83981 15.7518 4.92185 15.7157 5.02219 15.7157C5.05735 15.7157 5.09244 15.7201 5.1265 15.7289C5.24343 15.7593 5.43081 15.7935 5.54404 15.8052C5.67597 15.8187 5.78324 15.9694 5.78324 16.1412C5.78324 16.2932 5.80572 16.4965 5.83334 16.5945C5.86308 16.6998 5.86322 16.8798 5.83354 16.9957C5.80489 17.1079 5.72861 17.3253 5.6635 17.4802C5.59633 17.64 5.55226 17.7922 5.55473 17.8288C5.55713 17.8644 5.58996 17.9429 5.63327 17.9986C5.67495 18.0521 5.75774 18.1298 5.81408 18.1684C5.87179 18.2078 5.95472 18.2576 5.99522 18.277C6.02833 18.2929 6.14539 18.3106 6.26026 18.3106C6.37075 18.3106 6.48459 18.27 6.51755 18.2335C6.56258 18.1838 6.63729 18.1052 6.68438 18.0581C6.73324 18.0092 6.84674 17.925 6.93714 17.8704L6.93865 17.8695C6.38157 17.1515 6.07672 16.4385 6.03025 15.7466C5.93923 15.7332 5.86898 15.6554 5.86898 15.5608C5.86898 15.4569 5.95348 15.3723 6.05746 15.3723C6.16143 15.3723 6.24594 15.4569 6.24594 15.5608C6.24594 15.6505 6.18288 15.7255 6.09879 15.7444C6.14512 16.4246 6.4473 17.1272 6.99958 17.8364C7.06497 17.8033 7.14159 17.772 7.20698 17.7516C6.80679 17.2485 6.54572 16.7488 6.42887 16.2622C6.42715 16.2623 6.42547 16.2625 6.42379 16.2627C6.42265 16.2629 6.4215 16.2631 6.42035 16.2632C6.41934 16.2633 6.41832 16.2633 6.41728 16.2633C6.285 16.2633 6.1774 16.1557 6.1774 16.0235C6.1774 15.8912 6.285 15.7836 6.41728 15.7836C6.54956 15.7836 6.65717 15.8912 6.65717 16.0235C6.65717 16.1279 6.58966 16.2161 6.49624 16.2489C6.61282 16.7324 6.87539 17.2302 7.27915 17.7325C7.36133 17.714 7.45797 17.6813 7.49457 17.6591C7.53192 17.6365 7.59573 17.5681 7.63404 17.5096C7.67729 17.4438 7.76447 17.3526 7.82848 17.3065C7.89558 17.258 7.99832 17.22 8.0622 17.22H8.59124C8.68761 17.22 8.81338 17.1958 8.86615 17.1671C8.91783 17.139 8.98068 17.0753 9.00343 17.0282C9.02701 16.9793 9.04689 16.8972 9.04689 16.8488C9.04689 16.7987 9.02852 16.6824 9.00679 16.5951C8.9852 16.5084 8.94195 16.3929 8.91235 16.343C8.88452 16.296 8.81379 16.2368 8.75807 16.2136C8.68597 16.1836 8.60961 16.0931 8.58412 16.0076C8.56218 15.9337 8.55848 15.825 8.5946 15.7692C8.62312 15.7252 8.69467 15.6553 8.75759 15.6101C8.81317 15.5701 8.885 15.5028 8.91433 15.4633C8.94511 15.4216 9.00234 15.3327 9.04175 15.2651C9.07972 15.1999 9.12413 15.0997 9.13866 15.0463C9.15243 14.9955 9.15244 14.9073 9.13852 14.8541C9.12557 14.8044 9.09007 14.7726 9.07135 14.7726C9.0399 14.7726 8.99027 14.7931 8.96512 14.8164C8.92749 14.8511 8.8423 14.8783 8.77116 14.8783C8.69933 14.8783 8.59913 14.8326 8.54293 14.7742C8.48576 14.7149 8.45136 14.6035 8.46445 14.5209C8.47679 14.4432 8.51894 14.3363 8.56033 14.2774C8.58967 14.2357 8.59255 14.1684 8.56657 14.1333C8.53374 14.0891 8.44971 14.01 8.38303 13.9605C8.30763 13.9045 8.22237 13.7993 8.18913 13.7208C8.15884 13.6492 8.10113 13.5216 8.06049 13.4366C8.01909 13.3496 7.9718 13.2189 7.95521 13.1452C7.93705 13.0642 7.97522 12.9221 8.04226 12.8216C8.10415 12.7288 8.18749 12.6113 8.22799 12.5596C8.26836 12.5081 8.35876 12.4022 8.42936 12.3237C8.50023 12.2449 8.6164 12.1314 8.68836 12.0706C8.7665 12.0046 8.90035 11.9766 8.98205 12.0109C9.04935 12.0389 9.13955 12.0903 9.1743 12.1277C9.20028 12.1556 9.28204 12.2201 9.35277 12.2684C9.40959 12.3072 9.50082 12.2876 9.54674 12.2273C9.60225 12.1544 9.66764 12.0233 9.68936 11.9409C9.7091 11.8659 9.69478 11.7646 9.65866 11.724C9.61534 11.6753 9.53104 11.5898 9.47066 11.5336C9.41 11.477 9.32837 11.4047 9.28869 11.3722C9.23283 11.3267 9.20274 11.1897 9.20274 11.084C9.20274 10.9707 9.21385 10.8325 9.22742 10.7762C9.24181 10.7167 9.29801 10.6166 9.35531 10.5484C9.41172 10.4811 9.53029 10.3961 9.61966 10.3588C9.70814 10.322 9.89601 10.292 10.0384 10.292C10.1794 10.292 10.4037 10.3213 10.5383 10.3573C10.6762 10.3943 10.8265 10.4527 10.8804 10.4904C10.9344 10.5283 11.0046 10.5976 11.0402 10.6481C11.0529 10.6662 11.1211 10.6917 11.2327 10.6917C11.264 10.6917 11.2956 10.6896 11.3265 10.6856C11.4635 10.6678 11.587 10.6032 11.6059 10.5573C11.6247 10.5118 11.6016 10.4095 11.5383 10.3357C11.4678 10.2532 11.3971 10.1368 11.3773 10.0704C11.3585 10.0074 11.327 9.88949 11.3071 9.80745C11.2878 9.72857 11.2445 9.61548 11.2126 9.56051C11.1814 9.50678 11.0718 9.40603 10.9732 9.3405C10.8734 9.27423 10.7287 9.20055 10.6571 9.17957C10.5915 9.16059 10.4769 9.16045 10.4205 9.17923C10.3611 9.19904 10.272 9.26902 10.226 9.33214C10.1724 9.40555 10.0401 9.50191 9.9311 9.54701C9.82445 9.59115 9.61692 9.64166 9.46846 9.65969C9.32406 9.67737 9.12612 9.67716 9.04209 9.65921C8.94257 9.63789 8.86464 9.51973 8.86464 9.39006C8.86464 9.27553 8.88754 9.09644 8.9157 8.99082C8.94401 8.88486 9.0216 8.70982 9.08869 8.6005C9.15593 8.49084 9.29486 8.33087 9.39856 8.24382C9.50088 8.15788 9.67997 8.02971 9.79779 7.95809C9.91362 7.88756 10.0963 7.76522 10.205 7.68537C10.3122 7.60683 10.5164 7.38538 10.6605 7.19176C10.816 6.98286 11.0214 6.8366 11.135 6.86079C11.2488 6.88478 11.338 6.97834 11.338 7.07381V7.64898C11.338 7.74418 11.4346 7.91868 11.5488 8.02999C11.6694 8.14746 11.847 8.29619 11.945 8.36151C12.0456 8.42854 12.1846 8.54203 12.2546 8.61462C12.3174 8.67966 12.5175 8.75567 12.6917 8.78055C12.8739 8.80652 13.1697 8.8277 13.351 8.8277C13.5396 8.8277 13.7157 8.79419 13.756 8.76417C13.8156 8.71962 13.9017 8.69535 13.9501 8.71153C14.0057 8.7301 14.0343 8.8009 14.0152 8.8728C14.0003 8.92907 13.9563 9.02728 13.9171 9.09171C13.8815 9.15038 13.8258 9.30555 13.7956 9.43042C13.76 9.57723 13.6657 9.68799 13.5762 9.68799C13.5008 9.68552 13.4036 9.68367 13.3567 9.68367C13.3194 9.68367 13.2594 9.71486 13.2283 9.7505C13.203 9.77949 13.1988 9.86098 13.2333 9.93137C13.2736 10.0137 13.3053 10.2283 13.3053 10.4198C13.3053 10.5937 13.4272 10.8858 13.5714 11.0575C13.7092 11.2214 13.8619 11.4555 13.8789 11.5632C13.8936 11.6557 13.8936 11.8152 13.879 11.9188C13.8642 12.0242 13.8673 12.1181 13.876 12.1364C13.8761 12.1362 13.8765 12.1362 13.8774 12.1363C13.8782 12.1364 13.8794 12.1367 13.8809 12.1369C13.8879 12.1382 13.9028 12.141 13.9273 12.141C13.9634 12.141 14.0072 12.1348 14.0507 12.1236C14.1569 12.0961 14.3157 12.0739 14.4048 12.0739C14.5001 12.0739 14.6493 12.1391 14.7443 12.2223C14.8303 12.2975 14.907 12.4201 14.8798 12.4991C14.8663 12.5386 14.8959 12.6482 14.9557 12.7357C15.0143 12.8213 15.1139 12.9115 15.1731 12.9327C15.2299 12.953 15.3601 12.9528 15.4446 12.9316C15.5433 12.907 15.6263 12.8614 15.6423 12.8397C15.6623 12.8124 15.7215 12.669 15.7744 12.5066C15.8241 12.3537 15.8747 12.1443 15.8872 12.0399C15.9005 11.9273 15.9379 11.7968 15.9723 11.7428C16.0144 11.6763 16.1594 11.6169 16.2745 11.5947C16.3762 11.5752 16.6506 11.3533 16.8971 11.0543C17.128 10.7743 17.3619 10.4908 17.4169 10.4246C17.4692 10.3617 17.544 10.2365 17.5803 10.1511C17.6171 10.0642 17.6976 9.96249 17.7683 9.94295C17.8156 9.93 17.8813 9.88977 17.9117 9.85522C17.9405 9.82239 17.9465 9.78634 17.9425 9.77887C17.9281 9.75571 17.8907 9.70931 17.861 9.67778C17.8372 9.65256 17.74 9.60828 17.6384 9.58491C17.5382 9.56181 17.3772 9.52686 17.2795 9.50698C17.1803 9.4867 16.8173 9.37601 16.4701 9.26024C16.1107 9.14044 15.8235 9.05456 15.7907 9.05251C15.7453 9.05251 15.6685 9.02153 15.6196 8.9924C15.5641 8.95936 15.4963 8.90015 15.4651 8.85752C15.4417 8.8253 15.3537 8.74038 15.2601 8.66513C15.1777 8.59892 15.0785 8.48946 15.0549 8.42099C15.0336 8.35863 15.0336 8.26226 15.055 8.20147C15.0737 8.14835 15.1042 8.04835 15.1227 7.97844C15.1388 7.91868 15.1255 7.83102 15.0945 7.79092C15.0536 7.73788 15.0083 7.6446 14.9913 7.57852C14.9739 7.51026 14.9894 7.38079 15.0268 7.28374C15.0636 7.18847 15.1252 7.08327 15.1668 7.04447L15.1669 7.0444C15.168 7.04326 15.1708 7.04052 15.1704 7.03186C15.1691 7.00637 15.1415 6.95846 15.0836 6.91391C14.9935 6.84434 14.8972 6.78225 14.8639 6.76785C14.8262 6.75147 14.7288 6.72235 14.6511 6.70398C14.5656 6.6839 14.4591 6.63873 14.4086 6.60103C14.3536 6.56005 14.3106 6.4508 14.3106 6.35224C14.3106 6.26122 14.3347 6.1262 14.3644 6.05122C14.3911 5.98344 14.3855 5.91284 14.3698 5.89413C14.3628 5.88618 14.318 5.86966 14.2254 5.86966C14.1887 5.86966 14.1498 5.8724 14.1125 5.87761C13.9739 5.89687 13.7223 5.83388 13.5542 5.74108C13.3907 5.65075 13.0499 5.51628 12.7944 5.4413C12.6517 5.39935 12.4898 5.37427 12.3615 5.37427C12.2793 5.37427 12.2144 5.38496 12.1834 5.40353C12.0977 5.45501 12.0053 5.5964 11.982 5.71216C11.9558 5.84197 11.8614 6.05149 11.7716 6.17918C11.7318 6.23559 11.6688 6.26663 11.5941 6.26663C11.4864 6.26663 11.3663 6.20536 11.2646 6.09837C11.134 5.96123 10.996 5.70263 10.9165 5.46076L10.4716 5.81627C10.4936 5.8502 10.5067 5.89036 10.5067 5.93374C10.5067 6.05341 10.4093 6.1508 10.2896 6.1508C10.17 6.1508 10.0726 6.05341 10.0726 5.93374C10.0726 5.85527 10.1149 5.787 10.1775 5.7489L9.44626 3.99898C9.33022 3.90549 9.16532 3.80934 9.05312 3.77226C8.92064 3.72853 8.68884 3.64601 8.53641 3.58837C8.4626 3.56041 8.35122 3.54444 8.2308 3.54444C8.12464 3.54444 8.02108 3.55684 7.93938 3.57939C7.7485 3.63182 7.53144 3.67911 7.45543 3.68473C7.40362 3.68857 7.32034 3.79967 7.28648 3.94264C7.25119 4.09178 7.22247 4.29603 7.22247 4.39787C7.22247 4.50664 7.16222 4.71507 7.0882 4.86256C7.01096 5.01643 6.7782 5.14165 6.56923 5.14165C6.35999 5.14165 6.12387 5.05961 6.03162 4.95495C5.95355 4.86626 5.80339 4.79142 5.70366 4.79142C5.60168 4.79142 5.41299 4.86846 5.29154 4.95961C5.16262 5.05646 4.91554 5.22616 4.74077 5.33801C4.55928 5.45411 4.34208 5.5097 4.25662 5.45405C4.17423 5.40031 4.10974 5.22211 4.10974 5.04837C4.10974 4.88539 4.1743 4.50041 4.2536 4.1902C4.32034 3.92897 4.45416 3.21935 4.57387 2.50047ZM9.21974 3.45671L9.4333 3.9678L9.4965 3.94134L9.27868 3.42011C9.35113 3.36363 9.39862 3.27652 9.39862 3.17776C9.39862 3.00771 9.26025 2.86933 9.0902 2.86933C8.92016 2.86933 8.78178 3.00771 8.78178 3.17776C8.78178 3.3478 8.92016 3.48618 9.0902 3.48618C9.1366 3.48618 9.18026 3.47514 9.21974 3.45671ZM10.1412 5.93361C10.1412 6.01551 10.2078 6.08213 10.2896 6.08213C10.3715 6.08213 10.4381 6.01551 10.4381 5.93361C10.4381 5.85177 10.3715 5.78515 10.2896 5.78515C10.2078 5.78515 10.1412 5.85177 10.1412 5.93361ZM10.2896 5.71662C10.3411 5.71662 10.3878 5.7354 10.4251 5.76548L10.8949 5.39017C10.8829 5.34795 10.8727 5.30662 10.8653 5.26707C10.8154 5.00306 10.6468 4.71623 10.497 4.64057C10.3367 4.55962 10.0948 4.43619 9.95933 4.36628C9.84488 4.3072 9.6821 4.1963 9.56181 4.09781L10.2408 5.72265C10.2565 5.71901 10.2728 5.71662 10.2896 5.71662ZM12.4914 3.40914C12.4914 3.26267 12.3723 3.14356 12.2258 3.14356C12.0794 3.14356 11.9602 3.26267 11.9602 3.40914C11.9602 3.55561 12.0794 3.67473 12.2258 3.67473C12.3723 3.67473 12.4914 3.55561 12.4914 3.40914ZM12.184 4.44784C12.2274 4.47861 12.28 4.49718 12.3372 4.49718C12.4836 4.49718 12.6028 4.37807 12.6028 4.2316C12.6028 4.08513 12.4837 3.96601 12.3372 3.96601C12.1907 3.96601 12.0716 4.08513 12.0716 4.2316C12.0716 4.29596 12.0955 4.35421 12.1337 4.4002L10.9394 5.35453L10.9822 5.40806L12.184 4.44784ZM14.5561 6.1935C14.5561 6.40611 14.729 6.57903 14.9416 6.57903C15.1542 6.57903 15.3272 6.40611 15.3272 6.1935C15.3272 5.9809 15.1543 5.80798 14.9416 5.80798C14.729 5.80798 14.5561 5.9809 14.5561 6.1935ZM15.5414 8.56952C15.5414 8.6593 15.6144 8.7323 15.7041 8.7323C15.7939 8.7323 15.8669 8.6593 15.8669 8.56952C15.8669 8.47973 15.7939 8.40674 15.7041 8.40674C15.6144 8.40674 15.5414 8.47973 15.5414 8.56952ZM15.6956 2.52671C15.6956 2.60704 15.7609 2.67236 15.8412 2.67236C15.9215 2.67236 15.9869 2.60704 15.9869 2.52671C15.9869 2.44639 15.9215 2.38107 15.8412 2.38107C15.7609 2.38107 15.6956 2.44639 15.6956 2.52671ZM20.1848 11.6709C20.1848 11.6189 20.1425 11.5766 20.0906 11.5766C20.0386 11.5766 19.9963 11.6189 19.9963 11.6709C19.9963 11.7228 20.0386 11.7651 20.0906 11.7651C20.1425 11.7651 20.1848 11.7228 20.1848 11.6709ZM18.557 10.6856C18.557 10.5392 18.4379 10.42 18.2915 10.42C18.145 10.42 18.0259 10.5392 18.0259 10.6856C18.0259 10.8321 18.145 10.9512 18.2915 10.9512C18.3315 10.9512 18.3691 10.9416 18.4032 10.9257L18.6713 11.3078C18.6642 11.3217 18.6598 11.3372 18.6598 11.3539C18.6598 11.4106 18.706 11.4567 18.7627 11.4567C18.8193 11.4567 18.8655 11.4106 18.8655 11.3539C18.8655 11.2972 18.8193 11.2511 18.7627 11.2511C18.748 11.2511 18.7341 11.2543 18.7214 11.2598L18.4607 10.8885C18.5191 10.8398 18.557 10.7674 18.557 10.6856ZM18.5228 12.2391C18.6015 12.2391 18.6656 12.175 18.6656 12.0964C18.6656 12.0177 18.6015 11.9536 18.5228 11.9536C18.4441 11.9536 18.38 12.0177 18.38 12.0964C18.38 12.175 18.4441 12.2391 18.5228 12.2391ZM18.3034 13.6126C18.2625 13.5188 18.1689 13.4529 18.0601 13.4529C17.9137 13.4529 17.7945 13.572 17.7945 13.7184C17.7945 13.8649 17.9137 13.984 18.0601 13.984C18.2066 13.984 18.3257 13.8649 18.3257 13.7184C18.3257 13.7048 18.3237 13.6918 18.3217 13.6787L19.5683 13.3193C19.6388 13.5406 19.8462 13.7013 20.0906 13.7013C20.3929 13.7013 20.6389 13.4553 20.6389 13.153C20.6389 12.8507 20.3929 12.6047 20.0906 12.6047C19.8959 12.6047 19.725 12.707 19.6277 12.8604L19.3171 12.6965C19.3186 12.689 19.3195 12.6812 19.3195 12.6732C19.3195 12.6071 19.2657 12.5533 19.1995 12.5533C19.1334 12.5533 19.0796 12.6071 19.0796 12.6732C19.0796 12.7394 19.1334 12.7932 19.1995 12.7932C19.233 12.7932 19.2633 12.7793 19.2851 12.7571L19.5947 12.9206C19.5752 12.9619 19.5606 13.0059 19.5519 13.0521L18.9489 12.9858C18.9387 12.93 18.8899 12.8874 18.8312 12.8874C18.7651 12.8874 18.7112 12.9412 18.7112 13.0074C18.7112 13.0735 18.7651 13.1273 18.8312 13.1273C18.8807 13.1273 18.9234 13.097 18.9417 13.054L19.5439 13.1202L19.5433 13.1295C19.5428 13.1373 19.5423 13.1451 19.5423 13.153C19.5423 13.1871 19.5458 13.2203 19.5518 13.2527L18.3034 13.6126ZM8.2735 13.153C8.2735 13.2475 8.35033 13.3244 8.44485 13.3244C8.53936 13.3244 8.61619 13.2475 8.61619 13.153C8.61619 13.0585 8.53936 12.9817 8.44485 12.9817C8.35033 12.9817 8.2735 13.0585 8.2735 13.153ZM8.86464 12.3876C8.86464 12.4617 8.92482 12.5218 8.99884 12.5218C9.07286 12.5218 9.13304 12.4617 9.13304 12.3876C9.13304 12.3136 9.07286 12.2534 8.99884 12.2534C8.92482 12.2534 8.86464 12.3136 8.86464 12.3876ZM17.2205 14.738C17.2205 14.3175 16.8785 13.9755 16.4581 13.9755C16.0376 13.9755 15.6956 14.3175 15.6956 14.738C15.6956 15.1584 16.0376 15.5004 16.4581 15.5004C16.8785 15.5004 17.2205 15.1584 17.2205 14.738ZM11.746 9.24633C11.641 9.24633 11.5555 9.3318 11.5555 9.4368C11.5555 9.54194 11.6411 9.62741 11.746 9.62734C11.8511 9.62734 11.9365 9.54187 11.9365 9.4368C11.9365 9.3318 11.8511 9.24633 11.746 9.24633ZM9.49362 11.0019C9.49362 11.0629 9.54324 11.1126 9.60424 11.1126C9.66517 11.1126 9.71486 11.0629 9.71486 11.0019C9.71486 10.941 9.66517 10.8913 9.60424 10.8913C9.54331 10.8913 9.49362 10.941 9.49362 11.0019ZM8.49522 19.2765C8.24451 19.0929 7.57935 18.5746 7.0159 17.8575L6.96223 17.8995C7.54974 18.6472 8.24684 19.1809 8.47966 19.3493C8.4761 19.3737 8.47363 19.3986 8.47363 19.4239C8.47363 19.5299 8.50591 19.6285 8.56109 19.7104L8.26925 19.8966C8.20928 19.8351 8.12587 19.7966 8.03341 19.7966C7.85151 19.7966 7.70354 19.9446 7.70354 20.1265C7.70354 20.3084 7.85151 20.4564 8.03341 20.4564C8.21531 20.4564 8.36329 20.3083 8.36329 20.1265C8.36329 20.0619 8.34389 20.002 8.31161 19.951L8.60372 19.7646C8.69796 19.8707 8.8349 19.938 8.98767 19.938C9.01536 19.938 9.04229 19.9352 9.06875 19.931L9.20809 20.5954C9.11392 20.6335 9.04709 20.7255 9.04709 20.8333C9.04709 20.9749 9.1623 21.0901 9.30384 21.0901C9.44544 21.0901 9.56065 20.9749 9.56065 20.8333C9.56065 20.6917 9.44544 20.5764 9.30384 20.5764C9.29678 20.5764 9.28997 20.5774 9.28315 20.5783L9.27478 20.5794L9.13564 19.9161C9.33831 19.8551 9.488 19.6721 9.50027 19.4528C10.1582 19.4093 13.8922 19.0354 15.7784 16.1378C15.8185 16.157 15.8628 16.1685 15.91 16.1685C16.0801 16.1685 16.2184 16.0301 16.2184 15.8601C16.2184 15.69 16.0801 15.5516 15.91 15.5516C15.74 15.5516 15.6016 15.69 15.6016 15.8601C15.6016 15.9583 15.6486 16.0449 15.7204 16.1015C13.8542 18.967 10.1579 19.3403 9.49972 19.3842C9.49156 19.2789 9.45181 19.1825 9.38958 19.1045C10.1244 18.8433 13.9793 17.348 15.6095 14.2295C15.618 14.2314 15.6268 14.2323 15.6359 14.2323C15.7067 14.2323 15.7644 14.1747 15.7644 14.1038C15.7644 14.033 15.7067 13.9753 15.6359 13.9753C15.565 13.9753 15.5074 14.033 15.5074 14.1038C15.5074 14.141 15.5235 14.1742 15.5488 14.1977C13.908 17.3369 9.98977 18.8215 9.33886 19.0498L9.33606 19.0471L9.33601 19.0471C9.32931 19.0408 9.32265 19.0345 9.31562 19.0287C9.90272 18.584 13.0122 16.1303 13.5647 13.6633C13.5809 13.6654 13.5972 13.6668 13.6139 13.6668C13.8217 13.6668 13.9909 13.4977 13.9909 13.2899C13.9909 13.0821 13.8217 12.9129 13.6139 12.9129C13.4061 12.9129 13.237 13.0821 13.237 13.2899C13.237 13.4572 13.3466 13.5992 13.4978 13.6483C12.9447 16.1183 9.79224 18.5836 9.25696 18.987C9.23461 18.9733 9.21145 18.9607 9.18698 18.9503C10.9028 16.1595 11.5252 14.31 11.6077 14.0513C11.6328 14.0572 11.6586 14.061 11.6855 14.061C11.8744 14.061 12.0282 13.9073 12.0282 13.7183C12.0282 13.5294 11.8744 13.3756 11.6855 13.3756C11.4965 13.3756 11.3428 13.5294 11.3428 13.7183C11.3428 13.8563 11.4252 13.9747 11.5429 14.029C11.4635 14.2781 10.8433 16.1284 9.12022 18.9281C9.0778 18.9168 9.03345 18.9101 8.98753 18.9101C8.91941 18.9101 8.8545 18.9238 8.79501 18.9479C8.61625 18.6835 8.40597 18.2142 8.27858 17.9128C8.25856 17.9238 8.23721 17.9326 8.21482 17.9389C8.34137 18.2391 8.54991 18.7049 8.73284 18.9783C8.70632 18.9934 8.68124 19.0107 8.65793 19.0302C8.44211 18.8746 7.82094 18.4013 7.29224 17.7486L7.23899 17.7917C7.76468 18.4408 8.38063 18.9139 8.60804 19.0786C8.55684 19.1347 8.51763 19.2019 8.49522 19.2765ZM3.72819 15.1789C3.72819 14.9757 3.56294 14.8105 3.3598 14.8105C3.15672 14.8105 2.9914 14.9757 2.9914 15.1789C2.9914 15.382 3.15665 15.5473 3.3598 15.5473C3.56294 15.5473 3.72819 15.382 3.72819 15.1789ZM2.43343 14.5238C2.43343 14.434 2.36044 14.361 2.27065 14.361C2.18087 14.361 2.10788 14.434 2.10788 14.5238C2.10788 14.6136 2.18087 14.6865 2.27065 14.6865C2.36044 14.6865 2.43343 14.6136 2.43343 14.5238ZM12.2261 3.60622C12.3348 3.60622 12.4232 3.51781 12.4232 3.40918C12.4232 3.30054 12.3348 3.21213 12.2261 3.21213C12.1175 3.21213 12.0291 3.30054 12.0291 3.40918C12.0291 3.51781 12.1175 3.60622 12.2261 3.60622ZM14.805 7.19276C14.7483 7.19276 14.7022 7.14664 14.7022 7.08996C14.7022 7.03327 14.7483 6.98715 14.805 6.98715C14.8617 6.98715 14.9078 7.03327 14.9078 7.08996C14.9078 7.14664 14.8617 7.19276 14.805 7.19276ZM14.805 7.05569C14.7861 7.05569 14.7707 7.07111 14.7707 7.08996C14.7707 7.1088 14.7861 7.12422 14.805 7.12422C14.8238 7.12422 14.8393 7.1088 14.8393 7.08996C14.8393 7.07111 14.8238 7.05569 14.805 7.05569ZM6.85994 10.2857L9.11649 10.0776C9.14404 10.1999 9.25348 10.2915 9.38396 10.2915C9.53515 10.2915 9.65811 10.1685 9.65811 10.0173C9.65811 9.86612 9.53515 9.74316 9.38396 9.74316C9.2354 9.74316 9.11411 9.86186 9.10992 10.0094L6.84769 10.218C6.82564 10.1304 6.78098 10.0517 6.72041 9.98834L9.22918 6.91948C9.27408 6.94806 9.32692 6.96519 9.38401 6.96519C9.5435 6.96519 9.67324 6.83545 9.67324 6.67596C9.67324 6.51647 9.5435 6.38666 9.38401 6.38666C9.22452 6.38666 9.09478 6.51647 9.09478 6.67596C9.09478 6.75375 9.12597 6.82414 9.17614 6.87616L6.67004 9.9418C6.59876 9.88464 6.51199 9.84633 6.41706 9.83372L6.5159 8.45548C6.58635 8.44397 6.64043 8.38311 6.64043 8.30936C6.64043 8.22746 6.57381 8.16084 6.49198 8.16084C6.41007 8.16084 6.34345 8.22746 6.34345 8.30936C6.34345 8.37571 6.38739 8.43129 6.44749 8.45035L6.34866 9.82872C6.19109 9.82885 6.05004 9.90041 5.95573 10.0125L5.15781 9.28713C5.17049 9.26478 5.1783 9.23929 5.1783 9.21187C5.1783 9.12689 5.10908 9.05766 5.02409 9.05766C4.93911 9.05766 4.86981 9.12702 4.86981 9.21201C4.86981 9.297 4.93904 9.36622 5.02403 9.36622C5.05679 9.36622 5.08701 9.3558 5.11203 9.33833L5.91523 10.0685C5.86471 10.148 5.83511 10.2419 5.83511 10.3429C5.83511 10.358 5.83606 10.3729 5.83737 10.3878L4.11164 10.6763C4.05784 10.3517 3.77588 10.103 3.43627 10.103C3.25896 10.103 3.09769 10.1713 2.97583 10.2822L2.25179 9.73756C2.26372 9.7133 2.27105 9.68636 2.27105 9.65751C2.27105 9.55669 2.18908 9.47472 2.08833 9.47472C1.98751 9.47472 1.90554 9.55669 1.90554 9.65751C1.90554 9.75826 1.98751 9.84023 2.08833 9.84023C2.13548 9.84023 2.17811 9.82179 2.2106 9.79232L2.92703 10.3312C2.8356 10.4329 2.77412 10.5618 2.75651 10.7043L1.37951 10.4168L1.37978 10.4143L1.38006 10.4114C1.38006 10.3043 1.29294 10.2172 1.18589 10.2172C1.07883 10.2172 0.991719 10.3043 0.991719 10.4114C0.991719 10.5186 1.07883 10.6056 1.18589 10.6056C1.26731 10.6056 1.33688 10.5552 1.36573 10.4839L2.75164 10.7732L2.75128 10.7799C2.75108 10.7827 2.75089 10.7855 2.75089 10.7883C2.75089 11.064 2.9149 11.3015 3.15005 11.4102L2.81367 12.4058C2.79338 12.4015 2.77241 12.399 2.75082 12.399C2.5855 12.399 2.45096 12.5335 2.45096 12.6988C2.45096 12.8641 2.5855 12.9987 2.75082 12.9987C2.91613 12.9987 3.05067 12.8641 3.05067 12.6988C3.05067 12.5792 2.97981 12.4766 2.8783 12.4285L3.21366 11.4359C3.28357 11.46 3.3582 11.4737 3.4362 11.4737C3.81412 11.4737 4.12158 11.1662 4.12158 10.7883C4.12158 10.777 4.12083 10.7659 4.12008 10.7549L4.11939 10.7444L5.84785 10.4554C5.88212 10.6079 5.98424 10.7347 6.12084 10.8028L5.86273 11.5519L5.85849 11.5514C5.85639 11.5511 5.85428 11.5508 5.8521 11.5508C5.77651 11.5508 5.71503 11.6123 5.71503 11.6879C5.71503 11.7635 5.77651 11.825 5.8521 11.825C5.9277 11.825 5.98918 11.7635 5.98918 11.6879C5.98918 11.6402 5.96471 11.5983 5.9277 11.5737L6.18417 10.8292C6.23599 10.8469 6.2913 10.8569 6.34901 10.8569C6.43235 10.8569 6.51089 10.8365 6.5806 10.8011L7.1008 11.9923C7.06585 12.0189 7.04295 12.0605 7.04295 12.1077C7.04295 12.188 7.10827 12.2533 7.1886 12.2533C7.26893 12.2533 7.33424 12.188 7.33424 12.1077C7.33424 12.0274 7.26893 11.962 7.1886 11.962C7.18003 11.962 7.17167 11.9631 7.16351 11.9646L6.64009 10.766C6.69451 10.7286 6.74132 10.6809 6.77778 10.6257L8.15814 11.15C8.15224 11.1733 8.1482 11.1972 8.1482 11.2224C8.1482 11.3862 8.28144 11.5193 8.44524 11.5193C8.60905 11.5193 8.74222 11.3862 8.74222 11.2224C8.74222 11.0586 8.60905 10.9254 8.44524 10.9254C8.33086 10.9254 8.2325 10.9911 8.18288 11.086L6.81177 10.5652C6.84433 10.4978 6.86311 10.4225 6.86311 10.3428C6.86311 10.3235 6.86203 10.3044 6.85994 10.2857ZM12.1404 4.2316C12.1404 4.12296 12.2288 4.03455 12.3374 4.03455C12.4461 4.03455 12.5345 4.12296 12.5345 4.2316C12.5345 4.34023 12.4461 4.42865 12.3374 4.42865C12.2288 4.42865 12.1404 4.34023 12.1404 4.2316ZM14.942 5.94494C14.805 5.94494 14.6936 6.05638 14.6936 6.19339C14.6936 6.3304 14.805 6.44184 14.942 6.44184C15.0791 6.44184 15.1905 6.3304 15.1905 6.19339C15.1905 6.05638 15.0791 5.94494 14.942 5.94494ZM4.90962 6.51042C4.90962 6.58612 4.84825 6.64749 4.77255 6.64749C4.69684 6.64749 4.63547 6.58612 4.63547 6.51042C4.63547 6.43471 4.69684 6.37334 4.77255 6.37334C4.84825 6.37334 4.90962 6.43471 4.90962 6.51042ZM3.18742 13.41C3.18742 13.547 3.29886 13.6584 3.43587 13.6584C3.57288 13.6584 3.68432 13.547 3.68432 13.41C3.68432 13.273 3.57288 13.1615 3.43587 13.1615C3.29886 13.1615 3.18742 13.273 3.18742 13.41ZM5.21789 12.0736C5.33598 12.0736 5.43207 12.1697 5.43207 12.2878C5.43207 12.4058 5.33598 12.5019 5.21789 12.5019C5.0998 12.5019 5.00371 12.4058 5.00371 12.2878C5.00371 12.1697 5.0998 12.0736 5.21789 12.0736ZM8.03352 19.8652C7.88939 19.8652 7.77219 19.9824 7.77219 20.1265C7.77219 20.2707 7.88939 20.3879 8.03352 20.3879C8.17766 20.3879 8.29486 20.2707 8.29486 20.1265C8.29486 19.9824 8.17759 19.8652 8.03352 19.8652ZM11.6854 13.4443C11.8366 13.4443 11.9595 13.5672 11.9595 13.7184C11.9595 13.8696 11.8366 13.9926 11.6854 13.9926C11.5342 13.9926 11.4112 13.8696 11.4112 13.7184C11.4112 13.5672 11.5342 13.4443 11.6854 13.4443ZM9.22334 20.6694L9.22231 20.6645C9.15933 20.6949 9.11539 20.759 9.11539 20.8336C9.11539 20.9374 9.19976 21.0219 9.3036 21.0219C9.40743 21.0219 9.49187 20.9374 9.49187 20.8336C9.49187 20.7297 9.40743 20.6453 9.3036 20.6453L9.30093 20.6454L9.2982 20.6456L9.29437 20.6461L9.29129 20.6465L9.28859 20.6468L9.29037 20.6554L9.22334 20.6694ZM20.5021 13.153C20.5021 13.3798 20.3177 13.5642 20.0909 13.5642C19.8641 13.5642 19.6797 13.3798 19.6797 13.153C19.6797 12.9262 19.8641 12.7417 20.0909 12.7417C20.3177 12.7417 20.5021 12.9262 20.5021 13.153ZM13.9225 13.2901C13.9225 13.1201 13.7842 12.9817 13.6141 12.9817C13.4441 12.9817 13.3057 13.1201 13.3057 13.2901C13.3057 13.4602 13.4441 13.5986 13.6141 13.5986C13.7842 13.5986 13.9225 13.4602 13.9225 13.2901ZM18.4887 10.6855C18.4887 10.7941 18.4002 10.8826 18.2916 10.8826C18.183 10.8826 18.0946 10.7941 18.0946 10.6855C18.0946 10.5769 18.183 10.4885 18.2916 10.4885C18.4002 10.4885 18.4887 10.5769 18.4887 10.6855ZM5.23522 7.89274C5.30778 7.89274 5.3666 7.83391 5.3666 7.76135C5.3666 7.68878 5.30778 7.62996 5.23522 7.62996C5.16265 7.62996 5.10383 7.68878 5.10383 7.76135C5.10383 7.83391 5.16265 7.89274 5.23522 7.89274ZM6.73138 7.36715C6.73138 7.43654 6.67513 7.49278 6.60575 7.49278C6.53636 7.49278 6.48012 7.43654 6.48012 7.36715C6.48012 7.29777 6.53636 7.24152 6.60575 7.24152C6.67513 7.24152 6.73138 7.29777 6.73138 7.36715ZM3.4362 11.3367C3.13388 11.3367 2.88789 11.0907 2.88789 10.7884C2.88789 10.4861 3.13388 10.2401 3.4362 10.2401C3.73852 10.2401 3.98451 10.4861 3.98451 10.7884C3.98451 11.0907 3.73852 11.3367 3.4362 11.3367ZM6.34907 9.96593C6.55688 9.96593 6.72603 10.1351 6.72603 10.3429C6.72603 10.5507 6.55688 10.7198 6.34907 10.7198C6.14126 10.7198 5.97211 10.5507 5.97211 10.3429C5.97211 10.1351 6.14126 9.96593 6.34907 9.96593ZM3.9729 6.76737C3.9729 6.8209 3.92931 6.86449 3.87578 6.86449C3.85357 6.86449 3.83335 6.85675 3.81691 6.84414L3.10815 7.28415C3.13173 7.31547 3.14921 7.35125 3.15866 7.39052L4.58974 6.92988C4.59036 6.87059 4.63868 6.82241 4.69817 6.82241C4.758 6.82241 4.80667 6.87114 4.80667 6.93097C4.80667 6.99081 4.758 7.03947 4.69817 7.03947C4.66239 7.03947 4.63086 7.02179 4.61106 6.99499L3.16744 7.45968C3.1673 7.48997 3.16134 7.51862 3.15263 7.54603L3.99833 8.03444C4.01752 8.01744 4.04239 8.00675 4.06995 8.00675C4.12978 8.00675 4.17851 8.05548 4.17851 8.11531C4.17851 8.17515 4.12978 8.22381 4.06995 8.22381C4.01011 8.22381 3.96145 8.17515 3.96145 8.11531C3.96145 8.10777 3.96221 8.10051 3.96364 8.09345L3.12446 7.60882C3.1052 7.64041 3.08026 7.66783 3.05085 7.6901L3.34084 8.16884C3.34755 8.16747 3.35462 8.16672 3.36174 8.16672C3.41842 8.16672 3.46455 8.21284 3.46455 8.26952C3.46455 8.3262 3.41842 8.37233 3.36174 8.37233C3.30506 8.37233 3.25894 8.3262 3.25894 8.26952C3.25894 8.24485 3.26805 8.22257 3.28251 8.20482L2.99212 7.7254C2.95655 7.74089 2.91748 7.74973 2.87629 7.74973C2.71563 7.74973 2.585 7.6191 2.585 7.45844C2.585 7.29779 2.71563 7.16716 2.87629 7.16716C2.94606 7.16716 3.00932 7.19279 3.05949 7.23384L3.78058 6.78615C3.77935 6.78005 3.77866 6.77381 3.77866 6.76737C3.77866 6.71384 3.82225 6.67025 3.87578 6.67025C3.92931 6.67025 3.9729 6.71384 3.9729 6.76737ZM2.65354 7.45844C2.65354 7.58126 2.75347 7.68119 2.87629 7.68119C2.99911 7.68119 3.09904 7.58126 3.09904 7.45844C3.09904 7.33562 2.99911 7.23569 2.87629 7.23569C2.75347 7.23569 2.65354 7.33562 2.65354 7.45844ZM8.06223 16.4278C8.13794 16.4278 8.19931 16.3665 8.19931 16.2907C8.19931 16.215 8.13794 16.1537 8.06223 16.1537C7.98653 16.1537 7.92516 16.215 7.92516 16.2907C7.92516 16.3665 7.98653 16.4278 8.06223 16.4278ZM8.11793 14.4553C8.11793 14.5073 8.07574 14.5495 8.02369 14.5495C7.97165 14.5495 7.92945 14.5073 7.92945 14.4553C7.92945 14.4032 7.97165 14.361 8.02369 14.361C8.07574 14.361 8.11793 14.4032 8.11793 14.4553ZM7.43693 16.5864C7.52801 16.5864 7.60184 16.5126 7.60184 16.4215C7.60184 16.3304 7.52801 16.2566 7.43693 16.2566C7.34586 16.2566 7.27203 16.3304 7.27203 16.4215C7.27203 16.5126 7.34586 16.5864 7.43693 16.5864ZM6.70441 14.7636C6.70441 14.6408 6.80434 14.5408 6.92716 14.5408C7.04998 14.5408 7.14991 14.6408 7.14991 14.7636C7.14991 14.8864 7.04998 14.9863 6.92716 14.9863C6.80434 14.9863 6.70441 14.8864 6.70441 14.7636ZM5.43201 15.4662C5.52664 15.4662 5.60335 15.3895 5.60335 15.2948C5.60335 15.2002 5.52664 15.1235 5.43201 15.1235C5.33738 15.1235 5.26066 15.2002 5.26066 15.2948C5.26066 15.3895 5.33738 15.4662 5.43201 15.4662ZM8.36205 15.0165C8.36205 15.0638 8.32369 15.1021 8.27638 15.1021C8.22906 15.1021 8.1907 15.0638 8.1907 15.0165C8.1907 14.9691 8.22906 14.9308 8.27638 14.9308C8.32369 14.9308 8.36205 14.9691 8.36205 15.0165ZM15.716 11.7364C15.7854 11.7364 15.8416 11.6801 15.8416 11.6107C15.8416 11.5414 15.7854 11.4851 15.716 11.4851C15.6466 11.4851 15.5904 11.5414 15.5904 11.6107C15.5904 11.6801 15.6466 11.7364 15.716 11.7364ZM12.1489 7.36716C12.1489 7.45233 12.0798 7.52137 11.9947 7.52137C11.9095 7.52137 11.8405 7.45233 11.8405 7.36716C11.8405 7.28199 11.9095 7.21295 11.9947 7.21295C12.0798 7.21295 12.1489 7.28199 12.1489 7.36716ZM13.12 6.38472C13.12 6.27286 13.029 6.18191 12.9173 6.18191C12.8054 6.18191 12.7145 6.27286 12.7145 6.38472C12.7145 6.4965 12.8054 6.58745 12.9173 6.58745C13.029 6.58745 13.12 6.4965 13.12 6.38472ZM14.2823 9.89738C14.2823 9.98254 14.2132 10.0516 14.1281 10.0516C14.0429 10.0516 13.9739 9.98254 13.9739 9.89738C13.9739 9.81221 14.0429 9.74316 14.1281 9.74316C14.2132 9.74316 14.2823 9.81221 14.2823 9.89738ZM13.2714 8.61224C13.3282 8.61224 13.3742 8.56621 13.3742 8.50943C13.3742 8.45265 13.3282 8.40662 13.2714 8.40662C13.2147 8.40662 13.1686 8.45265 13.1686 8.50943C13.1686 8.56621 13.2147 8.61224 13.2714 8.61224ZM10.5069 6.51047C10.5069 6.59861 10.4351 6.67037 10.347 6.67037C10.2588 6.67037 10.187 6.59861 10.187 6.51047C10.187 6.42233 10.2588 6.35057 10.347 6.35057C10.4351 6.35057 10.5069 6.42233 10.5069 6.51047ZM10.4384 6.51047C10.4384 6.46009 10.3974 6.4191 10.347 6.4191C10.2966 6.4191 10.2556 6.46009 10.2556 6.51047C10.2556 6.56084 10.2966 6.60183 10.347 6.60183C10.3974 6.60183 10.4384 6.56084 10.4384 6.51047ZM8.78201 16.37C8.78201 16.4481 8.7187 16.5114 8.64061 16.5114C8.56252 16.5114 8.49922 16.4481 8.49922 16.37C8.49922 16.292 8.56252 16.2287 8.64061 16.2287C8.7187 16.2287 8.78201 16.292 8.78201 16.37ZM15.8985 10.3601C15.9427 10.3601 15.9785 10.3243 15.9785 10.2801C15.9785 10.2359 15.9427 10.2001 15.8985 10.2001C15.8543 10.2001 15.8185 10.2359 15.8185 10.2801C15.8185 10.3243 15.8543 10.3601 15.8985 10.3601ZM14.345 8.98348C14.4568 8.98348 14.5478 9.07443 14.5478 9.18628C14.5478 9.29807 14.4568 9.38902 14.345 9.38902C14.2333 9.38902 14.1423 9.29807 14.1423 9.18628C14.1423 9.07443 14.2333 8.98348 14.345 8.98348ZM14.345 9.05201C14.271 9.05201 14.2108 9.11226 14.2108 9.18628C14.2108 9.2603 14.271 9.32048 14.345 9.32048C14.4191 9.32048 14.4792 9.2603 14.4792 9.18628C14.4792 9.11226 14.4191 9.05201 14.345 9.05201ZM14.9964 10.1659C15.0784 10.1659 15.1449 10.0994 15.1449 10.0174C15.1449 9.93534 15.0784 9.86885 14.9964 9.86885C14.9143 9.86885 14.8479 9.93534 14.8479 10.0174C14.8479 10.0994 14.9143 10.1659 14.9964 10.1659ZM17.1439 10.0174C17.1439 10.0742 17.0979 10.1202 17.0411 10.1202C16.9843 10.1202 16.9383 10.0742 16.9383 10.0174C16.9383 9.96064 16.9843 9.91461 17.0411 9.91461C17.0979 9.91461 17.1439 9.96064 17.1439 10.0174ZM13.8198 10.2686C13.8671 10.2686 13.9054 10.2302 13.9054 10.1829C13.9054 10.1356 13.8671 10.0972 13.8198 10.0972C13.7725 10.0972 13.7341 10.1356 13.7341 10.1829C13.7341 10.2302 13.7725 10.2686 13.8198 10.2686ZM13.9739 11.0019C13.9739 10.9169 14.0431 10.8477 14.1281 10.8477C14.2131 10.8477 14.2823 10.9169 14.2823 11.0019C14.2823 11.0869 14.2131 11.1561 14.1281 11.1561C14.0431 11.1561 13.9739 11.0869 13.9739 11.0019ZM14.0424 11.0019C14.0424 11.0491 14.0809 11.0876 14.1281 11.0876C14.1753 11.0876 14.2138 11.0491 14.2138 11.0019C14.2138 10.9547 14.1753 10.9162 14.1281 10.9162C14.0809 10.9162 14.0424 10.9547 14.0424 11.0019ZM8.67926 19.424C8.67926 19.5941 8.81764 19.7325 8.98768 19.7325C9.15772 19.7325 9.2961 19.5941 9.2961 19.424C9.2961 19.254 9.15772 19.1156 8.98768 19.1156C8.81764 19.1156 8.67926 19.254 8.67926 19.424ZM3.35987 15.4102C3.48762 15.4102 3.59119 15.3066 3.59119 15.1789C3.59119 15.0511 3.48762 14.9475 3.35987 14.9475C3.23212 14.9475 3.12855 15.0511 3.12855 15.1789C3.12855 15.3066 3.23212 15.4102 3.35987 15.4102Z" fill="currentColor"/></svg>',
				'Halloween' =>
				[
					'dark' => '<svg class="wp-dark-mode-ignore" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.9734 15.8815C19.9734 17.471 15.6993 18.7594 10.4265 18.7594C5.15378 18.7594 0.8797 17.471 0.8797 15.8815C0.8797 15.8331 0.883802 15.785 0.891634 15.7372C1.14187 17.2595 5.31525 18.4704 10.4265 18.4704C15.5378 18.4704 19.7112 17.2595 19.9615 15.7372C19.9693 15.785 19.9734 15.8331 19.9734 15.8815Z" fill="#404350"/>
<path d="M19.9734 15.5925C19.9734 15.641 19.9693 15.6895 19.9615 15.7372C19.7112 17.2595 15.5382 18.4704 10.4265 18.4704C5.31488 18.4704 1.14187 17.2595 0.891634 15.7372C0.883802 15.6895 0.8797 15.641 0.8797 15.5925C0.8797 14.0031 5.15415 12.7147 10.4265 12.7147C15.6989 12.7147 19.9734 14.0031 19.9734 15.5925Z" fill="#575B6C"/>
<path d="M13.3826 6.80123C13.3774 6.79153 13.3718 6.78034 13.3651 6.76878C13.3703 6.77736 13.3767 6.78818 13.3826 6.80123Z" fill="#575A6C"/>
<path d="M17.1704 3.54598C17.1059 3.60155 17.0392 3.56985 16.9761 3.55418C16.0696 3.33192 15.1492 3.26815 14.2191 3.31328C14.1602 3.31589 14.1065 3.32894 14.0431 3.34647C13.9607 3.36959 13.6799 3.45946 13.2241 4.04532C13.2241 4.04532 12.8464 4.53162 12.7024 5.02723C12.68 5.10443 12.6536 5.21481 12.6845 5.34534C12.7233 5.50718 12.8303 5.61235 12.8885 5.6612C12.4996 5.74772 12.1259 5.87601 11.7753 6.06806C11.7578 6.07776 11.7407 6.08745 11.7239 6.09715C11.7067 6.10685 11.6899 6.11691 11.6732 6.12698C11.257 6.37871 11.1376 6.61514 11.1 6.68861C11.0645 6.75723 11.0392 6.82286 11.0205 6.88178C11.0034 6.93586 10.9922 6.98434 10.9844 7.02498C11.0451 6.98322 11.141 6.92206 11.2652 6.86202C11.7794 6.6129 12.2855 6.62409 12.5995 6.65392C12.6081 6.65467 12.617 6.65579 12.6256 6.65654C12.6513 6.65915 12.6756 6.66176 12.6983 6.66437C12.7058 6.66511 12.7132 6.66623 12.7203 6.66698C12.7278 6.66772 12.7349 6.66884 12.7416 6.66959C12.8993 6.68861 13.1246 6.72814 13.3897 6.81689C13.3983 6.83591 13.4065 6.85903 13.414 6.887C13.4233 6.91423 13.4289 6.94294 13.4363 6.97054C13.9155 8.71731 14.3936 10.4641 14.8717 12.2112C14.9079 12.3429 14.9437 12.4745 14.9799 12.6062C14.9881 12.6367 14.9944 12.6677 15.0015 12.6986C15.0026 12.7039 15.0041 12.7095 15.0052 12.7147C15.003 12.7169 15.0011 12.7195 14.9989 12.7218L14.9948 12.7039C14.7483 12.8978 14.4608 13.0917 14.13 13.267C13.8432 13.4188 13.5642 13.5362 13.2883 13.6276H13.2879C13.2749 13.6321 13.2614 13.6365 13.2484 13.6406C12.8158 13.7801 12.3918 13.8581 11.9652 13.901C11.9614 13.9013 11.9577 13.9017 11.954 13.9021V13.8752C11.9543 13.8156 11.942 13.7574 11.9197 13.7048C11.8865 13.6261 11.8313 13.5601 11.7615 13.5131C11.6925 13.4657 11.6068 13.4382 11.5173 13.4382H9.36588C9.30621 13.4382 9.24803 13.4505 9.19582 13.4728C9.11676 13.506 9.05075 13.5612 9.00377 13.6306C8.95678 13.6999 8.92881 13.7857 8.92881 13.8752V13.8961C8.74309 13.8763 8.55887 13.8491 8.37352 13.8122C8.34705 13.807 8.3202 13.8014 8.29372 13.7954C8.29223 13.7954 8.29074 13.795 8.28962 13.7947C8.28962 13.7947 8.28937 13.7945 8.28887 13.7943C7.92415 13.716 7.55347 13.5981 7.15668 13.4139C6.58536 13.1484 6.13188 12.8228 5.79028 12.5275C5.82086 12.3336 5.85182 12.1396 5.88314 11.9457L5.90776 11.7977C6.26576 9.62463 6.70544 7.46988 7.40877 5.3748C7.65229 4.64946 7.9387 3.94202 8.33586 3.28344C8.51785 2.98175 8.7375 2.71436 9.02987 2.51447C9.98269 1.8626 10.9847 1.30583 12.0979 0.975044C12.5462 0.84191 13.0075 0.776276 13.4751 0.76024C13.7436 0.750917 13.9924 0.819162 14.2187 0.964229C14.9094 1.40652 15.5549 1.90213 16.1542 2.45219C16.4164 2.69236 16.8195 2.9094 17.097 3.4039C17.1298 3.46282 17.1544 3.51242 17.1704 3.54598Z" fill="#575A6C"/>
<path d="M13.3897 6.81688C13.1245 6.72813 12.8993 6.6886 12.7415 6.66958C12.7348 6.66883 12.7277 6.66771 12.7203 6.66697C12.7132 6.66622 12.7057 6.6651 12.6983 6.66436C12.674 6.661 12.6494 6.65839 12.6256 6.65653C12.617 6.65578 12.608 6.65466 12.5994 6.65392C12.2854 6.62408 11.7794 6.61289 11.2651 6.86201C11.1409 6.92205 11.0451 6.98321 10.9843 7.02498C10.9921 6.98433 11.0033 6.93585 11.0205 6.88177C11.0391 6.82285 11.0645 6.75722 11.0999 6.6886C11.1376 6.61513 11.2569 6.3787 11.6731 6.12698C11.6899 6.11691 11.7067 6.10684 11.7238 6.09714C11.7406 6.08745 11.7578 6.07775 11.7753 6.06805C12.1258 5.876 12.4995 5.74771 12.8885 5.66119C12.8885 5.66157 12.8888 5.66157 12.8888 5.66194C12.8952 5.67126 12.9041 5.68618 12.909 5.70632C12.9142 5.72757 12.9134 5.74734 12.9101 5.76375C12.9082 5.77494 12.9049 5.78426 12.9023 5.79209C12.8743 5.87227 12.8135 5.94462 12.7747 6.01435C12.7445 6.06917 12.6975 6.1542 12.7162 6.23885C12.7203 6.25787 12.7356 6.31232 12.8799 6.41413C12.8829 6.41636 12.8859 6.41823 12.8888 6.42047C13.069 6.5454 13.1641 6.54278 13.2756 6.65317C13.3147 6.69195 13.3431 6.73223 13.3632 6.76617C13.3639 6.76691 13.3643 6.76803 13.3651 6.76878C13.3718 6.78034 13.3774 6.79153 13.3826 6.80122C13.3845 6.80495 13.3863 6.80868 13.3878 6.81241C13.3886 6.8139 13.3893 6.81539 13.3897 6.81688Z" fill="#404350"/>
<path d="M12.6983 6.66437C12.674 6.66101 12.6494 6.6584 12.6255 6.65654C12.6513 6.65915 12.6755 6.66176 12.6983 6.66437Z" fill="#404350"/>
<path d="M13.3901 6.81697H13.3897C13.3897 6.81697 13.3886 6.81394 13.3878 6.81242C13.3886 6.81394 13.3893 6.81545 13.3901 6.81697Z" fill="#404350"/>
<path d="M15.4207 14.4118C15.2574 14.5166 15.0832 14.6188 14.8982 14.7169C14.5119 14.922 14.1285 15.0805 13.7534 15.2017C13.3778 15.3233 13.0105 15.4072 12.6547 15.465C11.9428 15.5806 11.279 15.5922 10.676 15.5925C10.5757 15.5925 10.4772 15.5922 10.3803 15.5918C9.95254 15.5903 9.50577 15.5892 9.03253 15.553C8.55967 15.5168 8.06032 15.4445 7.53786 15.2987C7.18992 15.2017 6.83191 15.0723 6.46533 14.9019C6.09949 14.7318 5.77206 14.5435 5.4823 14.3507L5.78661 12.5241C5.78661 12.5241 5.78884 12.5263 5.79034 12.5275C6.13193 12.8228 6.58541 13.1484 7.15673 13.4139C7.55352 13.5981 7.9242 13.716 8.28892 13.7943C8.28892 13.7943 8.28917 13.7944 8.28967 13.7947C8.28967 13.7947 8.29228 13.7954 8.29377 13.7954C8.32025 13.8014 8.3471 13.807 8.37358 13.8122C8.76552 13.8905 9.15336 13.9244 9.55686 13.939C9.82574 13.9487 10.101 13.9498 10.3862 13.9509C10.4832 13.9513 10.5798 13.9517 10.676 13.9517C11.1105 13.9517 11.539 13.9442 11.9652 13.9009C12.3918 13.8581 12.8158 13.7801 13.2484 13.6406C13.2615 13.6365 13.2749 13.6321 13.288 13.6276H13.2883C13.5643 13.5362 13.8432 13.4188 14.13 13.267C14.4608 13.0917 14.7483 12.8978 14.9948 12.7039L14.9989 12.7218L15.4207 14.4118Z" fill="#ED5261"/>
<path d="M15.0053 12.7147C15.003 12.7169 15.0012 12.7195 14.9989 12.7218L14.9948 12.7039C14.997 12.7024 14.9993 12.7005 15.0015 12.6986C15.0026 12.7039 15.0041 12.7095 15.0053 12.7147Z" fill="#ED5261"/>
<path d="M11.9197 13.7048C11.8865 13.6261 11.8313 13.5601 11.7616 13.5131C11.6926 13.4657 11.6068 13.4381 11.5173 13.4381H9.3659C9.30623 13.4381 9.24806 13.4504 9.19585 13.4728C9.11679 13.506 9.05078 13.5612 9.00379 13.6306C8.9568 13.6999 8.92883 13.7857 8.92883 13.8752V15.6444C8.92883 15.704 8.94114 15.7622 8.96351 15.8148C8.9967 15.8935 9.0519 15.9595 9.12126 16.0065C9.19063 16.0538 9.2764 16.0814 9.3659 16.0814H11.5173C11.5766 16.0814 11.6351 16.0691 11.6873 16.0467C11.766 16.0136 11.8324 15.9584 11.8794 15.889C11.9264 15.8196 11.9544 15.7339 11.954 15.6444V13.8752C11.9544 13.8155 11.9421 13.7574 11.9197 13.7048ZM11.3573 15.4847H9.52551V14.0348H11.3573V15.4847Z" fill="#F4C563"/>
</svg>
',
					'light' => '<svg class="wp-dark-mode-ignore" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.29055 15.18C5.36506 16.2932 5.77104 17.3424 6.43679 18.2744C2.82088 17.719 0.213861 16.3573 0.0124853 14.743C0.00443029 14.6766 0 14.6093 0 14.5417C0 12.7696 2.89861 11.2669 6.91284 10.7413C5.87857 11.9097 5.27767 13.3064 5.27767 14.8063C5.27767 14.9315 5.2821 15.0568 5.29015 15.18H5.29055Z" fill="#8859C0"/><path d="M20.1199 14.5413C20.1199 14.6089 20.1154 14.6762 20.1074 14.7427C19.8436 16.8587 15.4463 18.5418 10.0603 18.5418C8.78279 18.5418 7.56124 18.4472 6.43716 18.2744C5.77141 17.3428 5.36544 16.2937 5.29093 15.18C5.28287 15.0568 5.27844 14.9315 5.27844 14.8063C5.27844 13.3064 5.87935 11.9093 6.91362 10.7413C7.90358 10.6116 8.96121 10.5415 10.0603 10.5415C15.6163 10.5415 20.1203 12.3322 20.1203 14.5417L20.1199 14.5413Z" fill="#9866CB"/><path d="M9.5102 13.9593C9.49409 13.9843 9.47113 13.9859 9.44777 13.9774C9.43166 13.9714 9.42924 13.9577 9.44133 13.9529C9.45703 13.9464 9.47516 13.9464 9.49167 13.942C9.5102 13.9367 9.51624 13.942 9.5102 13.9597V13.9593Z" fill="#CE8AFB"/><path d="M15.3325 14.6432L14.6925 11.3458C14.6897 11.3321 14.6828 11.3197 14.672 11.3108L12.6876 9.61359L12.0782 10.2536L12.2808 9.26562L12.769 6.97516C12.7718 6.96227 12.7702 6.94858 12.7645 6.9365L12.2816 5.89861L11.4584 6.45642L11.9264 5.13499L13.297 0.97818L9.90096 5.41289L9.81316 7.1999L7.4933 10.9632L8.10951 12.7112L6.5271 16.0705C7.3761 16.4108 8.58154 16.6714 10.2522 16.6138C14.5233 16.4664 15.3373 14.9142 15.3333 14.6536C15.3333 14.65 15.3329 14.6464 15.3321 14.6428L15.3325 14.6432ZM11.5369 12.863L9.44786 13.9774L11.3058 12.0293L13.7041 12.1022L11.5369 12.863Z" fill="#CEB0FB" class="wp-dark-mode-ignore"/><path d="M12.282 5.89861L11.4584 6.45643L11.9268 5.13499L12.282 5.89861Z" fill="#CE8AFB" class="wp-dark-mode-ignore"/><path d="M12.6876 9.6136L12.0782 10.254L12.2812 9.26602L12.6876 9.6136Z" fill="#CE8AFB" class="wp-dark-mode-ignore"/><path d="M13.2977 0.976974V0.978585L9.90132 5.41329L9.81352 7.2003L7.49366 10.9636L8.10988 12.7116L6.52746 16.0709C5.34579 15.5977 4.85322 14.9702 4.75455 14.8304C4.74246 14.8131 4.74005 14.791 4.7481 14.7712L5.83714 12.1783C5.84238 12.1662 5.84319 12.1525 5.83996 12.1397L5.3776 10.2878C5.37237 10.2669 5.37841 10.2447 5.39371 10.2294L8.08772 7.54587C8.0994 7.53419 8.10585 7.51848 8.10585 7.50237V4.98718C8.10585 4.96825 8.11471 4.95013 8.13001 4.93845L13.2977 0.976974Z" fill="#CE8AFB"/><path d="M13.7041 12.1022L11.5369 12.863L9.44781 13.9774L11.3057 12.0293L13.7041 12.1022Z" fill="#CE8AFB"/><path d="M5.08876 5.43665C4.76817 5.14466 4.65862 4.785 4.62157 4.55019C4.60022 4.41527 4.48544 4.31499 4.3489 4.31499H4.33642C4.19989 4.31499 4.0851 4.41527 4.06376 4.55019C4.0267 4.7854 3.91756 5.14466 3.59656 5.43665C3.32269 5.68596 3.0166 5.77537 2.80677 5.80678C2.67265 5.82692 2.57397 5.94372 2.57397 6.07945V6.09596C2.57397 6.23169 2.67225 6.34889 2.80677 6.36862C3.017 6.40004 3.32269 6.48904 3.59656 6.73875C3.91715 7.03075 4.0267 7.3904 4.06376 7.62521C4.0851 7.76013 4.19989 7.86042 4.33642 7.86042H4.3489C4.48544 7.86042 4.60022 7.76013 4.62157 7.62521C4.65862 7.39 4.76777 7.03075 5.08876 6.73875C5.36263 6.48945 5.66872 6.40004 5.87856 6.36862C6.01267 6.34848 6.11135 6.23169 6.11135 6.09596V6.07945C6.11135 5.94372 6.01308 5.82652 5.87856 5.80678C5.66832 5.77537 5.36263 5.68636 5.08876 5.43665Z" fill="#F6D165"/><path d="M17.5729 8.76097C17.1319 8.35943 16.9816 7.86485 16.9305 7.54184C16.9011 7.35617 16.7432 7.21843 16.5555 7.21843H16.5382C16.3505 7.21843 16.1926 7.35617 16.1632 7.54184C16.1125 7.86485 15.9619 8.35943 15.5209 8.76097C15.1443 9.10412 14.7234 9.22655 14.4346 9.26965C14.2502 9.29744 14.1144 9.45814 14.1144 9.64501V9.66757C14.1144 9.85444 14.2498 10.0151 14.4346 10.0429C14.7234 10.086 15.1443 10.2089 15.5209 10.5516C15.9619 10.9532 16.1121 11.4477 16.1632 11.7707C16.1926 11.9564 16.3505 12.0941 16.5382 12.0941H16.5555C16.7432 12.0941 16.9011 11.9564 16.9305 11.7707C16.9812 11.4477 17.1319 10.9532 17.5729 10.5516C17.9494 10.2085 18.3703 10.086 18.6591 10.0429C18.8436 10.0151 18.9793 9.85444 18.9793 9.66757V9.64501C18.9793 9.45814 18.844 9.29744 18.6591 9.26965C18.3703 9.22655 17.9494 9.10371 17.5729 8.76097Z" fill="#F6D165" class="wp-dark-mode-ignore"/></svg>',
				],
			];

			return $svg_icons;
		}
	}
}
