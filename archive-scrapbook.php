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

			<?php if ( have_posts() ) : ?>

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						the_title();
						the_post_thumbnail();
					endwhile;
					// Previous/next page navigation.
					get_template_part('inc/pagination');

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
