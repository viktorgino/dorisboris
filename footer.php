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
	</div><!-- #main .site-main -->
	
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="top">
			<div class="container">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>
		<div class="bottom">
			<div class="container">
				<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php // bloginfo( 'name' ); ?></a>			
				<div class="copyright">
					<ul class="social-links">
						<li><a class="facebook" href=""></a></li>
						<li><a class="googleplus" href=""></a></li>
						<li><a class="twitter" href=""></a></li>
						<li><a class="linkedin" href=""></a></li>
					</ul>
					<?php _e("Follow Epigeum:", THEME_NAME); ?>
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
