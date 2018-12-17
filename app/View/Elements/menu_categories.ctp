<?php 
	$categories = $this->requestAction('/categories/menu');
?>
<?php if (!empty($categories)): ?>
	<ul>
		<?php foreach ($categories as $category): ?>
			<li>
				<?= $this->Html->link($category['Category']['name'], '/danh-muc/'.$category['Category']['slug']) ?>
			</li>	
		<?php endforeach ?>
	</ul>	
<?php endif ?>	
