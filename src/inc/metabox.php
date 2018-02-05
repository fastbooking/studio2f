<?php
/**
 * Registering meta boxes
 */
 
global $meta_boxes;	

add_filter( 'rwmb_meta_boxes', 'register_meta_boxes' );
function admin_post_id(){
    if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
        return get_the_ID();
    }
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        return false;
    }
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    } else {
        $post_id = false;
    }
    $post_id = (int) $post_id;
    return $post_id;
}
function register_meta_boxes( $meta_boxes ){
	// Homepage
	$postID = admin_post_id();

	$hotels_args = array(	
		'post_status'      => 'publish',
		'posts_per_page'   => -1,
		'orderby'          => 'title',
		'order'            => 'asc',
		'post_type'        => 'hotel_post',
		'suppress_filters' => false,
	);
	$get_hotels = get_posts($hotels_args);
	$hotelslist = array();
	if(!empty($get_hotels)) {
		foreach($get_hotels as $k => $hotel) {
			$hotel_hid = get_post_meta($hotel->ID, 'hotel_fb_hid', true);
			$hotelslist[$hotel_hid]= get_the_title($hotel->ID);
		}
	}
	$post_template = get_post_meta( $postID, '_wp_page_template', true );
	if ( rojak_str_contains( $post_template, 'tpl-home.php' ) ) {
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
			'id' => 'push_offers',
			'title' =>  __( 'Push Offers' , TEMPLATE_PREFIX) ,
			'post_types' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'push_offer',
					'type' => 'group',
					'clone'  => true,
					'sort_clone' => true,
					'name'  => '<b>' . __( 'Offers', TEMPLATE_PREFIX ) . '</b>',
					'fields' => array(
						array(
							'id'          => 'push_offers_hotel',
							'name'        => __('Hotel offer is coming from', TEMPLATE_PREFIX ),
							'placeholder' => __( 'Select an hotel', TEMPLATE_PREFIX ),
							'type'        => 'select_advanced',
							'options'     => (!empty($hotelslist) ? $hotelslist : array()),
							'select_all_none' => true,	
						),
						array(
							'id'          => 'push_offers_code',
							'name'        => __('Offer code',TEMPLATE_PREFIX),
							'placeholder' => __( 'Enter the code of the offer', TEMPLATE_PREFIX ),
							'type'        => 'text',
						)
					),
				)
			)		
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
		$meta_boxes[] = array(
			'title'  => __('Thank you message',TEMPLATE_PREFIX),
			'post_types' => array('page'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
				array(
					'name' => __('Message',TEMPLATE_PREFIX),
					'id'   => 'contact_message',
					'type' => 'wysiwyg',
					'desc' => __('thanks for contacting us! We will get back to you soon!',TEMPLATE_PREFIX)
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
				'id'            => 'hotel_url',
				'name'          => __('Hotel url',TEMPLATE_PREFIX),
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
				'id'            => 'hotel_instagram',
				'name'          => __('Hotel Instagram',TEMPLATE_PREFIX),
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

if ( ! function_exists( 'get_offers_of_all_hotels' ) ) {
    function get_offers_of_all_hotels() {
        $list_hotel = get_posts(array(
            'post_status'      => 'publish',
            'post_type'        => 'hotel_post',
        ));
        $hids = '';
        foreach ($list_hotel as $hotel) {
            $hids .= get_post_meta($hotel->ID, 'hotel_fb_hid', true).',';
        }
        $locale = studio2let_get_websdk_locale();
        $currency = studio2let_get_websdk_currency();
        $websdk_config = array(
            'output'    => 'json',
            'hids'      => rtrim($hids, ','),
            'locale'    => $locale,
            'currency'  => $currency,
            '_authCode' => STUDIO_WEBSDK_TOKEN
        );
        $response = wp_remote_get('http://websdk.fastbooking-cloud.ch/groupOffers?'.http_build_query($websdk_config));
        $data = json_decode( wp_remote_retrieve_body($response))->data;
        $rates = array();
        foreach ($data as $k => $item) {
        	$hoteltitle = $item->prop->title;
        	$ofrate = $item->rates;
            foreach ($ofrate as $j => $rate) {
           		$rate->hotel = $hoteltitle;	
            }   
            $rates = array_merge($rates, $ofrate);
           
        }
        return $rates;
    }
    return false;
}
