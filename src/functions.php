<?php
/**
 * fbtheme functions and definitions
 *
 * @package fbtheme
 */

// Launch the Rojak framework.
require_once( trailingslashit( get_template_directory() ) . 'library/rojak.php' );
new Rojak();

define('TEMPLATE_PREFIX', 'studio2let');
define('WEBSDK_TOKEN', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZXMiOiJeLiokIiwicHJvcGVydGllcyI6InVrbG9uMjQ5NzQiLCJncm91cHMiOiJeKHVrbG9uMjAzODl8dWtsb24yNDk3NCkkIiwiZm9yIjoib2ZmZXJzIiwiaWF0IjoxNTE2NzkxMDk4LCJqdGkiOiJiYmM5NGJlZC1jZDg1LTQzNjMtYTVlNC1lYTJkMTQ0MzA2ZmQifQ.Cw1moquROuUWNbZqsy46E9mGaJ41ah2Pwfd-jl79l68');

function add_socials_fb_options($fields) {
    $fields[]=array (
      'id' 	=> 'instagram',
      'type' 	=> 'text',
      'title' => 'instagram',
    );
	return $fields;
}
add_filter('fbcmsv2_redux_hotel_field_group_social' , 'add_socials_fb_options');

add_action( 'after_setup_theme', 'fbtheme_setup' );

if ( ! function_exists( 'fbtheme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fbtheme_setup() {

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
		 * If you're building a theme based on fbtheme, use a find and replace
		 * to change 'fbtheme' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'fbtheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
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


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		// add_theme_support( 'html5', array(
		// 	'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		// ) );

		/*
		 * Enable support for Post Formats.
		 * See https://codex.wordpress.org/Post_Formats
		 */
		// add_theme_support( 'post-formats', array(
		// 	'aside', 'image', 'video', 'quote', 'link',
		// ) );

		// Set up the WordPress core custom background feature.
		// add_theme_support( 'custom-background', apply_filters( 'fbtheme_custom_background_args', array(
		// 	'default-color' => 'ffffff',
		// 	'default-image' => '',
		// ) ) );

		/*
		 * Enable excerpt on Pages
		 */
		add_post_type_support('page', 'excerpt');
	}
}; // fbtheme_setup


/**
 * Remove post in admin
 */
if ( ! function_exists( 'fbtheme_admin_remove_menu' ) ) {
	function fbtheme_admin_remove_menu() {
		remove_menu_page( 'edit.php' );
	}
}
add_action( 'admin_menu', 'fbtheme_admin_remove_menu' );


/**
 * Add SVG
 */
if (!function_exists('fbtheme_cc_mime_types')) {
	function fbtheme_cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
add_filter('upload_mimes', 'fbtheme_cc_mime_types');

/**
 * Disable emoji feature introduced in Wordpresss 4.2
 */
if (!function_exists('fbtheme_disable_emojicons_tinymce')) {
	function fbtheme_disable_emojicons_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}

if (!function_exists('fbtheme_disable_wp_emojicons')) {
	function fbtheme_disable_wp_emojicons() {

		// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis
		add_filter( 'tiny_mce_plugins', 'fbtheme_disable_emojicons_tinymce' );
	}
}
add_action( 'init', 'fbtheme_disable_wp_emojicons' );


/**
 * Disable Admin Bar
 */
if (!function_exists('fbtheme_admin_bar')) {
	function fbtheme_admin_bar() {
		add_filter('show_admin_bar', '__return_false');
	}
}
// add_action( 'init', 'fbtheme_admin_bar' );


/**
 * WPML Remove CSS and JS
 *
 * @link notboring.org/devblog/2012/08/how-to-remove-the-embedded-sitepress-multilingual-cmsrescsslanguage-selector-css-from-your-own-wordpress-templates-on-wpml-installations/
 */
if ( ! function_exists( 'fbtheme_wpml_dont_load' ) ) {
	function fbtheme_wpml_dont_load() {
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
		define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
		define('ICL_DONT_LOAD_LANGUAGES_JS', true);
	}
}
add_action( 'init', 'fbtheme_wpml_dont_load' );

/**
 * Load string translations
 */
if ( ! function_exists( 'fbtheme_load_textdomain' ) ) {
	function fbtheme_load_textdomain()  {
		global $sitepress;
		$locale='en_US';
		if ( $sitepress ) {
			$locale = $sitepress->get_locale(ICL_LANGUAGE_CODE);
		}
		$child_mo = ROJAK_CHILD . 'languages/' . $locale . '.mo';
		if ( file_exists( $child_mo ) ) {
			load_theme_textdomain( 'fbtheme', ROJAK_CHILD . 'languages/');
		} else {
			load_theme_textdomain( 'fbtheme', ROJAK_PARENT . 'languages/');
		}
	}
}
add_action('after_setup_theme', 'fbtheme_load_textdomain');


/**
 * Weather js using yahoo API
 */
if ( ! function_exists( 'fbtheme_yahoo_weather' ) ) {
	function fbtheme_yahoo_weather() {
		$weather_js =  'js/FB-weather' .$GLOBALS['rojak_templates_minify']. '.js';
		if ( file_exists( ROJAK_PARENT . $weather_js ) ) {
			wp_enqueue_script( 'rojak-weather', ROJAK_PARENT_URI . $weather_js, array(), '', true );
		}
	}
}
add_action( 'rojak_tpl_after_core_js', 'fbtheme_yahoo_weather' );

/**
 * Image sizes
 */
if (!function_exists('fbtheme_image_sizes')) {
	function fbtheme_image_sizes() {

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
add_action( 'init', 'fbtheme_image_sizes' );

/**
 * Add Map JS
 */
if ( ! function_exists( 'ing_enqueue_map_js' ) ) {
	function ing_enqueue_map_js() {
		wp_register_script( 'google-map', "//maps.googleapis.com/maps/api/js?key=AIzaSyAp16-BNgTll5F3xOW6fuClAbjP0qe4pQo&amp;callback=initMap", array(), '', true );
		wp_enqueue_script(  'google-map' );
	}
}
add_action( 'rojak_tpl_after_page_js', 'ing_enqueue_map_js' );

require_once get_template_directory() . '/inc/faw-assets.php';
// // /**
// //  * tpl-assets functions
// //  */
// // require_once get_template_directory() . '/inc/fbtheme-assets.php';

// /**
//  * on save functions
//  * these will generate json or html files
//  */
// require_once get_template_directory() . '/inc/save-menu.php';
// // require_once get_template_directory() . '/inc/save-post-hotel.php';
// // require_once get_template_directory() . '/inc/save-post-country.php';
// // require_once get_template_directory() . '/inc/save-post-tpl-home.php';
// // require_once get_template_directory() . '/inc/save-post-tpl-global-offers.php';

// /**
//  * Custom Post hotel
//  */
require_once get_template_directory() . '/inc/custom-post-hotel.php';

// /**
//  * wp_footer hooks
//  */
// require_once get_template_directory() . '/inc/functions-wp-footer.php';

// /**
//  * wp_seo hooks
//  */
// require_once get_template_directory() . '/inc/functions-wp-seo.php';

// /**
//  * Structured Data for Search Engines
//  */
// require_once get_template_directory() . '/inc/functions-structured-data.php';

// *
//  * santika-admin

// require_once get_template_directory() . '/inc/fbtheme-admin.php';

// /**
//  * Load Ixternal Classes
//  */
// require_once get_template_directory() . '/inc/class-fbtheme-walker-footer-nav-five.php';
// require_once get_template_directory() . '/inc/class-fbtheme-walker-footer-legal.php';

// /**
//  * Load External Classes
//  */
// require_once get_template_directory() . '/inc/class-mobile-detect.php';

// /**
//  * Load shortcodes
//  */
// require_once get_template_directory() . '/inc/fbtheme-shortcodes.php';

// /**
//  * Load Breadcrumb function
//  */
// require_once get_template_directory() . '/inc/fbtheme-breadcrumb.php';

// /**
//  * Metabox
//  */
require_once get_template_directory() . '/inc/fbtheme-metabox.php';
require_once get_template_directory() . '/inc/ngz-utilities.php';
// /**
//  * Soap
//  */
// require_once get_template_directory() . '/inc/fbtheme-soap.php';

// /**
//  * TrustYou
//  */
// require_once get_template_directory() . '/inc/fbtheme-trustyou.php';

// /**
//  * Viator API
//  */
// require_once get_template_directory() . '/inc/fbtheme-viator.php';