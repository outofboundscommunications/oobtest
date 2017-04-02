<?php

add_action( 'init', 'init_cpt_testionials' );

function init_cpt_testionials() {

	$labels = array(

		'name'               => _x( 'Testimonials', 'post type general name', 'twentytwelve' ),

		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'twentytwelve' ),

		'menu_name'          => _x( 'Testimonials', 'admin menu', 'twentytwelve' ),

		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'twentytwelve' ),

		'add_new'            => _x( 'Add New', 'Testimonials', 'twentytwelve' ),

		'add_new_item'       => __( 'Add New Testimonial', 'twentytwelve' ),

		'new_item'           => __( 'New Testimonial', 'twentytwelve' ),

		'edit_item'          => __( 'Edit Testimonial', 'twentytwelve' ),

		'view_item'          => __( 'View Testimonial', 'twentytwelve' ),

		'all_items'          => __( 'All Testimonials', 'twentytwelve' ),

		'search_items'       => __( 'Search Testimonials', 'twentytwelve' ),

		'parent_item_colon'  => __( 'Parent Testimonials:', 'twentytwelve' ),

		'not_found'          => __( 'No testimonials found.', 'twentytwelve' ),

		'not_found_in_trash' => __( 'No testimonial in Trash.', 'twentytwelve' )

	);



	$args = array(

		'labels'             => $labels,

		'description'        => __( 'Description.', 'twentytwelve' ),

		'public'             => false,

		'publicly_queryable' => false,

		'show_ui'            => true,

		'show_in_menu'       => true,

		'query_var'          => true,

		'rewrite'            => array( 'slug' => 'testimonial' ),

		'capability_type'    => 'post',

		// 'has_archive'        => 'case-studies',

		'has_archive'        => false,

		'hierarchical'       => false,

		'menu_position'      => null,

		'supports'           => array(

			'title',

			'editor',

			// 'author',

			 'thumbnail',

			// 'excerpt',

			// 'comments'

		)

	);

	register_post_type( 'testimonial', $args );

    

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

		'rewrite'           => array( 'slug' => 'testimonial-category' ),

	);

	register_taxonomy( 'testimonial-category', 'testimonial', $args );

}



add_filter( 'manage_testimonial_posts_columns', 'set_custom_edit_testimonial_columns' );

function set_custom_edit_testimonial_columns($columns) {

    unset( $columns['author'] );

    $columns['testimonial'] = __( 'Shortcode', 'twentytwelve' );



    return $columns;

}



add_action( 'manage_testimonial_posts_custom_column' , 'custom_testimonial_column', 10, 2 );

function custom_testimonial_column( $column, $post_id ) {

    switch ( $column ) {



        case 'testimonial' :

            echo '[oob_testimonial id="'.$post_id.'"]';

            break;

    }

}