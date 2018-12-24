<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Đăng ký</h4>
	<?php if (empty($user_info)): ?>
		<?php if (isset($errors)): ?>
			<?= $this->element('errors'); ?>
		<?php endif ?>
		<?= $this->Form->create('User', array('class' => 'form-horizontal', 'novalidate' => true, 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false))) ?>
			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<?= $this->Form->input('lastname', array('placeholder' => 'Họ')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">First Name</label>
				<div class="controls">
					<?= $this->Form->input('firstname', array('placeholder' => 'Tên')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Username</label>
				<div class="controls">
					<?= $this->Form->input('username', array('placeholder' => 'Tên đăng nhập')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls">
					<?= $this->Form->input('email', array('placeholder' => 'Địa chỉ email')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls">
					<?= $this->Form->input('password', array('placeholder' => 'Mật khẩu')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Confirm Password</label>
				<div class="controls">
					<?= $this->Form->input('confirm_password', array('placeholder' => 'Xác nhận mật khẩu', 'type' => 'password')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Address</label>
				<div class="controls">
					<?= $this->Form->input('address', array('placeholder' => 'Địa chỉ')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Phone</label>
				<div class="controls">
					<?= $this->Form->input('phone_number', array('placeholder' => 'Số điện thoại')) ?>
				</div>
			</div>
			<div class="control-group">
				<?php $policy = '<strong>Tôi đồng ý với các '.$this->Html->link('điều khoản','/dieu-khoan').' mà trang web này đã đưa ra.</strong>'; ?>
				<label class="checkbox">
					<?= $this->Form->input('confirm', array('type'=>'checkbox', 'label'=> $policy, 'escape'=>true)) ?>
				</label>
			</div>
			<hr>
			<div class="form-actions">
				<?php echo $this->Form->button('Đăng ký', array('type'=>"submit", 'class'=>"col-lg-2 btn btn-primary")); ?>
			</div>
		<?= $this->Form->end(); ?>
	<?php else: ?>
		Bạn đã đăng nhập, click vào <?php echo $this->Html->link('đây','/'); ?> để quay về trang chủ.
	<?php endif ?>

</div>