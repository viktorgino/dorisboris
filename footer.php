<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package dorisboris
 * @since dorisboris 1.0
 */
?>
		</div><!-- .container .site-main -->
	</div><!-- #main .site-main -->
	
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="top">
			<div class="container">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>
		<div class="bottom">
			
			<div class="container">
				<?php the_time('Y'); ?> <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> <?php _e(' LTD'); ?>
				<div class="copyright">
				</div>
			</div>
		</div>
	</div>
	</div>
	</footer><!-- #footer .site-footer -->
</div><!-- #wrap -->

<?php wp_footer(); ?>

</body>
</html>
