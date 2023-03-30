<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Fancy Lab
 */

get_header();
?>
<div class="content-area">
	<main>
		<div class="container">
			<div class="error-404">
				<header>
					<h1>Page not found</h1>
					<p>Unfortunately, the page you tried to reach does not exist on this site</p>
				</header>
                <!-- the_widget()  allows you to call a variety of included widgets: https://developer.wordpress.org/reference/functions/the_widget/ -->
				<?php 
					the_widget( 'WP_Widget_Recent_Posts', 
						array(
							'title'		=> 'Take a Look at Our Latest Posts',
							'number'	=> 3,
						) ); 
				?>
			</div>
		</div>
	</main>
</div>
<?php get_footer(); ?>