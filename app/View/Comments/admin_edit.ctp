<div class="comments form">
	<h2><?php echo __('Sửa nội dung'); ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Xóa'), array('action' => 'delete', $this->Form->value('Comment.id')), null, __('Bạn có đồng ý xóa nhận xét này không?')); ?></li>	
		<?php echo $this->Html->link(__('Thêm người dùng mới'), array('controller' => 'users', 'action' => 'add')); ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action' => 'add')); ?>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Comment', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>
			<div class="input">
				<h3><?php echo h($this->request->data['User']['fullname']);?> - <?php echo h($this->request->data['Book']['title']);  ?></h3>
			</div>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('content');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>