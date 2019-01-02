<div class="coupons form">
	<h2><?php echo __('Cập nhật mã giảm giá'); ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Xóa'), array('action' => 'delete', $this->Form->value('Coupon.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Coupon.id'))); ?>
		<?php echo $this->Html->link(__('Thêm mã giảm giá'), array('action' => 'add')); ?>
	</div>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Coupon', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('code', array('label'=>'Mã coupon'));
			echo $this->Form->input('percent',array('label'=>'% giảm giá'));
			echo $this->Form->input('description', array('label'=>'Mô tả'));
			echo $this->Form->input('time_start',array('label'=>'Ngày bắt đầu', 'dateFormat'=>'DMY', 'timeFormat'=> 24));
			echo $this->Form->input('time_end',array('label'=>'Ngày kết thúc', 'dateFormat'=>'DMY', 'timeFormat'=> 24));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
