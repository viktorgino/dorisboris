<?php
/*
 * Made by Viktor Verebelyi @viktorgino vviktor2@gmail.com
 * All rights reserverd, altough if you can read this you can pretty much do whatever you want with it, its not like I care.
 * If this code is useful for you please bump me. My email address is my PayPal address and I drunk at least 2-3 beers while doing this, so I'd appreciate if you'd buy me an other one
 * 
 */


if (!defined('ABSPATH'))
    exit;
?>

<?php
add_action('wcdn_head', 'stylesheet_init');

function stylesheet_init() {
    global $template_directory_uri;
    ?>
    <link rel="stylesheet" href="<?php echo $template_directory_uri . '/css/bootstrap.css'; ?>" type="text/css" media="screen,print" />
    <link rel="stylesheet" href="<?php echo $template_directory_uri . '/css/font-awesome.min.css'; ?>" type="text/css" media="screen,print" />
    <?php
}

function wcdn_company_logo2() {
    global $wcdn;
    $attachment_id = wcdn_get_company_logo_id();
    $company = get_option(WooCommerce_Delivery_Notes::$plugin_prefix . 'custom_company_name');
    if ($attachment_id) {
        $attachment_src = wp_get_attachment_image_src($attachment_id, 'full', false);

        // resize the image to a 1/4 of the original size
        // to have a printing point density of about 288ppi.
        ?>
        <img src="<?php echo $attachment_src[0]; ?>" alt="<?php echo esc_attr($company); ?>" />
        <?php
    }
}
?>

<?php wcdn_get_template_content('print-header.php'); ?>

<?php
// wcdn_before_content hook
do_action('wcdn_before_content');
?>			

<?php if ($orders = wcdn_get_orders()) : ?>

    <?php
    // wcdn_before_loop hook
    do_action('wcdn_before_loop');
    ?>

    <?php foreach ($orders as $order) : ?>

        <article class="content">

            <?php do_action('wcdn_loop_content', $order, wcdn_get_template_type()); ?>

        </article><!-- .content -->

    <?php endforeach; ?>

    <?php
    // wcdn_after_loop hook
    do_action('wcdn_after_loop');
    ?>

<?php endif; ?>

<?php
// wcdn_after_content hook
do_action('wcdn_after_content');
?>

<?php wcdn_get_template_content('print-footer.php'); ?>