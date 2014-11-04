<div class="content">


<?php $id = (isset($id)) ? $id : $post->ID;?>

<?php if($content = get_the_content($id)): ?>
<div class="post-content">
	<?php the_content(); ?>
</div>
<?php endif; ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>
<?php $i = 0; ?>
<?php if(get_field('content', $id)): ?>
<?php while (has_sub_field('content', $id)) : ?>
<?php
	$layout = get_row_layout();
	switch($layout){

		case 'row':	
		if(get_sub_field('column')): ?>
					
			<div class="row" style="
				<?php if (get_sub_field('background_color')): ?>background-color: <?php the_sub_field('background_color'); ?>; <?php endif; ?>
				<?php if (get_sub_field('background_image')): ?>background-image: url('<?php the_sub_field('background_image'); ?>');<?php endif; ?>
				<?php if (get_sub_field('css')):?><?php the_sub_field('css'); ?><?php endif; ?>
				">
				<div class="inner container">
				<?php if (get_sub_field('row_title')):?>
					<h1 class="row-title"><?php the_sub_field('row_title'); ?></h1>
				<?php endif; ?>
				
				<?php $total_columns = count( get_sub_field('column', $id)); ?>
				<?php while (has_sub_field('column', $id)) : ?>
					<?php
					switch($total_columns){
						case 2:
							$class = 'five';
							break;
						case 3:
							$class = 'one-third';
							break;
						case 4:
							$class = 'one-fourth';
							break;
						case 5:
							$class = 'one-fifth';
							break;
						case 6:
							$class = 'one-sixth';
							break;
						case 1:
						default:
							$class = 'ten';
							break;
					} ?>
					<div class="break-on-tablet span <?php if (get_sub_field('column_width')):?><?php the_sub_field('column_width'); ?><?php else: ?><?php echo $class; ?><?php endif; ?>" style="
					<?php if (get_sub_field('text_color')):?>color: <?php the_sub_field('text_color'); ?>;<?php endif; ?>
					">
						<?php the_sub_field('column-content'); ?>
					</div>
				<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
		
		
	<?php } ?>

	<?php $i++; ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

</div>