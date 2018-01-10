<?php

add_action( 'wp_update_nav_menu', 'fbtheme_menu_generateHTMLByID' );

/**
 * Action when a menu is saved
 */
function fbtheme_menu_generateHTMLByID( $menu_id ) {
	$menu = wp_get_nav_menu_object( $menu_id );

	$locations = get_nav_menu_locations();
	$menu_location = null;
	foreach ($locations as $key => $value) {
		if ( $menu->term_id == $value ) {
			$menu_location = $key;
			break;
		}
	}

	fbtheme_menu_generateHTMLByLocation( $menu_location );
}

/**
 * HTML generator for all the Menus
 */
function fbtheme_menu_generateHTMLByLocation( $menu_location = null ) {

	if ( empty( $menu_location ) ) {
		return;
	}

	$lang_code = ICL_LANGUAGE_CODE;
	$menu_args = array(
		'theme_location' => $menu_location,
		'menu_class'     => "menu__ul menu--{$menu_location}__ul menu__ul--{$lang_code}",
		'container_class'=> "menu-{$menu_location}-container",
		'fallback_cb'    => false,
		'echo'           => false,
	);

	

	$html = wp_nav_menu( $menu_args );

	$file_path = fbtheme_menu_getFilePath( $menu_location );
	rojak_write_to_file( $file_path, $html );
}

/**
 * Get file path
 */
function fbtheme_menu_getFilePath( $menu_location ) {
	$lang_code = ICL_LANGUAGE_CODE;
	$file_ext  = "menu-{$menu_location}-{$lang_code}.html";
	return rojak_get_json_upload_dir() . $file_ext;
}

/**
 * Display Menu
 */
function fbtheme_menu_display( $menu_location = null ) {
	if ( !empty( $menu_location ) ) {
		$html_file = fbtheme_menu_getFilePath( $menu_location );

		if ( ! is_file ( $html_file ) ) {
			fbtheme_menu_generateHTMLByLocation( $menu_location );
		}

		echo file_get_contents( $html_file );
	}
	return false;
}
