<?php
add_action( 'init', 'init_cpt_case_studies' );
function init_cpt_case_studies() {
	$labels = array(
		'name'               => _x( 'Case Studies', 'post type general name', 'twentytwelve' ),
		'singular_name'      => _x( 'Case Study', 'post type singular name', 'twentytwelve' ),
		'menu_name'          => _x( 'Case Studies', 'admin menu', 'twentytwelve' ),
		'name_admin_bar'     => _x( 'Case Study', 'add new on admin bar', 'twentytwelve' ),
		'add_new'            => _x( 'Add New', 'Case Studies', 'twentytwelve' ),
		'add_new_item'       => __( 'Add New Case Study', 'twentytwelve' ),
		'new_item'           => __( 'New Case Study', 'twentytwelve' ),
		'edit_item'          => __( 'Edit Case Study', 'twentytwelve' ),
		'view_item'          => __( 'View Case Study', 'twentytwelve' ),
		'all_items'          => __( 'All Case Studies', 'twentytwelve' ),
		'search_items'       => __( 'Search Case Studies', 'twentytwelve' ),
		'parent_item_colon'  => __( 'Parent Case Studies:', 'twentytwelve' ),
		'not_found'          => __( 'No case studies found.', 'twentytwelve' ),
		'not_found_in_trash' => __( 'No case study in Trash.', 'twentytwelve' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'twentytwelve' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'case-study' ),
		'capability_type'    => 'post',
		// 'has_archive'        => 'case-studies',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array(
			'title',
			'editor',
			// 'author',
			 'thumbnail',
			 'excerpt',
			// 'comments'
		)
	);
	register_post_type( 'case-study', $args );
    
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'case-study-category' ),
	);
	register_taxonomy( 'case-study-category', 'case-study', $args );
}