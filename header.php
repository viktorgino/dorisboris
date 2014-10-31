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
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_template_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">

    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="tortilla">
	<header id="header" role="banner">
		<div class="top">
			<div class="container">		
			</div>
		</div>
		<div class="bottom">
			<div class="container">
				<div class="span two">
					<h1 class="logo-container">
						<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php // bloginfo( 'name' ); ?></a>
					</h1>	
				</div>
				<div class="span eight primary">
					<nav>
						<button class="menu-btn"></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'primary-navigation navigation', 'depth' => 2, 'container_id' => 'header-navigation' )); ?>			
					</nav>			
				</div>	
				<div id="dl-menu" class="dl-menuwrapper mobile-navigation">
					<button class="dl-trigger">Open Menu</button>
					<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'dl-menu', 'depth' => 4, 'container' => '' )); ?>		
				</div><!-- /dl-menuwrapper -->							
			</div>
		</div><!-- .bottom -->
		<?php if(!$post->post_parent){
			$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_column=menu_order");
		}else{
			if($post->ancestors) {
				$ancestors = end($post->ancestors);
				$children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0");
			}
		} ?>
		<?php if ($children): ?>
			<div id="subnav">
				<div class="container">
					<ul>
						<?php echo $children; ?>
					</ul>
				</div>
			</div>							
		<?php endif; ?>	<!-- #subnav -->		

	</header><!-- #header -->
	<div id="main" class="site-main" role="main">