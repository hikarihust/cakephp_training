<div class="categories view">
	<h2><?php  echo __('Category: '.$category['Category']['name']); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Cập nhật danh mục'), array('action' => 'edit', $category['Category']['id'])); ?> 
		<?php echo $this->Form->postLink(__('Xóa danh mục'), array('action' => 'delete', $category['Category']['id']), null, __('Bạn có đồng ý xóa tất cả các sách hiện tại có trong danh mục %s không?', $category['Category']['name'])); ?> 
		<?php echo $this->Html->link(__('Thêm danh mục'), array('action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action' => 'add')); ?> 
	</div>
	<div class="related">
		<?php if (!empty($category['Book'])): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>			
			<th><?php echo __('Tên sách'); ?></th>
			<th><?php echo __('Thumbnail'); ?></th>
			<th><?php echo __('Giá bán'); ?></th>			
			<th><?php echo __('Ngày tạo'); ?></th>
			<th><?php echo __('Ngày chỉnh sửa'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
			foreach ($category['Book'] as $book): 
		?>
		<tr>
			<td>
				<?php echo $this->Html->link($book['title'],'/'.$book['slug']); ?>&nbsp;
			</td>
			<td><?php echo $this->Html->image($book['image']); ?>&nbsp;</td>
			<td><?php echo $this->Number->currency($book['sale_price'],' VND',array('places'=>0,'wholePosition'=>'after')); ?>&nbsp;</td>
			<td><?php echo $this->Time->format('d-m-Y H:i:s',$book['created'],false,'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
			<td><?php echo $this->Time->format('d-m-Y H:i:s',$book['modified'],false,'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('controller'=>'books','action' => 'edit', $book['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'books','action' => 'delete', $book['id']), null, __('Bạn có đồng ý xóa quyển %s không?', $book['title'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>