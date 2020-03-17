<?php
// Register Custom Post Type
function destination() {

	$labels = array(
		'name'                  => _x( 'Destinations', 'Post Type General Name', 'visachild' ),
		'singular_name'         => _x( 'Destination', 'Post Type Singular Name', 'visachild' ),
		'menu_name'             => __( 'Destination', 'visachild' ),
		'name_admin_bar'        => __( 'Destination', 'visachild' ),
		'archives'              => __( 'Item Archives', 'visachild' ),
		'attributes'            => __( 'Item Attributes', 'visachild' ),
		'parent_item_colon'     => __( 'Parent Item:', 'visachild' ),
		'all_items'             => __( 'All Items', 'visachild' ),
		'add_new_item'          => __( 'Add New Item', 'visachild' ),
		'add_new'               => __( 'Add New', 'visachild' ),
		'new_item'              => __( 'New Item', 'visachild' ),
		'edit_item'             => __( 'Edit Item', 'visachild' ),
		'update_item'           => __( 'Update Item', 'visachild' ),
		'view_item'             => __( 'View Item', 'visachild' ),
		'view_items'            => __( 'View Items', 'visachild' ),
		'search_items'          => __( 'Search Item', 'visachild' ),
		'not_found'             => __( 'Not found', 'visachild' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'visachild' ),
		'featured_image'        => __( 'Featured Image', 'visachild' ),
		'set_featured_image'    => __( 'Set featured image', 'visachild' ),
		'remove_featured_image' => __( 'Remove featured image', 'visachild' ),
		'use_featured_image'    => __( 'Use as featured image', 'visachild' ),
		'insert_into_item'      => __( 'Insert into item', 'visachild' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'visachild' ),
		'items_list'            => __( 'Items list', 'visachild' ),
		'items_list_navigation' => __( 'Items list navigation', 'visachild' ),
		'filter_items_list'     => __( 'Filter items list', 'visachild' ),
	);
	$args = array(
		'label'                 => __( 'Destination', 'visachild' ),
		'description'           => __( 'Destination Description', 'visachild' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rest_base'             => 'destination',
	);
	register_post_type( 'destination', $args );

}
add_action( 'init', 'destination', 0 );