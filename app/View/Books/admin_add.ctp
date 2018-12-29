<?php 
	$this->start('script');
		echo $this->Html->script('ckeditor/ckeditor');
	$this->end();
?>
<div class="books form">
	<h2><?php echo __('Thêm sách'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm danh mục'), array('controller' => 'categories', 'action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm tác giả'), array('controller' => 'writers', 'action' => 'add')); ?> 
	</div>
<?php echo $this->Form->create('Book', array('novalidate'=>true,'type'=>'file')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category_id',array('label'=>'Danh mục'));
		echo $this->Form->input('title',array('label'=>'Tên sách'));
		echo $this->Form->input('slug');
		echo $this->Form->input('image',array('label'=>'Thumbnail'));
		echo $this->Form->input('info',array('label'=>'Nội dung', 'class' => 'ckeditor'));
		echo $this->Form->input('price',array('label'=>'Giá'));
		echo $this->Form->input('sale_price',array('label'=>'Giá bán'));
		echo $this->Form->input('pages',array('label'=>'Số trang'));
		echo $this->Form->input('publisher',array('label'=>'Nhà xuất bản'));
		echo $this->Form->input('publish_date',array('label'=>'Ngày xuất bản'));
		echo $this->Form->input('link_download');
		echo $this->Form->input('Writer',array('label'=>'Tác giả'));	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
