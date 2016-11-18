<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $post, $woocommerce, $product;
?>
<div class="product-gallery">
    <table class = "main-image">
        <tr>
            <td>
                <a target="_blank" itemprop = "image" title = "" >

                    <?php
                    if (has_post_thumbnail()) {

                        $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
                        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                        $image = get_the_post_thumbnail($post->ID,
                                                        'shop_single',
                                                        array(
                            'title' => $image_title
                                ));

                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),
                                                             'shop_single');
                        $image_thumb = $thumb['0'];
                        echo apply_filters('woocommerce_single_product_image_html',
                                           sprintf('<div class="img" style="background-image:url(\' %s \')"></div>',
                                                   $image_thumb), $post->ID);
                    } else {

                        echo apply_filters('woocommerce_single_product_image_html',
                                           sprintf('<div class="img" style="background-image:url(\' %s \')"></div>',
                                                   wc_placeholder_img_src(),
                                                   __('Placeholder',
                                                      'woocommerce')));
                    }
                    ?>
                </a>
                <img class = "loader" src = "<?php echo get_template_directory_uri() ?>/images/misc/loading.gif" style = "display:none">
            </td>
        </tr>
    </table>

<?php do_action('woocommerce_product_thumbnails'); ?>
</div>
