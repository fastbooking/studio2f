<?php
/**
 * studio2let functions and definitions
 *
 * @package studio2let
 */

// Launch the Rojak framework.
require_once( trailingslashit( get_template_directory() ) . 'library/rojak.php' );
new Rojak();

define('STUDIO_WEBSDK_TOKEN', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZXMiOiJeLiokIiwicHJvcGVydGllcyI6Il4odWtsb24yMDM4OXx1a2xvbjI0OTc0KSQiLCJncm91cHMiOiJeJCIsImZvciI6Imdlbi11c2VyIiwiaWF0IjoxNTE2OTUyNTQ4LCJqdGkiOiI3ZWE5Mzc1Mi1hN2IzLTQwNDMtYjQ5ZC02Yzk0MDI1YzNjODAifQ.a6MtEKYPriJ45uWGzMT_o5hAGNeb3UruZyM6OfGEyuw');

add_action( 'after_setup_theme', 'studio2let_setup' );

if ( ! function_exists( 'studio2let_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function studio2let_setup() {

		add_theme_support( 'rojak-templates' );

		add_theme_support( 'rojak-assets-async' );

		// remove not working
		// add_theme_support( 'rojak-assets-timestamp' );

		// Running gulp --prod will uncomment below
		//--DEV--add_theme_support( 'rojak-templates-minify' );

		// Automatically add <title> to head.
		add_theme_support( 'title-tag' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on studio2let, use a find and replace
		 * to change 'studio2let' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'studio2let', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => 'Primary Menu',
		) );

		register_nav_menus( array(
			'utility' => 'Utility Menu',
		) );

		register_nav_menus( array(
			'footer-nav-one' => 'Footer Nav One',
		) );

		register_nav_menus( array(
			'footer-legal' => 'Footer Legal',
		) );

		add_post_type_support('page', 'excerpt');
	}
}; // studio2let_setup


/**
 * Remove post in admin
 */
if ( ! function_exists( 'studio2let_admin_remove_menu' ) ) {
	function studio2let_admin_remove_menu() {
		remove_menu_page( 'edit.php' );
	}
}
add_action( 'admin_menu', 'studio2let_admin_remove_menu' );


/**
 * Add SVG
 */
if (!function_exists('studio2let_cc_mime_types')) {
	function studio2let_cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
add_filter('upload_mimes', 'studio2let_cc_mime_types');

/**
 * Disable emoji feature introduced in Wordpresss 4.2
 */
if (!function_exists('studio2let_disable_emojicons_tinymce')) {
	function studio2let_disable_emojicons_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}

if (!function_exists('studio2let_disable_wp_emojicons')) {
	function studio2let_disable_wp_emojicons() {

		// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis
		add_filter( 'tiny_mce_plugins', 'studio2let_disable_emojicons_tinymce' );
	}
}
add_action( 'init', 'studio2let_disable_wp_emojicons' );


/**
 * Disable Admin Bar
 */
if (!function_exists('studio2let_admin_bar')) {
	function studio2let_admin_bar() {
		add_filter('show_admin_bar', '__return_false');
	}
}
// add_action( 'init', 'studio2let_admin_bar' );


/**
 * WPML Remove CSS and JS
 *
 * @link notboring.org/devblog/2012/08/how-to-remove-the-embedded-sitepress-multilingual-cmsrescsslanguage-selector-css-from-your-own-wordpress-templates-on-wpml-installations/
 */
if ( ! function_exists( 'studio2let_wpml_dont_load' ) ) {
	function studio2let_wpml_dont_load() {
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
		define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
		define('ICL_DONT_LOAD_LANGUAGES_JS', true);
	}
}
add_action( 'init', 'studio2let_wpml_dont_load' );

/**
 * Load string translations
 */
if ( ! function_exists( 'studio2let_load_textdomain' ) ) {
	function studio2let_load_textdomain()  {
		global $sitepress;
		$locale='en_US';
		if ( $sitepress ) {
			$locale = $sitepress->get_locale(ICL_LANGUAGE_CODE);
		}
		$child_mo = ROJAK_CHILD . 'languages/' . $locale . '.mo';
		if ( file_exists( $child_mo ) ) {
			load_theme_textdomain( 'studio2let', ROJAK_CHILD . 'languages/');
		} else {
			load_theme_textdomain( 'studio2let', ROJAK_PARENT . 'languages/');
		}
	}
}
add_action('after_setup_theme', 'studio2let_load_textdomain');

/**
 * Image sizes
 */
if (!function_exists('studio2let_image_sizes')) {
	function studio2let_image_sizes() {

		// add_image_size( 'size-name', 220, 180, true );
		// 220 pixels wide by 180 pixels tall, crop image

		add_image_size( 'small',               '80',   '80',   true );
		add_image_size( 'slider',              '1600', '800',  true );
		add_image_size( 'slider-uncrop',       '1600', '800',  false );
		add_image_size( 'slider-medium',       '960',  '480',  true );
		add_image_size( 'slider-thumb',        '160',  '80',   true );
		add_image_size( 'slider-tablet',       '1024', '512',  true );
		add_image_size( 'slider-mobile',       '600',  '300',  true );

		add_image_size( 'subpage-popup-2-thumb',  '310',  '320', true  );
		add_image_size( 'subpage-popup-2-medium', '600',  '560', false );

		add_image_size( 'global-offers',       '800',  '470',  true );
		add_image_size( 'global-offers-mobile','400',  '235',  true );
		add_image_size( 'brand-offers',        '400',  '265',  true );

	}
}
add_action( 'init', 'studio2let_image_sizes' );

/**
 * Add Map JS
 */
if ( ! function_exists( 'studio2let_enqueue_map_js' ) ) {
	function studio2let_enqueue_map_js() {
		wp_register_script( 'google-map', "//maps.googleapis.com/maps/api/js?key=AIzaSyAp16-BNgTll5F3xOW6fuClAbjP0qe4pQo", array(), '', true );
		wp_enqueue_script(  'google-map' );
	}
}
add_action( 'rojak_tpl_after_page_js', 'studio2let_enqueue_map_js' );
// /**
//  * Custom Post hotel
//  */
require_once get_template_directory() . '/inc/custom-post-hotel.php';

// /**
//  * Metabox
//  */
require_once get_template_directory() . '/inc/metabox.php';
require_once get_template_directory() . '/inc/utils.php';