<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fancy Lab
 */

?>
<!-- post_class shows a bunch of classes that you can use to style your post. -->
<article <?php post_class(); ?>>
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="post-thumbnail">
		<?php 
		if( has_post_thumbnail() ):
			the_post_thumbnail( 'fancy-lab-blog', array( 'class' => 'img-fluid' ) );
		endif;
		?>
	</div>
	<div class="meta">
		<p><?php _e( 'Published by', 'fancy-lab' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'fancy-lab' ); ?> <?php echo get_the_date(); ?>
		<br />
		<!-- The ' ' below will separate the categories with a space. -->
		<?php if( has_category() ): ?>
			<?php _e( 'Categories', 'fancy-lab' ); ?>: <span><?php the_category( ' ' ); ?></span>
		<?php endif; ?>
		<br />
		<!-- The first parameter '', shows up at the beginning of the list. The second parameter of ', ' is the tag separator, between each tag. -->
		<?php if( has_tag() ): ?>
			<?php _e( 'Tags', 'fancy-lab' ); ?>: <span><?php the_tags( '', ', ' ); ?></span>
		<?php endif; ?>
		</p>
	</div>
	<div><?php the_excerpt(); ?></div>
</article>