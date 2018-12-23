<div class="alert alert-danger">
	<?php foreach($errors as $val1): ?>
		<?php foreach($val1 as $val2): ?>
			<?php echo $val2; ?> <br>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>