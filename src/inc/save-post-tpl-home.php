<?php


add_action( 'save_post', 'fbtheme_tplHome_OnSave' );

/**
 * Action when homepage is saved
 */
function fbtheme_tplHome_OnSave( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;

	$home_id = get_option( 'page_on_front' );
	if ( $home_id == $post_id ) {
		fbtheme_tplHome_generateJson();
	}

}

/**
 * JSON generator for all the data needed in Homepage
 */
function fbtheme_tplHome_generateJson() {

	$home_slideshow_data    = fbtheme_tplHome_slideshowData();

	$home_all_data  =  array(
		'slideshow'     => $home_slideshow_data,
	);

	$file_path = fbtheme_get_site_json_dir() . fbtheme_get_site_json_filenames( 'tpl-home' );
	fbtheme_write_to_file( $file_path, json_encode( $home_all_data ) );

}


function fbtheme_tplHome_slideshowData() {

	$home_id = get_option( 'page_on_front' );
	$attachment_slide_tag = 'slideshow';

	$current_post_has_attachments = rojak_has_page_attachments( $home_id, $attachment_slide_tag );
	$home_has_attachments = rojak_has_page_attachments( get_option('page_on_front'), $attachment_slide_tag );

	if ( $current_post_has_attachments ) {
		$attachments = rojak_get_post_attachments( $home_id );
	} else {
		$attachments = rojak_get_post_attachments( get_option('page_on_front') );
	}

	if ( $current_post_has_attachments || $home_has_attachments ) {
		$count = 0;
		$slider_data = array();
		foreach ($attachments as $attachment) {

			// check if an attachment has the bg media tag
			$term_list = wp_get_post_terms( $attachment->ID, 'media_tag', array("fields" => "all") );
			$terms = array();
			foreach ( $term_list as $term ) {
				array_push($terms, $term->slug);
			}

			if (in_array($attachment_slide_tag, $terms)) {
				$image_info   = wp_prepare_attachment_for_js( $attachment->ID );
				$image_large  = wp_get_attachment_image_src( $image_info["id"], 'slider' );
				$image_url    = $image_large[0];
				$image_width  = $image_large[1];
				$image_height = $image_large[2];
				$image_title  = $image_info[ "title" ];

				$image_alt        = $image_info["alt"];
				if ( empty( $image_alt ) ) {
					$image_alt = $image_title;
				}

				$lang_code = str_replace( '-', '_', ICL_LANGUAGE_CODE );
				$attachment_caption = rwmb_meta( "fbtheme_title_{$lang_code}", array(), $attachment->ID );
				if ( empty( $attachment_caption ) ) {
					$attachment_caption     = $image_info["caption"];
				}
				$attachment_description = rwmb_meta( "fbtheme_description_{$lang_code}", array(), $attachment->ID );
				if ( empty( $attachment_description ) ) {
					$attachment_description = $image_info["description"];
				}

				// Make sure the large image size is 1600 x 800
				if ( $image_width == 1600 && $image_height == 800 ) {
					$slider_data[$count]['ID']           = $attachment->ID;
					$slider_data[$count]['post_title']   = $attachment->post_title;
					$slider_data[$count]['post_name']    = $attachment->post_name;
					$slider_data[$count]['css']          = "slider-home__item-{$attachment->ID} slider-home__item js_slider-home__item";
					$slider_data[$count]['img']['alt']   = $image_alt;
					$slider_data[$count]['img']['large'] = fbtheme_get_img_url( 'slider', $attachment->ID );
					$slider_data[$count]['img']['thumb'] = fbtheme_get_img_url( 'slider-thumb', $attachment->ID );
					if ( empty( $slider_data[$count]['img']['thumb'] ) ) {
						$slider_data[$count]['img']['thumb'] = fbtheme_get_img_url( 'slider', $attachment->ID );
					}
					$slider_data[$count]['description'] = $attachment_description;
					$slider_data[$count]['caption'] = $attachment_caption;

					$count++;
				}
			}
		}
		return $slider_data;
	}
	return false;
}
