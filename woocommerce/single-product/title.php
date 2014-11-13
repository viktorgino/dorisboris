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
		$dimensions = $product->get_dimensions();
	?>
	<?php if ($dimensions != '0.0000 x 0.0000 cm' ): ?>
		<div class="dimensions">
			<?php _e( 'Dimensions: ', 'woocommerce' ) ?>
			<?php echo $dimensions; ?>
		</div>
	<?php endif; ?>


