<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */

?>
		<footer>
			<section class="footer-widgets">
				<div class="container">
					<div class="row">

						<?php if( is_active_sidebar( 'fancy-lab-sidebar-footer1' ) ): ?>
							<div class="col-md-4 col-12">
								<?php dynamic_sidebar( 'fancy-lab-sidebar-footer1' ); ?>
							</div>
						<?php endif; ?>
						<?php if( is_active_sidebar( 'fancy-lab-sidebar-footer2' ) ): ?>
							<div class="col-md-4 col-12">
								<?php dynamic_sidebar( 'fancy-lab-sidebar-footer2' ); ?>
							</div>
						<?php endif; ?>	
						<?php if( is_active_sidebar( 'fancy-lab-sidebar-footer3' ) ): ?>
							<div class="col-md-4 col-12">
								<?php dynamic_sidebar( 'fancy-lab-sidebar-footer3' ); ?>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			</section>
			<section class="copyright">
				<div class="container">
					<div class="row">
						<div class="copyright-text col-12 col-md-6">
<!-- The first value is what we set up in customizer.php. The second value is a placeholder/default value in case the user didn't fill in the detail in the wp-admin panel (appearance - customize - copyright) -->
							<p><?php echo get_theme_mod( 'set_copyright', __( 'Copyright X - All Rights Reserved', 'fancy-lab' ) ); ?></p>
						</div>
						<nav class="footer-menu col-12 col-md-6 text-left text-md-right">
							<?php 
								wp_nav_menu( 
									array(
										'theme_location' 	=> 'fancy_lab_footer_menu'
									) 
								); 
							?>							
						</nav>
					</div>
				</div>
			</section>
		</footer>
	</div>
<?php wp_footer(); ?>
</body>
</html>