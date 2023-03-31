<?php

/**
 * Fancy Lab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fancy Lab
 */

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
* Customizer additions.
*/
require_once get_template_directory() . '/inc/customizer.php';

function fancy_lab_scripts(){

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '4.3.1', true ); 
// last value - if you want the js file in the footer or in the head tag. 
//We are not adding popper.js becuase it's mostly for tooltips, which aren't used in this project.

    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all' );
// The first parameter is any name you make up. Second is the path to the file (get_stylesheet_uri() gets the path to style.css) -- get_template_directory_uri() would be needed if you have another css file to load. Third is whether there's a dependency. -- you would list just the file name if that was the case. Fourth is the version of our stylesheet. (the function fileemtime() returns the file modification time). If you submit a theme, just use something like '1.0' instead of filemtime(). Fifth is what kind of media the css file refers to. 
    wp_enqueue_style( 'fancy-lab-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all' );

	// Google Fonts
 	// wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700|https://fonts.googleapis.com/css?family=Seaweed+Script' );

 	// Flexslider Javascript and CSS files
	wp_enqueue_script( 'flexslider-min-js', get_template_directory_uri() . '/inc/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/inc/flexslider/flexslider.css', array(), '', 'all' );
	wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/inc/flexslider/flexslider.js', array( 'jquery' ), '', true );
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
				'fancy_lab_main_menu' 	=> __( 'Fancy Lab Main Menu', 'fancy-lab' ),
				'fancy_lab_footer_menu' => __( 'Fancy Lab Footer Menu', 'fancy-lab' ),
			)
		);

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Fancy Lab, use a find and replace
	* to change 'fancy-lab' to the name of your theme in all the template files.
	*/
	// The textdomain was defined in style.css at the top. We can only have one textdomain in the file if we are submitting the theme.
	$textdomain = 'fancy-lab';
	load_theme_textdomain( $textdomain, get_stylesheet_directory() . '/languages/' );
	// Second parameter is where our translation files will be:
	load_theme_textdomain( $textdomain, get_template_directory() . '/languages/' );

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
		// custom-log allows us to use a custom logo in our theme. -- you can now go to wp-admin - appearance - customize - site identity - now there's an option to upload a logo
		add_theme_support( 'custom-logo', array(
			'height' 		=> 85,
			'width'			=> 160,
			'flex-height'	=> true,
			'flex-width'	=> true,
			//the owner can still upload a different sized image.
		) );

		add_theme_support( 'post-thumbnails' ); // You don't need the support if woocommerce is active, but it's ideal to include it in case the user deactivated it.
		//Add a custom image size:
		//first parameter is the name you make up. Second is the width. Third is the height of the image. Cropping instructions are center/center.
		add_image_size( 'fancy-lab-slider', 1920, 800, array( 'center', 'center' ) );
		add_image_size( 'fancy-lab-blog', 960, 640, array( 'center', 'center' ) );

// from: https://codex.wordpress.org/Content_Width
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}

		// This ensures the title tag shows in the header:
		add_theme_support('title-tag');		
}

add_action( 'after_setup_theme', 'fancy_lab_config', 0 );//0 means that everything in the fancy_lab_config function will execute right after the theme is set up.

if( class_exists( 'WooCommerce' )){
	require get_template_directory() . '/inc/wc-modifications.php';
}

/**
 * Show cart contents / total Ajax -- this shows the updated cart total without needing to re-load the page.
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'fancy_lab_woocommerce_header_add_to_cart_fragment' );

function fancy_lab_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['span.items'] = ob_get_clean();
	return $fragments;
}

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
add_action( 'widgets_init', 'fancy_lab_sidebars' );

// This is going to cause the widgets option to appear in wp-admin - appearance - Widgets.
function fancy_lab_sidebars(){
	register_sidebar( array(
		//name is the name that will appear in the wp-admin area when we set up the sidebar:
		'name'			=> __( 'Fancy Lab Main Sidebar', 'fancy-lab' ),
		// id has to be unique. Avoid special characters.
		'id'			=> 'fancy-lab-sidebar-1',
		//The description appears in the admin panel
		'description'	=> __( 'Drag and drop your widgets here', 'fancy-lab' ),
		// The %$ is from the pre-provided wp theme
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
		register_sidebar( array(
		'name'			=> __( 'Sidebar Shop', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-shop',
		'description'	=> __( 'Drag and drop your WooCommerce widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );	
	register_sidebar( array(
		'name'			=> __( 'Footer Sidebar 1', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-footer1',
		'description'	=> __( 'Drag and drop your widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
	register_sidebar( array(
		'name'			=> __( 'Footer Sidebar 2', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-footer2',
		'description'	=> __( 'Drag and drop your widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
	register_sidebar( array(
		'name'			=> __( 'Footer Sidebar 3', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-footer3',
		'description'	=> __( 'Drag and drop your widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );				
}