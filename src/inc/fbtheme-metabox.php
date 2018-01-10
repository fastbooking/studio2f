<?php
/**
 * Registering meta boxes
 */
 
global $meta_boxes;	

add_filter( 'rwmb_meta_boxes', 'register_meta_boxes' );
function register_meta_boxes( $meta_boxes ){
	// Homepage
	$meta_boxes[] = array(
		'title'  => __( 'Section Intro'),
		'post_types' => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => 'Title',
				'id'   => 'intro_title',
				'type' => 'text',
				'desc' => 'Welcome to Studio 2 let'
			),
			array(
				'name' => 'Intro mid content',
				'id'   => 'intro_mid_content',
				'type' => 'wysiwyg',
				'desc' => 'Lorem ipsum Lorem ipsum'
			),
			array(
				'name' => 'Intro content',
				'id'   => 'intro_content',
				'type' => 'wysiwyg',
				'desc' => 'Lorem ipsum Lorem ipsum'
			)
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'Section Services'),
		'post_types' => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => 'Service title',
				'id'   => 'service_title',
				'type' => 'text',
				'desc' => 'Lorem ipsum Lorem ipsum'
			),
			array(
				'name' => 'Service mid content',
				'id'   => 'service_mid_content',
				'type' => 'wysiwyg',
				'desc' => 'Lorem ipsum Lorem ipsum'
			),
			array(
				'name' => 'Service content',
				'id'   => 'service_content',
				'type' => 'wysiwyg',
				'desc' => 'Lorem ipsum Lorem ipsum'
			)
		),
	);
	return $meta_boxes;
}
