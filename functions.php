<?php

/**
 * Fancy Lab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fancy Lab
 */



function fancy_lab_scripts(){

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '4.3.1', true ); 
// last value - if you want the js file in the footer or in the head tag. 
//We are not adding popper.js becuase it's mostly for tooltips, which aren't used in this project.

    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all' );
// The first parameter is any name you make up. Second is the path to the file (get_stylesheet_uri() gets the path to style.css) -- get_template_directory_uri() would be needed if you have another css file to load. Third is whether there's a dependency. -- you would list just the file name if that was the case. Fourth is the version of our stylesheet. (the function fileemtime() returns the file modification time). If you submit a theme, just use something like '1.0' instead of filemtime(). Fifth is what kind of media the css file refers to. 
    wp_enqueue_style( 'fancy-lab-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all' );
}

add_action( 'wp_enqueue_scripts', 'fancy_lab_scripts' );

/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/

// Here we are registering a nav menu 
function fancy_lab_config(){
    // You can register multiple menus in the array.
    //The value below, Fancy Lab Main Menu, is what's set up in wp-admin, appearance, menus for the menu we created.
	register_nav_menus(
        array(
            'fancy_lab_main_menu' 	=> 'Fancy Lab Main Menu',
            'fancy_lab_footer_menu' => 'Fancy Lab Footer Menu',
        )
    );

//This enables woocommerce support with just the first argument.
//With the second argument, we can pass in some default values.
    add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 255,
			'single_image_width'	=> 255,
            //This controls how the products will be displayed in the store:
			'product_grid' 			=> array(
	            'default_rows'    => 10, // how many product rows your store will have
	            'min_rows'        => 5,
	            'max_rows'        => 10,
	            'default_columns' => 1, //how many product columns the store will have.
	            'min_columns'     => 1,
	            'max_columns'     => 1,				
			) //some of these can be changed in appearance - customize - woocommerce - product catalog. But we will instead just set it here.
		) );
        // These enable the gallery to work correctly on the single product page.
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
// from: https://codex.wordpress.org/Content_Width
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}		
}

add_action( 'after_setup_theme', 'fancy_lab_config', 0 );//0 means that everything in the fancy_lab_config function will execute right after the theme is set up.

if( class_exists( 'WooCommerce' )){
	require get_template_directory() . '/inc/wc-modifications.php';
}