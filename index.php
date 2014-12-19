<?php get_header(); ?>

<section id="index">
<?php
get_header(); ?>

	<div id="blog">
		<div id="content" class="span ten">
			<div class="span ten">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="blog">
							<div class="span three image">
							<?php 
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
								$url = $thumb['0'];
							 ?>
								<a class="img zoom" rel="prettyPhoto" href="<?php echo $url; ?>">
									<?php the_post_thumbnail(array(200, 'bfi_thumb' => true)); ?>
								</a>
							</div>
							<div class="span seven content">
								<h2 class="title"><?php the_title(); ?></h2>
								
								<?php the_content(); ?>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>	
			</div>		
		</div>
	</div>
</section><!-- #index -->
<?php get_footer(); ?>