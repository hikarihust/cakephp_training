<div class="users form">
	<h2><?php echo __('Thêm người dùng'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm nhóm mới'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('User', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>
		<?php
			echo $this->Form->input('group_id');
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('email');
			echo $this->Form->input('firstname');
			echo $this->Form->input('lastname');
			echo $this->Form->input('address');
			echo $this->Form->input('phone_number');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>