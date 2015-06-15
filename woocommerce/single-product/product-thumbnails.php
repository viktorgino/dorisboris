<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids[] = $product->get_image_id();

if ($product->has_child()) {
    foreach ($product->get_available_variations() as $key => $variation) {
        $variation_obj = $product->get_child($variation['variation_id']);
        //var_dump($variation_obj->get_image_id());
        $attachment_ids[] = $variation_obj->get_image_id();
    }
}
if (count($attachment_ids) <= 1) {
    $attachment_ids = array_merge($attachment_ids, $product->get_gallery_attachment_ids());
}
if ($attachment_ids) {
    $loop = 0;
    $columns = apply_filters('woocommerce_product_thumbnails_columns', 3);
    ?>

    <div class="thumbnails fotorama <?php echo 'columns-' . $columns; ?>" 
         data-auto="false"
         data-allow-full-screen="true"
         data-thumb-width="70"
         data-thumb-height="47"
         data-nav="thumbs"><?php
             foreach (array_unique($attachment_ids) as $key => $attachment_id) {
                 $class = array();
                 $image_link = wp_get_attachment_url($attachment_id);

                 if (!$image_link)
                     continue;
                 if ($key === 0)
                     $class [] = "active";
                 $image_class = implode(" ", $class);
                 $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
                 $image_title = esc_attr(get_the_title($attachment_id));

                 echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<a href="%s" title="%s" class="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_title, $image_class, $image), $attachment_id, $post->ID);

                 $loop++;
             }
             ?>
    </div>
    <?php
}
