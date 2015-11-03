<?php
/*
 * by Viktor Verebelyi @viktorgino viktor@verebelyi.com
 */
if (!defined('ABSPATH'))
    exit;
?>

<div class="row">
    <div class="col-xs-6">
        <h1>
            <?php if (wcdn_get_company_logo_id()) : ?><?php wcdn_company_logo2(); ?><?php endif; ?>
        </h1>
    </div>
    <div class="col-xs-6 text-right">
        <h1><?php wcdn_document_title(); ?></h1>
        <h1><small>Order Number <?php echo $order->id ?></small></h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>From: <?php wcdn_company_name(); ?></h4>
            </div>
            <div class="panel-body">
                <?php wcdn_company_info(); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6 text-right">
        <?php if (wcdn_get_template_type() == "invoice"): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Billing to : <?php echo $order->billing_first_name ?> <?php echo $order->billing_last_name ?></h4>
                </div>
                <div class="panel-body">
                    <?php
                    if (!$order->get_formatted_billing_address())
                        _e('N/A', 'woocommerce-delivery-notes');
                    else
                        echo apply_filters('wcdn_address_billing', $order->get_formatted_billing_address(), $order);
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (wcdn_get_template_type() == "delivery-note"): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Shipping to : <?php echo $order->billing_first_name ?> <?php echo $order->billing_last_name ?></h4>
                </div>
                <div class="panel-body">
                    <?php
                    if (!$order->get_formatted_shipping_address())
                        _e('N/A', 'woocommerce-delivery-notes');
                    else
                        echo apply_filters('wcdn_address_shipping', $order->get_formatted_shipping_address(), $order);
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- / end client details section -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
    <h4>Product</h4>
</th>
<th>
<h4>Price</h4>
</th>
<th>
<h4>Quantity</h4>
</th>
<th>
<h4>Sub Total</h4>
</th>
</tr>
</thead>
<tbody>
    <?php if (sizeof($order->get_items()) > 0) : ?>
        <?php foreach ($order->get_items() as $item) : ?>

            <?php
            $product = apply_filters('wcdn_order_item_product', $order->get_product_from_item($item), $item);
            $item_meta = new WC_Order_Item_Meta($item['item_meta'], $product);
            ?>

            <tr>
                <td class="product-name">
                    <?php do_action('wcdn_order_item_before', $product, $order); ?>

                    <span class="name"><?php echo apply_filters('wcdn_order_item_name', $item['name'], $item); ?></span>

                    <?php $item_meta->display(); ?>

                    <dl class="extras">
                        <?php if ($product && $product->exists() && $product->is_downloadable() && $order->is_download_permitted()) : ?>

                            <dt><?php _e('Download:', 'woocommerce-delivery-notes'); ?></dt>
                            <dd><?php printf(__('%s Files', 'woocommerce-delivery-notes'), count($order->get_item_downloads($item))); ?></dd>

                        <?php endif; ?>

                        <?php
                        $fields = apply_filters('wcdn_order_item_fields', array(), $product, $order);
                        foreach ($fields as $field) :
                            ?>

                            <dt><?php echo $field['label']; ?></dt>
                            <dd><?php echo $field['value']; ?></dd>

                        <?php endforeach; ?>
                    </dl>
                </td>
                <td class="product-item-price">
                    <span><?php echo wcdn_get_formatted_item_price($order, $item); ?></span>
                </td>
                <td class="product-quantity">
                    <span><?php echo apply_filters('wcdn_order_item_quantity', $item['qty'], $item); ?></span>
                </td>
                <td class="product-price">
                    <span><?php echo $order->get_formatted_line_subtotal($item); ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
</table>
<div class="row text-right">
    <div class="col-xs-4 col-xs-offset-4">
        <p>
            <strong>
                <?php if ($totals = $order->get_order_item_totals()) : ?>
                    <?php foreach ($totals as $total) : ?>
                        <?php echo $total['label']; ?><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </strong>
        </p>
    </div>
    <div class="col-xs-4">
        <strong>
            <?php if ($totals = $order->get_order_item_totals()) : ?>
                <?php foreach ($totals as $total) : ?>
                    <?php echo $total['value']; ?><br>
                <?php endforeach; ?>
            <?php endif; ?>
        </strong>
    </div>
</div>
<div class="row">
    <div class="col-xs-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Our Company details</h4>
            </div>
            <div class="panel-body"><?php wcdn_imprint(); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-7">
        <div class="span7">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Contact Details</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-twitter"></i>/dorisandboris<br>
                            <i class="fa fa-facebook"></i>/dorisandboris<br>
                        </div>
                        <div class="col-xs-6">
                            <i class="fa fa-pinterest-p"></i>/dorisandboris1<br>
                            <i class="fa fa-instagram"></i>/dorisboris<br>
                        </div>
                    </div>
                    <i class="fa fa-envelope"></i>queries@dorisandboris.co.uk<br>
                </div>
            </div>
        </div>
    </div>
</div>