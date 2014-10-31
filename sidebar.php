<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package epigeum
 * @since epigeum 1.0
 */
?>
<div id="sidebar" role="complementary">
	<?php 
	if ( class_exists('acf_Widget') ) {
		acf_Widget::dynamic_widgets( 'acf_sidebar' );
	} else {
		dynamic_sidebar( 'default' ); 
	}
	?>
</div><!-- #sidebar -->