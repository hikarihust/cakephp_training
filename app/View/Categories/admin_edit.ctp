<div class="categories form">
	<h2><?php echo __('Cập nhật danh mục'); ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), null, __('Bạn có đồng ý xóa hết tất cả các sách trong danh mục này?')); ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action' => 'add')); ?> 
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
<?php echo $this->Form->create('Category', array('novalidate' => true)); ?>
	<fieldset>
	<div class="input">
		<?php echo $this->Form->select('parent_id',$categories,array('empty'=>'---Chọn danh mục---')); ?>
	</div>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('error' =>false));
		echo $this->Form->input('slug', array('required' => false, 'error' => false));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
