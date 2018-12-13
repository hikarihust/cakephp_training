<div class="writers index">
	<h2><?php echo __('Các tác giả'); ?></h2>
	<p>
		<?= $this->Paginator->sort('name', 'Sắp xếp theo thứ tự ngược lại'); ?> |
	</p>

	<?php foreach ($writers as $writer): ?>
		<?php echo $writer['Writer']['name']; ?> <br>
		<br>
	<?php endforeach ?>
	<?= $this->element('pagination', array('object'=>'tác giả')); ?>
</div>