<div class="books index">
	<h2><?php echo __('Sách mới'); ?></h2>
	<h4> <?= $this->Html->link('Xem thêm', '/sach-moi') ?> </h4>
	<?php //pr($books); ?>
	<?= $this->element('books', array('books', $books))  ?>
</div>
