<?php

add_theme_support( 'post-thumbnails' );

/**
 * Custom post types definition
 *      - story
 *      - book
 *      - reportage
 */
function custom_post_type() {
	// Story
    $labels = array(
        'name'                => __( 'Stories', 'twentyfifteen-child' ),
        'singular_name'       => __( 'Story', 'twentyfifteen-child' ),
        'all_items'           => __( 'All stories', 'twentyfifteen-child' ),
        'view_item'           => __( 'View', 'twentyfifteen-child' ),
        'add_new_item'        => __( 'Add a story', 'twentyfifteen-child' ),
        'add_new'             => __( 'Add', 'twentyfifteen-child' ),
        'edit_item'           => __( 'Edit', 'twentyfifteen-child' ),
        'update_item'         => __( 'Update', 'twentyfifteen-child' ),
        'search_items'        => __( 'Search', 'twentyfifteen-child' ),
        'not_found'           => __( 'Not found', 'twentyfifteen-child' ),
        'not_found_in_trash'  => __( 'Not found in trash', 'twentyfifteen-child' )
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        //'taxonomies'          => array( 'category', 'post_tag' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-testimonial',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'hierarchical'        => false,
        'rewrite'			  => array( 'slug' => 'story' ),
        // roles and capabilities
        //'capability_type'     => array( 'story', 'stories' ),
        //'map_meta_cap'        => true
    );
    register_post_type( 'story', $args );

    // Book
    $labels = array(
        'name'                => __( 'Books', 'twentyfifteen-child' ),
        'singular_name'       => __( 'Book', 'twentyfifteen-child' ),
        'all_items'           => __( 'All books', 'twentyfifteen-child' ),
        'view_item'           => __( 'View', 'twentyfifteen-child' ),
        'add_new_item'        => __( 'Add a book', 'twentyfifteen-child' ),
        'add_new'             => __( 'Add', 'twentyfifteen-child' ),
        'edit_item'           => __( 'Edit', 'twentyfifteen-child' ),
        'update_item'         => __( 'Update', 'twentyfifteen-child' ),
        'search_items'        => __( 'Search', 'twentyfifteen-child' ),
        'not_found'           => __( 'Not found', 'twentyfifteen-child' ),
        'not_found_in_trash'  => __( 'Not found in trash', 'twentyfifteen-child' )
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor' ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book-alt',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'hierarchical'        => false,
        'rewrite'             => array( 'slug' => 'book' ),
        // roles and capabilities
        //'capability_type'     => array( 'book', 'books' ),
        //'map_meta_cap'        => true
    );
    register_post_type( 'book', $args );

    // Reportage
    $labels = array(
        'name'                => __( 'Reportages', 'twentyfifteen-child' ),
        'singular_name'       => __( 'Reportage', 'twentyfifteen-child' ),
        'all_items'           => __( 'All reportages', 'twentyfifteen-child' ),
        'view_item'           => __( 'View', 'twentyfifteen-child' ),
        'add_new_item'        => __( 'Add a reportage', 'twentyfifteen-child' ),
        'add_new'             => __( 'Add', 'twentyfifteen-child' ),
        'edit_item'           => __( 'Edit', 'twentyfifteen-child' ),
        'update_item'         => __( 'Update','twentyfifteen-child' ),
        'search_items'        => __( 'Search', 'twentyfifteen-child' ),
        'not_found'           => __( 'Not found', 'twentyfifteen-child' ),
        'not_found_in_trash'  => __( 'Not found in trash', 'twentyfifteen-child' )
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        //'taxonomies'          => array( 'category', 'post_tag' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-format-aside',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'hierarchical'        => true,
        'rewrite'             => array( 'slug' => 'reportage' ),
        // roles and capabilities
        //'capability_type'     => array( 'reportage', 'reportages' ),
        //'map_meta_cap'        => true
    );
    register_post_type( 'reportage', $args );
}
add_action( 'init', 'custom_post_type', 0 );

/**
 * Custom taxonomies definition
 *      - contributor-type
 *      - theme
 *      - region
 */
function custom_taxonomy() {

}
add_action( 'init', 'custom_taxonomy' );
