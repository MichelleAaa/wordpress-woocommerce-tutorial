<?php 
/*
Template Name: Home Page
*/

get_header(); ?>

		<div class="content-area">
			<main>
				<section class="slider">
					<div class="flexslider">
					  <ul class="slides">
						<?php  
							// Getting data from Customizer to display the Slider section
							// set_slider_page1 is for example what we set up for the first slide input fields in the customizer.php. We can access it with get_theme_mod().
							// slider_page is an array we are creating to add index values into.
						for ($i=1; $i < 4; $i++) : 
							$slider_page[$i] 				= get_theme_mod( 'set_slider_page' . $i );
							$slider_button_text[$i]			= get_theme_mod( 'set_slider_button_text' . $i ); 
							$slider_button_url[$i]			= get_theme_mod( 'set_slider_button_url' . $i );
						endfor;

							//post__in defines the id's of the pages we want to display using the loop. It accepts an array of id's, separated by commas.
						$args = array(
							'post_type'			=> 'page',
							'posts_per_page'	=> 3,
							'post__in'			=> $slider_page,
							'orderby'			=> 'post__in',
						);

						$slider_loop = new WP_Query( $args );
						$j = 1;
						if( $slider_loop->have_posts() ):
							while( $slider_loop->have_posts() ):
								$slider_loop->the_post();
						?>
						    <li>
							<!-- Gets the featured image of each post -->
						      <?php the_post_thumbnail( 'fancy-lab-slider', array( 'class' => 'img-fluid' ) ); ?>
						      <div class="container">
						      	<div class="slider-details-container">
						      		<div class="slider-title">
						      			<h1><?php the_title(); ?></h1>
						      		</div>
						      		<div class="slider-description">
						      			<div class="subtitle"><?php the_content(); ?></div>
						      			<a class="link" href="<?php echo $slider_button_url[$j]; ?>"><?php echo $slider_button_text[$j]; ?></a>
						      		</div>
						      	</div>
						      </div>
						    </li>
						<?php 
						$j++;
						endwhile;
						wp_reset_postdata();
						endif;
						?>
					  </ul>
					</div>
				</section>
				<?php if( class_exists( 'WooCommerce' ) ): ?>
				<section class="popular-products">
					<!-- To allow the user to have control we created settings in the customizer.php file. -->
					<?php 
					// The first value is the one to use (which is from the customizer, that the user will enter in wp-admin - appearance - customize --- if the user doesn't enter a value, the second parameter is a default value.)
					$popular_limit		= get_theme_mod( 'set_popular_max_num', 4 );
					$popular_col 		= get_theme_mod( 'set_popular_max_col', 4 );
					$arrivals_limit		= get_theme_mod( 'set_new_arrivals_max_num', 4 );
					$arrivals_col		= get_theme_mod( 'set_new_arrivals_max_col', 4 );

					?>
					<div class="container">
						<h2>Popular Products</h2>
						<?php echo do_shortcode( '[products limit=" ' . $popular_limit . ' " columns=" ' . $popular_col . ' " orderby="popularity"]' ); ?>
					</div>
				</section>
				<section class="new-arrivals">
					<div class="container">
						<h2>New Arrivals</h2>
						<?php echo do_shortcode( '[products limit=" ' . $arrivals_limit . ' " columns=" ' . $arrivals_col . ' " orderby="date"]' ); ?>
					</div>
				</section>
				<?php 
// Gets the value from the wp-admin - appearance- customize section. If there's no value, then the second default will be used.
				$showdeal			= get_theme_mod( 'set_deal_show', 0 );
				$deal 				= get_theme_mod( 'set_deal' );
				$currency			= get_woocommerce_currency_symbol();
				// in adminer or phpmyadmin - wp_postmeta table, this field is called _regular_price.
				$regular			= get_post_meta( $deal, '_regular_price', true );
				$sale 				= get_post_meta( $deal, '_sale_price', true );

				
				// This section will only display if the checkbox is marked and if the user has typed in any id for the featured product field.
				if( $showdeal == 1 && ( !empty( $deal ) ) ):
					// Note that the product must be on sale or else this would result in an error:
					$discount_percentage = absint( 100 - ( ( $sale/$regular ) * 100 ) );
				?>
				<section class="deal-of-the-week">
					<div class="container">
						<h2>Deal of the Week</h2>
						<div class="row d-flex align-items-center">
							<div class="deal-img col-md-6 col-12 ml-auto text-center">
								<!-- large is for the image size. (large is automatically included in wp.) -->
								<?php echo get_the_post_thumbnail( $deal, 'large', array( 'class' => 'img-fluid' ) ); ?>
							</div>
							<div class="deal-desc col-md-4 col-12 mr-auto text-center">
								<?php if( !empty( $sale ) ): ?>
									<span class="discount">
										<?php echo $discount_percentage . '% OFF'; ?>
									</span>
								<?php endif; ?>
								<h3>
									<a href="<?php echo get_permalink( $deal ); ?>"><?php echo get_the_title( $deal ); ?></a>
								</h3>
								<p><?php echo get_the_excerpt( $deal ); ?></p>
								<div class="prices">
									<span class="regular">
										<?php 
										echo $currency;
										echo $regular;
										?>
									</span>
									<?php if( !empty( $sale ) ): ?>
										<span class="sale">
											<?php 
											echo $currency;
											echo $sale;
											?>				
										</span>
									<?php endif; ?>
								</div>
								<a href="<?php echo esc_url( '?add-to-cart=' . $deal ); ?>" class="add-to-cart">Add to Cart</a>
							</div>
						</div>
					</div>
				</section>
					<?php endif; ?>
				<?php endif; ?>
				<section class="lab-blog">
					<div class="container">
						<div class="row">
							<?php 
								// If there are any posts
								if( have_posts() ):

									// Load posts loop
									while( have_posts() ): the_post();
										?>
											<article>
												<h2><?php the_title(); ?></h2>
												<div><?php the_content(); ?></div>
											</article>
										<?php
									endwhile;
								else:
							?>
								<p>Nothing to display.</p>
							<?php endif; ?>
						</div>
					</div>
				</section>
			</main>
		</div>
<?php get_footer(); ?>