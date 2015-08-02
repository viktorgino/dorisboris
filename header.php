<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package dorisboris
 * @since dorisboris 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 7]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link href="<?php echo get_template_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">

        <script type="text/javascript">
            var themeUrl = '<?php bloginfo('template_url'); ?>';
            var baseUrl = '<?php bloginfo('url'); ?>';
        </script>
        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
        <div id="tortilla" class="<?php the_field('colour_scheme', 'options'); ?>">
            <header id="header" role="banner">
                <div class="top" <?php if (get_field('header_color', 'options')): ?>style="background-color: <?php the_field('header_color', 'options'); ?>" <?php endif; ?>>
                    <div class="container">		
                        <div class="first span one-third ecommerce-options">
                            <?php if (is_user_logged_in()): ?>
                                <?php $redirect_url = (isset($post->ID)) ? get_permalink($post->ID) : home_url(); ?>
                                <a class="btn account-btn" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                    <i class="icon icon-account"></i>
                                    <?php _e("My Account", 'ivip'); ?>
                                </a>
                            <?php else: ?>
                                <a class="btn logout-btn" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                    <i class="icon icon-account"></i>
                                    <?php _e("Login", 'ivip'); ?>
                                </a>	
                            <?php endif; ?>									
                        </div>

                        <div class="span logo-wrap one-third">
                            <h1 class="logo-container">
                                <a class="logo" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php // bloginfo( 'name' );  ?></a>
                            </h1>						
                        </div>
                        <div class="span one-third ecommerce-options">	
                            <?php if (is_user_logged_in()): ?>
                                <?php $redirect_url = (isset($post->ID)) ? get_permalink($post->ID) : home_url(); ?>
                                <a class="btn last account-btn" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                    <i class="icon icon-account"></i>
                                    <?php _e("My Account", 'ivip'); ?>
                                </a>
                            <?php else: ?>
                                <a class="btn last logout-btn" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                    <i class="icon icon-account"></i>
                                    <?php _e("Login", 'ivip'); ?>
                                </a>	
                            <?php endif; ?>									
                            <?php global $woocommerce; ?>	
                            <a class="btn cart-btn" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping bag', 'woothemes'); ?>">
                                <i class="icon icon-basket"></i>
                                <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
                            </a>
                            <a class="btn search-btn" href="#" title="Search Doris &amp; Boris">
                                <i class="icon icon-search"></i>
                                <span><?php _e("Search", 'dorisboris'); ?></span>
                            </a>					
                        </div>
                    </div><!-- container -->
                    <div id="search-bar">
                        <div class="container">
                            <?php get_search_form(); ?>	
                        </div>
                    </div>
                </div><!-- .top -->
                <div class="bottom">
                    <div class="container">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'primary-navigation navigation', 'depth' => 2, 'container_id' => 'header-navigation')); ?>			

                    </div>
                </div><!-- .bottom -->

                <div id="dl-menu" class="dl-menuwrapper mobile-navigation">	
                    <button class="dl-trigger">Open Menu</button>
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'dl-menu', 'depth' => 4, 'container' => '')); ?>					
                </div><!-- /dl-menuwrapper -->		

            </header><!-- #header -->

            <!-- site header -->
            <?php get_template_part('inc/header'); ?>

            <div id="main" class="site-main" role="main">
                <div class="container">