<?php
/**
 * Template Name: Scrapbook
 *
 *
 * @package dorisboris
 * @since dorisboris 1.0
 */

get_header(); ?>

	<section id="scrapbook" class="content-area">
		<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				$images = get_field('gallery');

				if( $images ): ?>
					    <?php 
							$i = 1;
							$large_i = array(3, 8);
						?> 
				        <?php foreach( $images as $image ): ?>
							<?php 
							$size = ( in_array($i, $large_i) ) ? 'large' : 'small';
							$tape = array('tape-top-left', 'tape-top-right', 'tape-bottom-left', 'tape-bottom-right');
							$class = array('item', 'span');
							$class[] = ($size == 'large') ? 'five' : 'two-and-half';
							?>
							<div class="<?php echo implode(' ', $class); ?>" >
				                <a class="btn" href="<?php echo $image['url']; ?>" class="<?php echo $tape[array_rand($tape)]; ?>">

				                	 <?php if ($size == 'large') : ?>
				                	 	<img src="<?php echo bfi_thumb( $image['url'], array('width' => 555, 'height' => 235)); ?>" />
									<?php else: ?>
				                	 	<img src="<?php echo bfi_thumb( $image['url'], array('width' => 263, 'height' => 245)); ?>" alt="<?php echo $image['alt']; ?>" />					                	 	
				                	 <?php endif; ?>
				                     
				                </a>
			                </div>
			            <?php $i++; ?>
				        <?php endforeach; ?>
				<?php endif; ?>
			</article>
			<?php $i++; ?>
			<?php endwhile;  ?>	
		<?php endif; ?>
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
