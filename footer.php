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
		<div class="share">
			<div class="container">
				<div class="span five phone break-on-mobile">
					<i class="icon icon-tel"></i>
					<?php the_field('global_phone_number', 'options'); ?>	
				</div>
			</div>
		</div>
		<div class="top">
			<div class="container">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>
		<div id="newsletter">
			<div class="container">
					<div class="span five break-on-mobile">
						<img src="<?php bloginfo('template_directory'); ?>/images/misc/newsletter-title.jpg" alt="">
						<span class="label"><?php _e('Keep up to date with our latest news & products:') ?></span>
					</div>
					<div class="span five break-on-mobile">
						<?php gravity_form(1, false, false, false, '', true); ?>
						<span class="stamp">
							<img src="<?php bloginfo('template_directory'); ?>/images/misc/newsletter-stamp.png" alt="">
						</span>
					</div>
				
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
