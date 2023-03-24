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
<!-- This will pull from your wp-admin settings for language -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- NOTE: There’s no title tag – we add it in the wp-admin panel. -->
	<link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site">
		<header>
			<section class="search">
				<div class="container">
					Search
				</div>
			</section>
			<section class="top-bar">
				<div class="container">
					<div class="row">
						<div class="brand col-3">Logo</div>
						<div class="second-column col-9">
							<div class="acount">Account</div>
							<nav class="main-menu">
								<!-- The theme location is the menu slug -- you set it up as the key in the array in functions.php -->
								<?php 
									wp_nav_menu(
										array(
											'theme_location'		=> 'fancy_lab_main_menu'
										)
									);
								?>
							</nav>
						</div>						
					</div>
				</div>
			</section>
		</header>