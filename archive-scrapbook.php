<?php
/**
 * The template for displaying Scrapbook Archives 
 *
 *
 * @package dorisboris
 * @since dorisboris 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		    <?php 
				$i = 1;
				$array = array(3,7);
			?> 
			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" class="item span <?php if (in_array($i, $array)){echo 'five';} else {echo 'two-and-half';} ?>">
						<?php 
							the_title();
							the_post_thumbnail(); 
						?>
				</article>
				<?php $i++; ?>
				<?php endwhile;  ?>	
			<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
