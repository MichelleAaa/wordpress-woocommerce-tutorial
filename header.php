<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site">
		<header>
			<section class="search">
				<div class="container">
					<div class="text-center d-md-flex align-items-center">
						<?php get_search_form(); ?>
					</div>
				</div>
			</section>
			<section class="top-bar">
				<div class="container">
					<div class="row">
						<div class="brand col-md-3 col-12 col-lg-2 text-center text-md-left">
							<a href="<?php echo home_url( '/' ) ?>">
								<?php if( has_custom_logo() ): ?>
						<!-- the_custom_logo() renders the logo saved in wp-admin - appearance - customize - site identity - logo section -->
									<?php the_custom_logo(); ?>
								<?php else: ?>
									<p class="site-title"><?php bloginfo( 'title' ); ?></p>
									<span><?php bloginfo( 'description' ); ?></span>
								<?php endif; ?>
							</a>
						</div>
						<div class="second-column col-md-9 col-12 col-lg-10">
							<div class="row">
								<?php if( class_exists( 'WooCommerce' ) ): ?>
								<div class="account col-12">
<!-- Menu of two items - if the user is logged in, they will have My Account and Logout. If they are not logged in, there will be a menu link to login or register. -->
									<div class="navbar-expand">
										<ul class="navbar-nav float-left">
											<?php if( is_user_logged_in() ) : ?>
											<li>
	<!-- you could enter my-account as the href, but we could change the name of the page, so it's better to use this option:  -->
												<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="nav-link">My Account</a>
											</li>
											<li>
												<a href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ) ?>" class="nav-link">Logout</a>
											</li>
											<?php else: ?>
<!-- Note that the below brings up the login/register form. But you have to go into woocommerce - settings - accounts & privacity settings - account creation - allow customers to create an account on the My Account page - this must be checked for a register option to appear here -->
											<li>
												<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="nav-link">Login / Register</a>
											</li>				
											<?php endif; ?>
										</ul>
									</div>
									<div class="cart text-right">
										<!-- Link to the shopping card page: -->
										<a href="<?php echo wc_get_cart_url(); ?>"><span class="cart-icon"></span></a>
										<!-- This displays the total number of items in the cart -->
										<span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
									</div>
								</div>
								<?php endif; ?>
								<div class="col-12">
									<nav class="main-menu navbar navbar-expand-md navbar-light" role="navigation">
									<!-- Brand and toggle get grouped for better mobile display -->
									<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
								<!-- The theme location is the menu slug -- you set it up as the key in the array in functions.php -->
								<!-- The rest of these settings are from the wp-bootstrap-navwalker documentation: -->
								<?php 
									wp_nav_menu( array(
											'theme_location'    => 'fancy_lab_main_menu',
											'depth'             => 3,
//we changed this from 2 to 3 to control the menu levels we can have in the theme (If you have 1, you can’t have a dropdown level. If you have 2, you can have a menu and submenu. If you have 3, you can have a menu, with a submenu, with another submenu inside of that submenu. With some additional css you could have more submenus if you wanted.) – Note that you still need to add some css to make the 2nd submenu work correctly, but if you don’t set this depth value to 3, that third item won’t even display.
											'container'         => 'div',
											'container_class'   => 'collapse navbar-collapse',
											'container_id'      => 'bs-example-navbar-collapse-1',
											'menu_class'        => 'nav navbar-nav',
											'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
											'walker'            => new WP_Bootstrap_Navwalker(),
										) );
										?>
								</nav>
						</div>						
					</div>
				</div>
			</section>
		</header>		