<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Fancy Lab
 */
?>
<!-- If there's any active widgets inside our sidebar... -->
<?php if( is_active_sidebar( 'fancy-lab-sidebar-1' ) ): ?>
	<aside class="col-lg-3 col-md-4 col-12 h-100">
        <!-- Then we will pull in our fancy-lab-sidebar-1 -->
		<?php dynamic_sidebar( 'fancy-lab-sidebar-1' ); ?>
	</aside>
<?php endif;