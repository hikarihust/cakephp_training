<div class="categories form">
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Category', array('novalidate' => true)); ?>
		<fieldset>
			<legend><?php echo __('Add Category'); ?></legend>
		<div class="input">
			<?php echo $this->Form->select('parent_id', $categories, array('empty' => '---Chọn danh mục---')); ?>
		</div>
		<?php
			echo $this->Form->input('name', array('error' =>false));
			echo $this->Form->input('slug', array('required' => false, 'error' => false));
			echo $this->Form->input('description');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
