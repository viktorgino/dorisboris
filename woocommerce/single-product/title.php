<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
	<?php
		global $product;
		$weight = $product->get_weight();
		$weight = wc_trim_zeros( $weight );

		$id = $product->id;

		$height_1 = get_post_meta( $id, '_height' );
		$height = wc_trim_zeros($height_1[0]);
		$width_1 = get_post_meta( $id, '_width' );
		$width = wc_trim_zeros($width_1[0]);
	?>
	<?php if ($weight !='0.0000'): ?>
		<div class="weight">
			<?php _e( 'Weight: ', 'woocommerce' ) ?> <?php echo $weight; ?> <?php _e('kg','woocommerce'); ?>
		</div>
	<?php endif; ?>	
	<?php if ($dimensions != '0.0000 x 0.0000 cm' ): ?>
		<div class="dimensions">
			<?php _e( 'Dimensions: ', 'woocommerce' ) ?>
			<?php echo $height . ' x ' . $width . ' ' . get_option( 'woocommerce_dimension_unit' ); ?>
		</div>
	<?php endif; ?>


