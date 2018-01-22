<?php
/**
 * Registering meta boxes
 */
 
global $meta_boxes;	

add_filter( 'rwmb_meta_boxes', 'register_meta_boxes' );
function register_meta_boxes( $meta_boxes ){
	// Homepage
	$postID = admin_post_id();
	$post_template = get_post_meta( $postID, '_wp_page_template', true );
	if (is_numeric( $postID )) {
		$meta_boxes[] = array(
			'title'  => __( 'Section Intro',TEMPLATE_PREFIX),
			'post_types' => array('page'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
				array(
					'name' => __('Title',TEMPLATE_PREFIX),
					'id'   => 'intro_title',
					'type' => 'text',
					'desc' => __('Welcome to Studio 2 let',TEMPLATE_PREFIX),
				)
			),
		);

		$meta_boxes[] = array(
			'title'  => __( 'Section Services',TEMPLATE_PREFIX ),
			'post_types' => array('page'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
				array(
					'name' => __('Service title',TEMPLATE_PREFIX),
					'id'   => 'ser_title',
					'type' => 'text',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX),
				),
				array(
					'name' => __('Service mid content',TEMPLATE_PREFIX),
					'id'   => 'ser_mid_content',
					'type' => 'wysiwyg',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX),
				),
				array(
					'name' => __('Service content',TEMPLATE_PREFIX),
					'id'   => 'ser_content',
					'type' => 'wysiwyg',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX)
				)
			),
		);

		$meta_boxes[] = array(
			'title'  => __('Coropate Client',TEMPLATE_PREFIX),
			'post_types' => array('page'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
				array(
					'name' => __('Coropate title',TEMPLATE_PREFIX),
					'id'   => 'cor_title',
					'type' => 'text',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX)
				),
				array(
					'name' => __('Coropate mid content',TEMPLATE_PREFIX),
					'id'   => 'cor_mid_content',
					'type' => 'wysiwyg',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX)
				),
				array(
					'name' => __('Coropate content',TEMPLATE_PREFIX),
					'id'   => 'cor_content',
					'type' => 'wysiwyg',
					'desc' => __('Lorem ipsum Lorem ipsum',TEMPLATE_PREFIX),
				)
			),
		);

	}

	$meta_boxes[] = array(
		'id' => 'hotel',
		'title' =>  __('Hotel Information',TEMPLATE_PREFIX),
		'pages' => array( 'hotel_post' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id'            => 'hotel_fb_hid',
				'name'          => __('Hotel FB HID',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=> true
			),
			array(
				'id'            => 'hotel_fb_connectname',
				'name'          => __('Hotel FB Connectname',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=> true
			),
			array(
				'id'            => 'hotel_address',
				'name'          => __('Hotel Address',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=>	true
			),
			array(
				'id'            => 'hotel_latlng',
				'name'          => __('Hotel LatLng',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=>	true
			),
			array(
				'id'            => 'hotel_map_zoom',
				'name'          => __('Hotel Map Zoom?',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_phone',
				'name'          => __('Hotel Phone',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=>	true
			),
			array(
				'id'            => 'hotel_fax',
				'name'          => __('Hotel Fax',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_email',
				'name'          => __('Hotel Email',TEMPLATE_PREFIX),
				'type'          => 'text',
				'required'		=>	true
			),
			array(
				'id'            => 'hotel_receiving_email',
				'name'          => __('Hotel Receiving Email',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_facebook',
				'name'          => __('Hotel Facebook',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_google_plus',
				'name'          => __('Hotel Google Plus',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_twitter',
				'name'          => __('Hotel Twitter',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_pinterest',
				'name'          => __('Hotel Pinterest',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'id'            => 'hotel_youtube',
				'name'          => __('Hotel Youtube',TEMPLATE_PREFIX),
				'type'          => 'text'
			),
			array(
				'name' => __('Hotel Feature',TEMPLATE_PREFIX),
				'id'   => 'hotel_feature',
				'type' => 'checkbox'
			),

		)
	);


	return $meta_boxes;
}


// if ( ! function_exists( 'unique_multidim_array' ) ) {
// 	function unique_multidim_array($array, $key) { 
// 		$temp_array = array(); 
// 		$i = 0; 
// 		$key_array = array(); 
		
// 		foreach($array as $val) { 
// 			if (!in_array($val[$key], $key_array)) { 
// 				$key_array[$i] = $val[$key]; 
// 				$temp_array[$i] = $val; 
// 			} 
// 			$i++; 
// 		} 
// 		return $temp_array; 
// 	}
// }

// if ( ! function_exists( 'get_offers_of_all_hotels' ) ) {
// 	function get_offers_of_all_hotels() {
// 		$list_hotel = get_posts(array(
// 			'post_status'      => 'publish',
// 			'post_type'        => 'hotel_post',
// 		));
// 		if ( !empty($list_hotel) ) {
// 			$hids = '';
// 			foreach ($list_hotel as $hotel) {
// 				$hids .= get_post_meta($hotel->ID, 'hotel_fb_hid', true).',';
// 			}
// 			$locale = get_websdk_locale();
// 			$currency = get_websdk_currency(); 
// 			$response = wp_remote_get('http://websdk.fastbooking-cloud.ch/groupOffers',
// 				array(
// 					'headers'     => array(
// 						'Content-Type' => 'application/json; charset=utf-8'
// 					),
// 					'body'        => array(
// 						'hids'		=> rtrim($hids, ','),
// 						'currency'	=> $currency,
// 						'locale'	=> $locale,
// 						'output'	=> 'json',
// 						'orderBy'	=> 'pricePerNight',
// 						'_authCode'	=> WEBSDK_TOKEN
// 					),
// 				)
// 			);
// 			$data = json_decode( wp_remote_retrieve_body($response))->data;
// 			$rates = array();
// 			var_dump($data);
// 			die();
// 			foreach ($data as $item) {
// 				$rates = array_merge($rates, $item->rates);

// 			}
// 			return $rates;
// 		}
// 		return false;
// 	}
// }