<?php
/**
 * Add Base JS
 */


function add_socials_fb_options($fields) {
    $fields[]=array (
      'id' 	=> 'instagram',
      'type' 	=> 'text',
      'title' => 'instagram',
    );
	return $fields;
}
add_filter('fbcmsv2_redux_hotel_field_group_social' , 'add_socials_fb_options');

if ( ! function_exists( 'studio2let_get_websdk_locale' ) ) {
	function studio2let_get_websdk_locale() {
		switch ( ICL_LANGUAGE_CODE ) {
			case 'vi':
				return 'vi_VN';
			case 'cn':
			case 'zh-hans':
				return 'zh_CN';
			case 'ja':
			case 'jp':
				return 'ja_JP';
			case 'zh-hant':
			case 'tw':
				return 'zh_HK';
			default:
				return 'en_GB';
		}
	}
}

if ( ! function_exists( 'studio2let_get_websdk_currency' ) ) {
	function studio2let_get_websdk_currency() {
		switch ( ICL_LANGUAGE_CODE ) {
			case 'vi':
				return 'VND';
			case 'zh-hans':
			case 'cn':
				return 'RMB';
			case 'ja':
			case 'jp':
				return 'YEN';
			case 'zh-hant':
			case 'tw':
				return 'TWD';
			default:
				return 'USD';
		}
	}
}
