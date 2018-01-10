<?php

if ( ! function_exists( 'fbtheme_get_current_page_template' ) ) {
	function fbtheme_get_current_page_template( ) {

		if( !isset( $GLOBALS['fbtheme_current_page_template'] ) ) {
			global $post;
			$GLOBALS['fbtheme_current_page_template'] = get_post_meta( $post->ID, '_wp_page_template', true );
		}

		return $GLOBALS['fbtheme_current_page_template'];
	}
}




if ( ! function_exists( 'fbtheme_get_page_languages' ) ) {
	function fbtheme_get_page_languages() {
		$lang_data      = array();
		$lang_current   = array();
		$wpml_languages = icl_get_languages( 'skip_missing=1&orderby=code' );
		global $wp_query;
		foreach( $wpml_languages as $lang ) {
			$lang_data[$key]['code']   = $key = $lang['code'];
			$lang_data[$key]['active'] = $lang['active'];
			$lang_data[$key]['url']    = $lang['url'];

			// language name
			$lang_data[$key]['name'] = $lang['native_name'];
			if ( 'Indonesia' == $lang['native_name'] ) {
				$lang_data[$key]['name'] = 'Bahasa';
			}

			if ( 1 == $lang['active'] ) {
				$lang_current = $key;
			}
		}

		if ( rojak_empty_array( $lang_data ) ) {
			return false;
		}

		// appending $lang_current in our array
		$lang_data  = array( $lang_current => $lang_data[$lang_current] ) + $lang_data;

		return $lang_data;
	}
}
