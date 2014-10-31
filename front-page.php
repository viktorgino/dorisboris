<?php get_header(); ?>
<section id="front-page">
	<div class="inner">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php get_template_part('inc/content'); ?>

		</article>
	<?php endwhile; ?>
	</div>
</section><!-- #index -->
<?php get_footer(); ?>