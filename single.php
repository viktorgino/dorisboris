<?php get_header(); ?>

<div id="single" >

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>">
	
		<?php get_template_part('inc/content'); ?>

	</article>
<?php endwhile; // end of the loop. ?>

</div><!-- #single -->
<?php get_footer(); ?>
