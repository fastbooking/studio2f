<?php
function comment_post_type() {
	$args = array(
		'labels' => array(
			'name'          => __( 'Hotels', TEMPLATE_PREFIX ),
			'singular_name' => __( 'Hotel', TEMPLATE_PREFIX ),
			'add_new'  => __( 'New Hotel', TEMPLATE_PREFIX ),
			'add_new_item'  => __( 'Add New Hotel', TEMPLATE_PREFIX ),
			'edit_item'     => __( 'Edit Hotel', TEMPLATE_PREFIX ),
			'view_item'     => __( 'View Hotel', TEMPLATE_PREFIX )
		),
		'public'      => true,
		'has_archive' => true,
		'rewrite'     => array( 'slug' => 'hotel' ),
		'supports'    => array('title', 'editor', 'thumbnail', 'page-attributes'),
		'can_export'  => true,
		'menu_icon'   => 'dashicons-store',
	);
	register_post_type( 'hotel_post', $args );
}
add_action( 'init', 'comment_post_type', 1 );