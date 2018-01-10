<?php

function rojak_get_json_dir() {
	$theme_name = get_template();
	$json_dir   = trailingslashit( "$theme_name-json" );
	return $json_dir;
}

function rojak_get_json_root_dir() {
	$json_dir    = trailingslashit( WP_CONTENT_DIR );
	$json_dir   .= rojak_get_json_dir();
	return $json_dir;
}


function rojak_get_json_upload_dir() {
	$uploads  = wp_upload_dir();
	$json_dir = trailingslashit( $uploads['basedir'] ) . rojak_get_json_dir();

	if ( ! file_exists( $json_dir ) ) {
		mkdir( $json_dir, 0755, true );
	}

	return $json_dir;
}

function rojak_get_json_site_dir( $custom_dir_name = null ) {
	$current_site_id = get_current_blog_id();

	// set default json dir as theme name
	$json_dir   = rojak_get_json_dir();

	// if $theme_name is not the intended directory
	$json_dir = apply_filters( 'rojak_json_dir', $json_dir );

	$json_path  = $json_dir . $current_site_id;
	if ( ! empty( $custom_dir_name ) ) {
		$json_path .= '-' . $custom_dir_name;
	}

	$json_dir  = trailingslashit( WP_CONTENT_DIR );
	$json_dir .= trailingslashit( $json_path );

	if ( ! file_exists( $json_dir ) ) {
		mkdir( $json_dir, 0755, true );
	}

	return $json_dir;
}


function rojak_write_to_file( $file_path, $data = '' ) {
	$fp = fopen( $file_path, 'w');
	fwrite($fp, $data);
	fclose($fp);
}