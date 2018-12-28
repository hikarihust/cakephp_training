<?php 
	$categories = $this->requestAction('/categories/menu');
?>
<?php if (!empty($categories)): ?>
	<?php echo $this->Display->menu($categories); ?>	
<?php endif ?>	
