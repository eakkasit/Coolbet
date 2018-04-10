<?php
/*
Plugin Name: Video TV Slide
Plugin URI: http://www.totoit.co.th/
Description: Video Slide Tv Frame
Version: 0.1
Author: Eakkasit Kamwong
Author URI: http://www.totoit.co.th/
License: Copyright 2018 Totoit Ltd, All Rights Reserved
*/

define('VIDEO_TV_SLIDE_VERSION', '0.1');
define('VIDEO_TV_SLIDE_URL', plugin_dir_url( __FILE__ ));
define('VIDEO_TV_SLIDE_PATH', plugin_dir_path( __FILE__ ));
define('VIDEO_TV_SLIDE_PLUGIN', basename(dirname(__FILE__)) . '/' . basename(__FILE__));
define('VIDEO_TV_SLIDE_PLUGIN_VERSION', '0.1');

require_once 'app/class-video-tv-slide-controller.php';

class Video_TV_Slide_Plugin {
	
	function __construct() {
	
		$this->init();
	}
	
	public function init() {
		
		// init controller
		$this->video_tv_slide_controller = new Video_TV_Slide_Controller();
		
		add_action( 'admin_menu', array($this, 'register_menu') );
		
		add_shortcode( 'video_tv_slide', array($this, 'shortcode_handler') );
		
		add_action( 'init', array($this, 'register_script') );
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script') );
		
		if ( is_admin() )
		{
			add_action( 'wp_ajax_video_tv_slide_save_config', array($this, 'wp_ajax_save_item') );
			add_action( 'wp_ajax_video_tv_slide_list_folder', array($this, 'wp_ajax_list_folder') );
			add_action( 'admin_init', array($this, 'admin_init_hook') );
			add_action( 'admin_post_video_tv_slide_export', array($this, 'export_gallery') );
		}
		
		$supportwidget = get_option( 'video_tv_slide_supportwidget', 1 );
		if ( $supportwidget == 1 )
		{
			add_filter('widget_text', 'do_shortcode');
		}
	}
	
