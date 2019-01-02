<div class="coupons form">
	<h2><?php echo __('Thêm mã giảm giá') ?></h2>
	<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?php echo $this->Form->create('Coupon', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
		<fieldset>
			<?php 
				echo $this->Form->input('code', array('label'=> 'Mã coupon'));
				echo $this->Form->input('percent', array('label'=> '% giảm giá', 'min' => 0));
				echo $this->Form->input('description', array('label'=> 'Mô tả'));
				echo $this->Form->input('time_start', array('label'=> 'Ngày bắt đầu', 'dateFormat'=>'DMY', 'timeFormat'=> 24));
				echo $this->Form->input('time_end', array('label'=> 'Ngày kết thúc', 'dateFormat'=>'DMY', 'timeFormat'=> 24));
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>