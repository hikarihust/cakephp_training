<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Liên hệ</h4>
	<p>Điền thông tin vào form bên dưới để liên hệ với chúng tôi. Chúng tôi sẽ trả lời liên hệ của bạn trong thời gian sớm nhất.</p>
	<hr>
	<?php echo $this->Session->flash(); ?>
	<?php if (isset($errors)): ?>
		<?php echo $this->element('errors'); ?>
	<?php endif ?>
		<?php echo $this->Form->create('Page', array('novalidate'=>true,'class'=>'form-horizontal','inputDefaults'=> array('label'=>false, 'error'=> false, 'required'=>true))); ?>
			<div class="control-group">
			    <label class="control-label" for="inputEmail">Họ và Tên</label>
			    <div class="controls">
			      <?php echo $this->Form->input('fullname', array('placeholder'=> 'Họ và Tên')); ?>
			    </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Email</label>
				<div class="controls">
				  <?php echo $this->Form->input('email', array('placeholder'=> 'Địa chỉ email')); ?>
				</div>
			</div>
			<div class="control-group">
			    <label class="control-label" for="inputEmail">Nội dung</label>
			    <div class="controls">
			      <?php echo $this->Form->input('content', array('placeholder'=> 'Nội dung liên hệ', 'type'=> 'textarea')); ?>
			    </div>
			</div>
			<hr>
			<div class="form-actions">
			  <?php echo $this->Form->button('Gửi', array('type'=>"submit", 'class'=>"col-lg-2 btn btn-primary")); ?>
			</div>
		<?php echo $this->Form->end(); ?>
</div>
