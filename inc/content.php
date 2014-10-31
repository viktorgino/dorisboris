<div class="content">
<?php $id = (isset($id)) ? $id : $post->ID;?>

<?php if($content = get_the_content($id)): ?>
<div class="post-content">
	<?php the_content(); ?>
</div>
<?php endif; ?>

<?php 
if(get_field('content', $id)) :
	while (has_sub_field('content', $id)) :
		$layout = get_row_layout();
		$file = str_replace('_', '-', $layout);

		locate_template('inc/content/' . $file .'.php', true, false);
	endwhile;
endif;
?>
</div>