<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Cập nhật thông tin</h4>
	<?= $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?= $this->element('errors'); ?>
	<?php endif ?>
	<?= $this->Form->create('User', array('class' => 'form-horizontal', 'novalidate' => true,'inputDefaults' => array('label' => false, 'div' => false, 'error' => false))); ?>
		<div class="control-group">
		    <label class="control-label" for="inputEmail">Last Name</label>
		    <div class="controls">
		      <?= $this->Form->input('lastname', array('placeholder'=> 'Họ')); ?>
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputEmail">First Name</label>
		    <div class="controls">
		      <?= $this->Form->input('firstname', array('placeholder'=> 'Tên')); ?>
		    </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			  <?= $this->Form->input('email', array('placeholder'=> 'Địa chỉ email')); ?>
			</div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputEmail">Address</label>
		    <div class="controls">
		      <?= $this->Form->input('address', array('placeholder'=> 'Địa chỉ')); ?>
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputEmail">Phone</label>
		    <div class="controls">
		      <?= $this->Form->input('phone_number', array('placeholder'=> 'Số điện thoại')); ?>
		    </div>
		</div>
		<hr>
		<div class="form-actions">
		  <?= $this->Form->button('Cập nhật', array('type'=>"submit", 'class'=>"col-lg-2 btn btn-primary")); ?>
		</div>
	<?= $this->Form->end(); ?>
</div>