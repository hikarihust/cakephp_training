<div class="books index">
	<h2><?php echo __('Sách bán chạy'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm sách'), array('action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm danh mục'), array('controller' => 'categories', 'action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm mã giảm giá'), array('controller' => 'coupons', 'action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm tác giả'), array('controller' => 'writers', 'action' => 'add')); ?> 
	</div>

	<table cellpadding="0" cellspacing="0">
		<th><?php echo $this->Paginator->sort('category_id','Danh mục'); ?></th>
		<th><?php echo $this->Paginator->sort('title', 'Tên sách'); ?></th>
		<th><?php echo $this->Paginator->sort('image', 'Thumbnail'); ?></th>
		<th><?php echo $this->Paginator->sort('sale_price', 'Giá bán'); ?></th>			
		<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
		<th><?php echo $this->Paginator->sort('modified','Ngày chỉnh sửa'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		<?php echo $this->element('admin/books', array('books'=>$books)); ?>
	</table>
	<?php echo $this->element('admin/pagination', array('object'=>'quyển sách')); ?>
</div>