<?php
/**
 * Template Name: Links
 *
 *
 * @package dorisboris
 * @since dorisboris 1.0
 */

get_header(); ?>

	<section id="links" class="content-area">
		<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php get_template_part('inc/content'); ?>

				</article>
				<div class="gallery">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('link') ):

				 	// loop through the rows of data
				    while ( have_rows('link') ) : the_row(); ?>
						<div class="span two-and-half equal-height">
							<a href="<?php the_sub_field('link_url'); ?>">
								<img src="<?php the_sub_field('link_image');  ?>" alt="">
							</a>
						</div>
				    <?php endwhile;
				endif; ?>
				</div>
			<?php endwhile;  ?>	
		<?php endif; ?>
	</section><!-- #primary -->

<?php
get_footer();
