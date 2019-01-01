<div class="writers form">
	<h2><?php echo __('Thêm tác giả'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action'=>'add')) ?>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Writer', array('novalidate' => true, 'inputDefaults'=> array('error' => false))) ?>
	<fieldset>
		<?php 
			echo $this->Form->input('name', array('label' => 'Tên tác giả'));
			echo $this->Form->input('slug', array('required' => false));
			echo $this->Form->input('biography', array('label' => 'Tiểu sử'));
			echo $this->Form->input('Book', array('label' => 'Sách cùng tác giả'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>