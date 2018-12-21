<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Đăng nhập</h4>
	<?php echo $this->Session->flash('auth'); ?>
	<?= $this->Form->create('User', array('class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
		<div class="control-group">
			<label class="control-label" for="inputUsername">Username</label>
			<div class="controls">
				<?= $this->Form->input('username', array('placeholder' => 'Tên đăng nhập')) ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
				<?= $this->Form->input('password', array('placeholder' => 'Mật khẩu')) ?>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<hr>
				<?= $this->Form->button('Đăng nhập', array('type' => 'submit', 'class' => 'col-lg-2 btn btn-primary')) ?>
			</div>
		</div>
	</form>
	<?= $this->Form->end(); ?>

</div>