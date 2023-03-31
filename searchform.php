<?php
/**
 * Template for displaying search forms in Fancy Lab
 *
 * @package Fancy Lab
 */
?>
<!-- This allows us to customize the search form. By default it has an input and a Search button -->
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'fancy-lab' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'fancy-lab' ); ?></span></button>
    <!-- We want to only show products in the search. Now the template is archive-product.php for the search results. (You would need to create search.php if you wanted to include posts instead of products, but we only want products for the time being.) -->
    <!-- The if statement ensures that the search only acts like this if WooCommerce plugin is active (so it will default to normal behavior if the plugin is not active.) -->
	<?php if( class_exists( 'WooCommerce' )): ?>
        <!-- This input is what ensure that only 'product' search items show -->
		<input type="hidden" value="product" name="post_type" id="post_type">
	<?php endif; ?>
</form>