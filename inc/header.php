<div id="page-header">
	<?php if(is_product_category()): ?>
		<?php 
			$queried_object = get_queried_object();
			$taxonomy = $queried_object->taxonomy;
			$taxonomy_name = $queried_object->name;
			$term_id = $queried_object->term_id;

			$header_content = get_field('category_header_content', $queried_object);		 
			$cat_bg = get_field('category_header_background', $taxonomy . '_' . $term_id);			
		?>	
		<?php if($header_content): ?>
		<div class="page-header" style="background: url(<?php echo $cat_bg; ?>);">
				<div class="inner">
					<?php echo $header_content; ?>
				</div>					
		</div>
		<?php endif; ?>
	<?php elseif(is_page()): ?>
		<?php 
			$header = get_field( "header_content", $post->ID );
		 ?>
		<?php if($header): ?>
			<div class="page-header">
				<div class="inner">
					<?php echo($header);?>
				</div>
			</div>
		<?php else: ?>
		<?php endif; ?>	
	<?php endif; ?>
</div>
