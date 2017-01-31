<?php

if ( !is_admin() ) add_action( 'wp_enqueue_scripts', 'twentyfifteen_child_scripts', 11 );

/**
 * Include JS scripts
 */
function twentyfifteen_child_scripts() {
    // jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_stylesheet_directory_uri().'/node_modules/jquery/dist/jquery.min.js', false, null );
    wp_enqueue_script( 'jquery' );

    // PDFjs
    wp_enqueue_script( 'pdfjs.worker', get_stylesheet_directory_uri().'/node_modules/pdfjs-dist/build/pdf.worker.min.js' );
    wp_enqueue_script( 'pdfjs', get_stylesheet_directory_uri().'/node_modules/pdfjs-dist/build/pdf.min.js' );

    // ScrollTop
    //wp_enqueue_script( 'smooth-scroll', get_template_directory_uri().'/js/smooth-scroll.min.js', 'jquery', '2.0', true );

    // Panels
    //wp_enqueue_script( 'panel', get_template_directory_uri().'/js/panel.min.js', 'jquery', '2.0', true );

    // Masonry
    wp_enqueue_script( 'jquery-masonry' );

    // Infinite scroll
    //wp_register_script( 'infinite-scroll', get_template_directory_uri().'/js/vendor/jquery-infinitescroll.min.js', 'jquery', '2.0', true );
    //wp_enqueue_script( 'infinite-scroll' );
}

/**
 * Include CSS of parent theme
 */
function my_theme_enqueue_styles() {

    $parent_style = 'twentyfifteen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style( 'google-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );