<div class="groups form">
	<h2><?php echo __('Thêm nhóm mới'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm người dùng mới'), array('controller' => 'users', 'action' => 'add')); ?>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Group', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('description');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
