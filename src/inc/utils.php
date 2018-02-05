<?php

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


if ( ! function_exists( 'studio2let_get_qs_text' ) ) {
	function studio2let_get_qs_text() {
		$txt_defaults = array(
			'choose'        => __( 'Destination / Hotels', 'studio2let' ),
			'submit'        => __( 'Book today', 'studio2let' ),
			'cancel'        => __( 'Cancel Booking', 'studio2let' ),
			'promo'  		=> __( 'Promo Code', 'studio2let' ),
			'arrival'       => __( 'Arrival', 'studio2let' ),
			'departure'     => __( 'Departure', 'studio2let'),
		);

		$txt_filter = apply_filters( 'studio2let_text_qs', false );
		return wp_parse_args( $txt_filter, $txt_defaults );
	}
}