<div class="users form">
	<h2><?php echo __('Cập nhật người dùng'); ?></h2>
	<div class="submenu">
		<?php if ($this->data['User']['active']): ?>
				<?php echo $this->Form->postLink(__('Khóa tài khoản'), array('action' => 'lock', $this->data['User']['id']), null, __('Có chắc bạn muốn khóa tài khoản của %s?', $this->data['User']['username'])); ?>
			<?php else: ?>
				<?php echo $this->Form->postLink(__('Mở khóa tài khoản'), array('action' => 'unlock', $this->data['User']['id']), null, __('Có chắc bạn muốn mở khóa tài khoản của %s?', $this->data['User']['username'])); ?>
			<?php endif ?>
		<?php echo $this->Form->postLink(__('Xóa'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?>
		<?php echo $this->Html->link(__('Thêm nhóm mới'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('User', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>		
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('group_id');
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('email');
			echo $this->Form->input('firstname');
			echo $this->Form->input('lastname');
			echo $this->Form->input('address');
			echo $this->Form->input('phone_number');
			echo $this->Form->input('active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
