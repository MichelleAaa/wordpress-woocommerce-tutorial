<?php 
/**
 * Template Overrides for WooCommerce pages
 *
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/#section-3
 *
 * @package Fancy Lab
 */

//  NOTE: Instead of using template overrides, this is the preferred method of modifying the woocommerce base templates. We use action hooks and filters.

function fancy_lab_wc_modify(){
    /** 
	* Modify WooCommerce opening and closing HTML tags
	* We need Bootstrap-like opening/closing HTML tags
	*/

    //It's best to install the Simply Show Hooks plugin so you can see on the page (after clicking the option in the hover wp bar) so you can see the hooks and the functions attached to each, with their priority.

    //We are adding this action into the woocommerce_before_main_content hook.
    //It will fire a function called fancy_lab_open_container_row.
    //It's priority is 5, so it will fire before the 10 of the first woocommerce created function.
    add_action( 'woocommerce_before_main_content', 'fancy_lab_open_container_row', 5 );
    function fancy_lab_open_container_row(){
        echo '<div class="container shop-content"><div class="row">';
    }

    add_action( 'woocommerce_after_main_content', 'fancy_lab_close_container_row', 5 );
    function fancy_lab_close_container_row(){
        echo '</div></div>';
    }

    /** 
    * Remove the main WC sidebar from its original position
    * We'll be including it somewhere else later on
    */
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

    // All of this will only work on the shop page:
	if( is_shop() ){

		add_action( 'woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6 );
		function fancy_lab_add_sidebar_tags(){
			echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
		}

		// Put the main WC sidebar back, but using other action hook and on a different position
		add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 7 );

		add_action( 'woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8 );
		function fancy_lab_close_sidebar_tags(){
			echo '</div>';
		}

          //After the title, now the excerpt of the product is added:
		add_action( 'woocommerce_after_shop_loop_item_title', 'the_excerpt', 1 );		
	}

   // Modify HTML tags on a shop page. We also want Bootstrap-like markup here (.primary div)
	add_action( 'woocommerce_before_main_content', 'fancy_lab_add_shop_tags', 9 );
	function fancy_lab_add_shop_tags(){
		if( is_shop()){
			echo '<div class="col-lg-9 col-md-8 order-1 order-md-2">';
		} else{
			echo '<div class="col">';
		}
		
	}

	add_action( 'woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4 );
	function fancy_lab_close_shop_tags(){
		echo '</div>';
	}

    //Filters can change content from one thing into another.  -- they are called with apply_filters().
    //apply_filters() first parameter is the name of the filter. The second one is the name of the value you can make modifications to.
    //For example, from the archive-product.php file:
    //<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) 
    //The above means the code under it will only display if the value of that filter is true.

    //Here, we create a function that can change the value of this filter. We pass the filter name, then a new function name.
    //Here, we make the function return false instead of true:
    /*add_filter( 'woocommerce_show_page_title', 'fancy_lab_remove_shop_title' );
    function fancy_lab_remove_shop_title( $val ){
        $val = false;
        return $val;
    } */
    //We won't be modifying this filter, it's just an example of how it works.

}

add_action( 'wp', 'fancy_lab_wc_modify' );