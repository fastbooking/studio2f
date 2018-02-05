<?php
function comment_post_type() {
	$args = array(
		'labels' => array(
			'name'          => __( 'Hotels', 'studio2let' ),
			'singular_name' => __( 'Hotel', 'studio2let' ),
			'add_new'  => __( 'New Hotel', 'studio2let' ),
			'add_new_item'  => __( 'Add New Hotel', 'studio2let' ),
			'edit_item'     => __( 'Edit Hotel', 'studio2let' ),
			'view_item'     => __( 'View Hotel', 'studio2let' )
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
