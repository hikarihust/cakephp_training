<div class="categories form">
	<h2><?php echo __('Cập nhật danh mục'); ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), null, __('Bạn có đồng ý xóa hết tất cả các sách trong danh mục này?')); ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action' => 'add')); ?> 
	</div>
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
	<div class="input">
		<?php echo $this->Form->select('parent_id',$categories,array('empty'=>'---Chọn danh mục---')); ?>
	</div>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
