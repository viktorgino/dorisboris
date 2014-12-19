<?php get_header(); ?>

<section id="index">
<?php
/**
 * Template Name: Press template
 *
 */
get_header(); ?>

	<div id="blog">
		<div id="content" class="span ten">
			<div class="span ten">
			<?php 
				$args = array(
					'cat'              => 314,
					'posts_per_page'         => 10,
					'paged'                  => $paged,
				);
			
			$query = new WP_Query( $args );
			 ?>
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
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
								
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>	
			</div>

			<div class="pagination">
			<?php
				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $query->max_num_pages,
					'prev_text' => __('<i class="icon-slider-left"></i>Previous'),
					'next_text' => __('Next <i class="icon-slider-right"></i>')
				) );
			?>
			</div><!-- .pagination -->
		</div>
	</div>
</section><!-- #index -->
<?php get_footer(); ?>