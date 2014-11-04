<?php get_header(); ?>
<section id="front-page">

	<!-- CAROUSEL -->
	<?php if( have_rows('front_page_slider') ): ?>
		<div class="owl-carousel">
	  	<?php while ( have_rows('front_page_slider') ) : the_row(); ?>  

			<?php 
				$attachment_id = get_sub_field('slide_image');
				$size = "slider";
				$image = wp_get_attachment_image_src( $attachment_id, $size );								
			?>

			<div class="item">
				<img alt="" src="<?php echo $image[0]; ?>" />
				<div class="caption">
					<h1><?php the_sub_field('slide_title'); ?></h1>
					<p><?php the_sub_field('slide_description'); ?></p>
					<?php 
					$relations = get_sub_field('link_to');
					if( $relations ): ?>
						<?php foreach( $relations as $relation ): // variable must NOT be called $post (IMPORTANT) ?>
						    	<a class="link" href="<?php echo get_permalink( $p ); ?>"><?php the_sub_field('button_title'); ?></a>
						<?php endforeach; ?>
					<?php endif; ?>						
				</div>
			</div>				
	    <?php endwhile; ?>
	    </div>
	<?php endif; ?>


	<!-- QUICK Links -->
	<?php if( have_rows('quick_link_boxes') ): ?>
		<div id="quick-links" class="clearfix">
	  		<?php while ( have_rows('quick_link_boxes') ) : the_row(); ?>  
	  	
				<div class="span third">
					<?php $type = get_sub_field('link_type'); ?>
					<?php if($type == 'category'): ?>
						<?php 
							$category_id = get_sub_field('box_link_prod_cat');
						 ?>
						 <a href="<?php echo get_term_link($category_id, 'product_cat'); ?>">
						
					<?php else: ?>
  						<?php 
						$urls = get_sub_field('box_link_page');
						if( $urls ): ?>
							<?php foreach( $urls as $url ): // variable must NOT be called $post (IMPORTANT) ?>
					    	<a class="link" href="<?php echo get_permalink( $p ); ?>">
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endif; ?>

	 						<?php 
								$attachment_id = get_sub_field('box_image');
								$imgsrc = wp_get_attachment_image_src($attachment_id,array(380, 220, 'bfi_thumb' => true) );
								$image = bfi_thumb( $imgsrc[0] );
							?>
							<img src="<?php echo $image;  ?>" alt="">
							<h1><?php the_sub_field('box_title'); ?></h1>					
						</a>
				</div>
    		<?php endwhile; ?>
	    </div>
	<?php endif; ?><!-- end IF quick_link_boxes -->

	

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php get_template_part('inc/content'); ?>

		</article>
	<?php endwhile; ?>	
	
</section><!-- #index -->
<?php get_footer(); ?>