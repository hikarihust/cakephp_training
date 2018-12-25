<div class="panel panel-info">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-user"></i> Quên mật khẩu
	</h4>
	<?= $this->Session->flash('forgot'); ?>
	<?= $this->Form->create('User', array('class' => 'form-horizontal', 'novalidate' => true,'inputDefaults' => array('label' => false, 'div' => false, 'error' => false))); ?>	
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<?= $this->Form->input('email', array('placeholder' => 'Điền email của bạn để lấy lại mật khẩu')); ?>
			</div>
		</div>
		<hr>
		<div class="form-actions">
			<button type="submit" class="col-lg-2 btn btn-primary">Cấp lại mật khẩu</button>
		</div>
	<?= $this->Form->end(); ?>
</div>