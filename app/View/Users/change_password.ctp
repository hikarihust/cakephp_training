<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Đổi mật khẩu</h4>
	<?php if (!empty($user_info)): ?>
		<?= $this->Session->flash(); ?>
		<?php if (isset($errors)): ?>
			<?= $this->element('errors'); ?>
		<?php endif ?>
		<?= $this->Form->create('User', array('class' => 'form-horizontal', 'novalidate' => true,'inputDefaults' => array('label' => false, 'div' => false, 'error' => false))); ?>
			<div class="control-group">
				<label class="control-label">Mật khẩu mới</label>
				<div class="controls">
					<?= $this->Form->input('password', array('placeholder' => 'Nhập mật khẩu mới')) ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Xác nhận mật khẩu</label>
				<div class="controls">
					<?= $this->Form->input('confirm_password', array('placeholder' => 'Xác nhận mật khẩu', 'type' => 'password')) ?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<hr>
					<?= $this->Form->button('Lưu', array('type' => 'submit', 'class' => 'col-lg-2 btn btn-primary')) ?>
				</div>
			</div>
		</form>
		<?= $this->Form->end(); ?>
	<?php else: ?>
		Bạn chưa đăng nhập, click vào đây để <?= $this->Html->link('đăng nhập', '/login') ?>
	<?php endif ?>

</div>