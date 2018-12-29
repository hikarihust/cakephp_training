<?php 
	$this->start('script');
		echo $this->Html->script('ckeditor/ckeditor');
	$this->end();
?>
<div class="books form">
	<h2><?php echo __('Cập nhật sách'); ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Xóa'), array('action' => 'delete', $this->Form->value('Book.id')), null, __('Bạn có đồng ý xóa hết tất cả các đánh giá về quyển sách %s không?', $this->Form->value('Book.title'))); ?>
		<?php echo $this->Html->link(__('Thêm danh mục'), array('controller' => 'categories', 'action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm tác giả'), array('controller' => 'writers', 'action' => 'add')); ?> 
	</div>
<?= $this->Session->flash(); ?>
<?php if (isset($errors)): ?>
	<?= $this->element('errors'); ?>
<?php endif ?>
<?php echo $this->Form->create('Book', array('novalidate'=>true,'type'=>'file')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category_id',array('label'=>'Danh mục'));
		echo $this->Form->input('title',array('label'=>'Tên sách', 'error'=> false));
		echo $this->Form->input('slug', array('error' =>false, 'required' => false));
		echo $this->Html->image($this->request->data['Book']['image'], array('width' => 140, 'height'=> 200));
		echo $this->Form->input('image',array('label'=>false, 'type'=> 'file', 'class' => 'input-upload'));
		echo $this->Form->input('info',array('label'=>'Nội dung', 'class' => 'ckeditor', 'error' => false));
		echo $this->Form->input('price',array('label'=>'Giá', 'error'=> false));
		echo $this->Form->input('sale_price',array('label'=>'Giá bán', 'error'=> false));
		echo $this->Form->input('pages',array('label'=>'Số trang', 'error'=> false));
		echo $this->Form->input('publisher',array('label'=>'Nhà xuất bản', 'error'=>false));
		echo $this->Form->input('publish_date',array('label'=>'Ngày xuất bản', 'error'=> false));
		echo $this->Form->input('link_download', array('error' =>false));
		echo $this->Form->input('Writer',array('label'=>'Tác giả'));	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
