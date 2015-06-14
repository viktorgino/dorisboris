<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$has_row = false;
$alt = 1;
$attributes = $product->get_attributes();

ob_start();
?>
<table class="shop_attributes">
    <?php
    $variation_attributes;
    if ($product->has_child()) {
        foreach ($product->get_available_variations() as $key => $variation) {
            $name;
            $dimensions;
            $weight;
            $variation_obj = $product->get_child($variation['variation_id']);
            unset($dimensions);
            if ($variation_obj->has_dimensions() && $variation_obj->get_dimensions() != $product->get_dimensions()) {
                $variation_attributes['dimension_set'] = true;
                $dimensions = array('dimensions' => $variation_obj->get_dimensions());
            }
            unset($weight);
            if ($variation_obj->has_weight() && $variation_obj->get_weight() != $product->get_weight()) {
                $variation_attributes['weight_set'] = true;
                $weight = array('weight' => $variation_obj->get_weight());
            }
            unset($name);
            foreach ($attributes as $attribute) {
                $name[] = wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names', 'slug' => array_values($variation['attributes'])))[0];
            }
            $name = array('name' => implode(" ", $name));
            $variation_attributes['attributes'][] = array_merge((array) $name, (array) $dimensions, (array) $weight);
        }
    }
    ?>
    <?php if ($variation_attributes['weight_set']) : ?>
        <tr class="weight<?php if (( $alt = $alt * -1 ) == 1) echo ' alt'; ?>">
            <th><?php _e('Weight', 'woocommerce') ?></th>
            <td class="product_weight">
                <?php foreach ($variation_attributes['attributes'] as $variation_attribute): ?>
                    <?php if (array_key_exists("weight", $variation_attribute)): ?>
                        <?php echo $variation_attribute['name'] ?>:<br/><?php echo $variation_attribute['weight'] . ' ' . esc_attr(get_option('woocommerce_weight_unit')) ?><br/>
                    <?php endif; ?>
                <?php endforeach; ?>
        </tr>
    <?php else: ?>
        <?php if ($product->has_weight()) : $has_row = true; ?>
            <tr class="weight<?php if (( $alt = $alt * -1 ) == 1) echo ' alt'; ?>">
                <th><?php _e('Weight', 'woocommerce') ?></th>
                <td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr(get_option('woocommerce_weight_unit')); ?></td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($product->enable_dimensions_display()) : ?>
        <?php if ($variation_attributes['dimension_set']) : ?>
            <tr class="dimensions<?php if (( $alt = $alt * -1 ) == 1) echo ' alt'; ?>">
                <th><?php _e('Dimensions', 'woocommerce') ?></th>
                <td class="product_dimensions">
                    <?php foreach ($variation_attributes['attributes'] as $variation_attribute): ?>
                        <?php if (array_key_exists("dimensions", $variation_attribute)): ?>
                            <?php echo $variation_attribute['name'] ?>:<br/><?php echo $variation_attribute['dimensions'] ?><br/>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php else: ?>
            <?php if ($product->has_dimensions()) : $has_row = true; ?>
                <tr class="dimensions<?php if (( $alt = $alt * -1 ) == 1) echo ' alt'; ?>">
                    <th><?php _e('Dimensions', 'woocommerce') ?></th>
                    <td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    foreach ($attributes as $attribute) :
        if (empty($attribute['is_visible']) || ( $attribute['is_taxonomy'] && !taxonomy_exists($attribute['name']) )) {
            continue;
        } else {
            $has_row = true;
        }
        ?>
        <tr class="<?php if (( $alt = $alt * -1 ) == 1) echo 'alt'; ?>">
            <th><?php echo wc_attribute_label($attribute['name']); ?></th>
            <td><?php
                if ($attribute['is_taxonomy']) {

                    $values = wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names'));
                    echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
                } else {

                    // Convert pipes to commas and display values
                    $values = array_map('trim', explode(WC_DELIMITER, $attribute['value']));
                    echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
                }
                ?></td>
        </tr>
    <?php endforeach; ?>

</table>
<?php
if ($has_row) {
    echo ob_get_clean();
} else {
    ob_end_clean();
}
