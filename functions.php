<?php

define( 'THEME_NAME', 'dorisboris');

define( 'BFITHUMB_UPLOAD_DIR', 'resampled' );

$template_directory = get_template_directory();

$template_directory_uri = get_template_directory_uri();

require( $template_directory . '/inc/default/functions.php' );

require( $template_directory . '/inc/default/hooks.php' );

require( $template_directory . '/inc/default/shortcodes.php' );

// Custom Actions

add_action( 'after_setup_theme', 'custom_setup_theme' );

add_action( 'init', 'custom_init');

add_action( 'wp', 'custom_wp');

add_action( 'widgets_init', 'custom_widgets_init' );

add_action( 'wp_enqueue_scripts', 'custom_scripts', 30);

add_action( 'wp_print_styles', 'custom_styles', 30);


// Custom Filters

add_filter( 'pre_get_posts', 'custom_pre_get_posts');

add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );

add_filter( 'the_content_feed', 'custom_the_content_feed', 10, 2);


//Custom shortcodes


function custom_setup_theme() {
	
	add_theme_support( 'post-thumbnails' );

	add_theme_support('woocommerce');

	add_theme_support('editor_style');

	add_post_type_support('page', 'excerpt');

	register_nav_menus( array(
		'primary' => __( 'Primary', THEME_NAME ),
		'footer' => __( 'Footer', THEME_NAME )
	) );

	add_editor_style('css/editor-style.css');

	add_image_size( 'slider', 1172, 375, true);


}

function custom_init(){
	global $template_directory, $wp_taxonomies;

	require( $template_directory . '/inc/classes/bfi-thumb.php' );

	require( $template_directory . '/inc/classes/custom-post-type.php' );


	// if(function_exists('get_field')) {	

	// 	$scrapbook_page = get_field('scrapbook_page', 'options');

	// 	if( !empty($scrapbook_page->ID) ){
	// 		$scrapbook_uri = get_page_uri($scrapbook_page->ID);

	// 		$scrapbook = new Custom_Post_Type( 'Scrapbook', 
	// 			array(
	// 				'rewrite' => array('with_front' => false, 'slug' => $scrapbook_uri),
	// 				'capability_type' => 'post',
	// 				'publicly_queryable' => true,
	// 				'has_archive' => true, 
	// 				'hierarchical' => false,
	// 				'menu_position' => null,
	// 				'supports' => array('title', 'editor'),
	// 				'plural' => "Scrapbook"					
	// 			)
	// 		);							
	// 	}		

	// }
}

function custom_wp(){
	
}

function custom_widgets_init() {
	global $template_directory;

	//********************** Content ***********************/

	register_sidebar( array(
		'name' => __( 'Sidebar', THEME_NAME ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget span one-third %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title text-center light-brown uppercase">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', THEME_NAME ),
		'id' => 'footer',
		'before_widget' => '<aside id="%1$s" class="widget span two-and-half %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title text-center light-brown uppercase">',
		'after_title' => '</h5>',
	) );	
}

function custom_scripts() {
	global $template_directory_uri;

	
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.min.js');
	wp_enqueue_script('owlcarousel', $template_directory_uri.'/js/plugins/jquery.owlcarousel.js', array('jquery'), '', true);
	wp_enqueue_script('dl-menu', $template_directory_uri.'/js/plugins/jquery.dlmenu.js', array('jquery'), '', true);
	wp_enqueue_script('main', $template_directory_uri.'/js/main.js', array('jquery'), '', true);
}


function custom_styles() {
	global $wp_styles, $template_directory_uri;

	wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );	
	wp_enqueue_style( 'fonts', '//fast.fonts.net/cssapi/ba131fe1-e71a-4fd6-83e4-29c24022bc46.css' );	
}

function custom_pre_get_posts( $query ) {
	
	if ( $query->get('post_type') == 'press_release' ) {
		$query->set('posts_per_page', 4);
	}

	return $query;
}

//remove Woocommerce Default Sorting Dropdown
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//include Woo PrettyPhoto to all pages
add_action( 'wp_enqueue_scripts', 'frontend_scripts_include_lightbox' );
 
function frontend_scripts_include_lightbox() {
  global $woocommerce;
 
  $suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;
 
  if ( $lightbox_en ) {
    wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), '3.1.5', true );
    wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
    wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
  }
}

