<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $product;
?>

<h1 itemprop="name" class="product_title entry-title"><?php echo the_title(); ?></h1>
<?php
$id = $product->id;
$product->list_attributes();
?>