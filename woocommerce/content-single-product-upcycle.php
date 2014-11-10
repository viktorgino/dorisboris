<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="upcycle" <?php post_class(); ?>>

	<div class="product-inner">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary">

			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>

		</div><!-- .summary -->
	</div>

	

	<?php 
		$queried_object = get_queried_object();
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;

		$cat_description = get_field('category_description', $queried_object);		 
		$cat_image = get_field('category_image', $taxonomy . '_' . $term_id);									
	?>	

	<?php 
		$images = get_field('upcycling_gallery');
		$i = 0;

	if( $images ): ?>
		<div class="" id="upcycling-diary">
			<div class="span five"></div>
			<div class="span five prepare">
				<img src="<?php bloginfo('template_directory'); ?>/images/misc/prepare.png" alt="">
				<span><?php _e('See how we upcycled this piece', 'woocommerce'); ?></span>
			</div>
			<div class="item span five up-title" >
				<img src="<?php bloginfo('template_directory'); ?>/images/misc/upcycling.jpg" alt="">
				<div class="inner">
					<img src="<?php bloginfo('template_directory'); ?>/images/misc/diary.png" alt="">
					<p><?php the_field('upcycling_gallery_title'); ?></p>
				</div>
			</div>
	        <?php foreach( $images as $image ): ?>					
            	 	<?php if ($image === end($images)): ?>
            	 		<?php if( $i % 2 == 1): ?>
	                		<div class="span item ten" >
	                	 		<img src="<?php echo bfi_thumb( $image['url'], array('width' => 1200, 'height' => 645)); ?>" />
                	 		</div>                	 			
            	 		<?php else: ?>
							<div class="span item five" >
	                	 		<img src="<?php echo bfi_thumb( $image['url'], array('width' => 598, 'height' => 343)); ?>" />
                	 		</div>                	 			
            	 		<?php endif; ?>

					<?php else: ?>
						<div class="span item five" >
                	 		<img src="<?php echo bfi_thumb( $image['url'], array('width' => 598, 'height' => 343)); ?>" />               	 	
            	 		</div>
                	 <?php endif; ?>  
            	<?php $i++ ?>   
	        <?php endforeach; ?>
    	</div>	
	<?php endif; ?>
		

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
