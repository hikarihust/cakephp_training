<?php 
	$categories = $this->requestAction('/categories/menu');
?>
<?php if (!empty($categories)): ?>
	<?php foreach ($categories as $category): ?>
		<?= $this->Html->link($category['Category']['name'], '/danh-muc/'.$category['Category']['slug']) ?> <br>
	<?php endforeach ?>
<?php endif ?>	