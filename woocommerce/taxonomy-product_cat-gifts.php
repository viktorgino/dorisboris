<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

get_header('shop');
?>
<div id="gifts">
    <?php
    /**
     * woocommerce_before_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action('woocommerce_before_main_content');
    ?>

    <?php do_action('woocommerce_archive_description'); ?>

    <?php if (have_posts()) : ?>

        <?php
        /**
         * woocommerce_before_shop_loop hook
         *
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action('woocommerce_before_shop_loop');
        ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php woocommerce_product_subcategories(); ?>

        <?php while (have_posts()) : the_post(); ?>
            <?php
            global $product, $woocommerce_loop;

            // Store loop count we're currently on
            if (empty($woocommerce_loop['loop']))
                $woocommerce_loop['loop'] = 0;

            // Store column count for displaying the grid
            if (empty($woocommerce_loop['columns']))
                $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);

            // Ensure visibility
            if (!$product || !$product->is_visible())
                return;

            // Increase loop count
            $woocommerce_loop['loop'] ++;

            // Extra post classes
            $classes = array();
            if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
                $classes[] = 'first';
            if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
                $classes[] = 'last';
            ?>

            <li <?php post_class($classes); ?>>

                <?php do_action('woocommerce_before_shop_loop_item'); ?>

                <a href="<?php the_permalink(); ?>">
                    <div class="gift-top equal-height">

                        <h3><?php the_title(); ?></h3>

                        <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_template_loop_rating - 5
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        do_action('woocommerce_after_shop_loop_item_title');
                        ?>
                    </div>
                    <table>
                        <tr>
                            <td>
                                <img src="<?php do_action('woocommerce_before_shop_loop_item_title'); ?>" />
                            </td>
                        </tr>
                    </table>

                </a>

                <?php do_action('woocommerce_after_shop_loop_item'); ?>

            </li>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
        /**
         * woocommerce_after_shop_loop hook
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');
        ?>

    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

        <?php wc_get_template('loop/no-products-found.php'); ?>

    <?php endif; ?>

    <?php
    /**
     * woocommerce_after_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');
    ?>

    <?php
    /**
     * woocommerce_sidebar hook
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action('woocommerce_sidebar');
    ?>
</div>

<?php get_footer('shop'); ?>