	function register_menu()
	{
		$settings = $this->get_settings();
		$userrole = $settings['userrole'];
		
		$menu = add_menu_page(
				__('VideoTVSlide', 'video_tv_slide'),
				__('VideoTVSlide', 'video_tv_slide'),
				$userrole,
				'video_tv_slide_overview',
				array($this, 'show_overview'),
				VIDEO_TV_SLIDE_URL . 'images/logo-16.png' );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'video_tv_slide_overview',
				__('Overview', 'video_tv_slide'),
				__('Overview', 'video_tv_slide'),
				$userrole,
				'video_tv_slide_overview',
				array($this, 'show_overview' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'video_tv_slide_overview',
				__('New Gallery', 'video_tv_slide'),
				__('New Gallery', 'video_tv_slide'),
				$userrole,
				'video_tv_slide_add_new',
				array($this, 'add_new' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'video_tv_slide_overview',
				__('Manage Galleries', 'video_tv_slide'),
				__('Manage Galleries', 'video_tv_slide'),
				$userrole,
				'video_tv_slide_show_items',
				array($this, 'show_items' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
	
		$menu = add_submenu_page(
				'video_tv_slide_overview',
				__('Import/Export', 'video_tv_slide'),
				__('Import/Export', 'video_tv_slide'),
				'manage_options',
				'video_tv_slide_import_export',
				array($this, 'import_export' ) );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'video_tv_slide_overview',
				__('Settings', 'video_tv_slide'),
				__('Settings', 'video_tv_slide'),
				'manage_options',
				'video_tv_slide_edit_settings',
				array($this, 'edit_settings' ) );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		

		$menu = add_submenu_page(
				null,
				__('View Gallery', 'video_tv_slide'),
				__('View Gallery', 'video_tv_slide'),	
				$userrole,	
				'video_tv_slide_show_item',	
				array($this, 'show_item' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				null,
				__('Edit Gallery', 'video_tv_slide'),
				__('Edit Gallery', 'video_tv_slide'),
				$userrole,
				'video_tv_slide_edit_item',
				array($this, 'edit_item' ) );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
	}
	
	function register_script()
	{
		// wp_register_script('video-tv-slide-script', VIDEO_TV_SLIDE_URL . 'engine/wonderplugingallery.js', array('jquery'), VIDEO_TV_SLIDE_VERSION, false);
		wp_register_script('video-tv-slide-creator-script', VIDEO_TV_SLIDE_URL . 'app/video-tv-slide-creator.js', array('jquery'), VIDEO_TV_SLIDE_VERSION, false);
		wp_register_style('video-tv-slide-admin-style', VIDEO_TV_SLIDE_URL . 'video-tv-slide.css');
		wp_register_script('pgwslider-script', VIDEO_TV_SLIDE_URL . 'engine/pgwslider.js', array('jquery'), VIDEO_TV_SLIDE_VERSION, false);
		wp_register_style('pgwslider-style', VIDEO_TV_SLIDE_URL . 'pgwslider.css');
	}
	
	function enqueue_script()
	{
		$addjstofooter = get_option( 'video_tv_slide_addjstofooter', 0 );
		if ($addjstofooter == 1)
		{
			// wp_enqueue_script('video-tv-slide-script', false, array(), false, true);
			wp_enqueue_script('pgwslider-script', false, array(), false, true);
		}
		else
		{
			// wp_enqueue_script('video-tv-slide-script');
			wp_enqueue_script('pgwslider-script');
		}		
	}
	
	function enqueue_admin_script($hook)
	{
		wp_enqueue_script('post');
		if (function_exists("wp_enqueue_media"))
		{
			wp_enqueue_media();
		}
		else
		{
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
		}
		wp_enqueue_script('video-tv-slide-script');
		wp_enqueue_script('video-tv-slide-creator-script');
		wp_enqueue_style('video-tv-slide-admin-style');
	}

	function admin_init_hook()
	{
		$settings = $this->get_settings();
		$userrole = $settings['userrole'];
		if ( !current_user_can($userrole) )
			return;
		
		// change text of history media uploader
		if (!function_exists("wp_enqueue_media"))
		{
			global $pagenow;
			
			if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
				add_filter( 'gettext', array($this, 'replace_thickbox_text' ), 1, 3 );
			}
		}
		
		// add meta boxes
		$this->video_tv_slide_controller->add_metaboxes();
	}
	
	function replace_thickbox_text($translated_text, $text, $domain) {
		
		if ('Insert into Post' == $text) {
			$referer = strpos( wp_get_referer(), 'video-tv-slide' );
			if ( $referer != '' ) {
				return __('Insert into gallery', 'video_tv_slide' );
			}
		}
		return $translated_text;
	}
	
	function show_overview() {
		
		$this->video_tv_slide_controller->show_overview();
	}
	
	function show_items() {
		
		$this->video_tv_slide_controller->show_items();
	}
	
	function add_new() {
		
		$this->video_tv_slide_controller->add_new();
	}
	
	function show_item() {
		
		$this->video_tv_slide_controller->show_item();
	}
	
	function edit_item() {
	
		$this->video_tv_slide_controller->edit_item();
	}
	
	function edit_settings() {
		
		$this->video_tv_slide_controller->edit_settings();
	}
	
	function register() {
	
		$this->video_tv_slide_controller->register();
	}
	
	function get_settings() {
		
		return $this->video_tv_slide_controller->get_settings();
	}
	
	function shortcode_handler($atts) {
		
		if ( !isset($atts['id']) )
			return __('Please specify a gallery id', 'video_tv_slide');
		
		$attributes = array();
		
		foreach($atts as $key => $value)
		{
			$key = strtolower($key);
			if (strlen($key) > 5 && substr($key, 0, 5) === 'data-')
				$attributes[substr($key, 5)] = $value;
		}
		
		return  $this->video_tv_slide_controller->generate_body_code( $atts['id'], $attributes, false);
	}
	
	function wp_ajax_list_folder() {
		
		check_ajax_referer( 'video-tv-slide-ajaxnonce', 'nonce' );

		$settings = $this->get_settings();
		$userrole = $settings['userrole'];
		if ( !current_user_can($userrole) )
			return;
		
		$folder = get_home_path() . sanitize_text_field($_POST["foldername"]);
				
		header('Content-Type: application/json');
		echo json_encode(videotvslide_dirtoarray($folder, false));
		wp_die();
	}
	
	function wp_ajax_save_item() {
		
		check_ajax_referer( 'video-tv-slide-ajaxnonce', 'nonce' );
		
		$settings = $this->get_settings();
		$userrole = $settings['userrole'];
		if ( !current_user_can($userrole) )
			return;
		
		$jsonstripcslash = get_option( 'video_tv_slide_jsonstripcslash', 1 );
		if ($jsonstripcslash == 1)
			$json_post = trim(stripcslashes($_POST["item"]));
		else
			$json_post = trim($_POST["item"]);
		
		$items = json_decode($json_post, true);
				
		if ( empty($items) )
		{
			$json_error = "json_decode error";
			if ( function_exists('json_last_error_msg') )
				$json_error .= ' - ' . json_last_error_msg();
			else if ( function_exists('json_last_error') )
				$json_error .= 'code - ' . json_last_error();
				
			header('Content-Type: application/json');
			echo json_encode(array(
					"success" => false,
					"id" => -1,
					"message" => $json_error
			));
			wp_die();
		}
		
		foreach ($items as $key => &$value)
		{
			if ($key == 'customjs' && current_user_can('manage_options'))
				continue;
			
			if ($value === true)
				$value = "true";
			else if ($value === false)
				$value = "false";
			else if ( is_string($value) )
				$value = wp_kses_post($value);
		}
		
		if (isset($items["slides"]) && count($items["slides"]) > 0)
		{
			foreach ($items["slides"] as $key => &$slide)
			{
				foreach ($slide as $key => &$value)
				{
					if ($value === true)
						$value = "true";
					else if ($value === false)
						$value = "false";
					else if ( is_string($value) )
						$value = wp_kses_post($value);
				}
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($this->video_tv_slide_controller->save_item($items));
		wp_die();
	}
	
	function import_export() {
	
		$this->video_tv_slide_controller->import_export();
	}
	
	function export_gallery() {
	
		check_admin_referer('video-tv-slide', 'video-tv-slide-export');
	
		if ( !current_user_can('manage_options') )
			return;
	
		$this->video_tv_slide_controller->export_gallery();
	}
}

/**
 * Init the plugin
 */
$video_tv_slide_plugin = new Video_TV_Slide_Plugin();

/**
 * Uninstallation
 */
function video_tv_slide_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) )
		return;
	
	global $wpdb;
	
	$keepdata = get_option( 'video_tv_slide_keepdata', 1 );
	if ( $keepdata == 0 )
	{
		$table_name = $wpdb->prefix . "video_tv_slide";
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}
}

if ( function_exists('register_uninstall_hook') )
{
	register_uninstall_hook( __FILE__, 'video_tv_slide_uninstall' );
}

define('VIDEO_TV_SLIDE_VERSION_TYPE', 'F');
