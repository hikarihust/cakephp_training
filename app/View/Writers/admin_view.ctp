<div class="writers view">
<h2><?php  echo __('Writer'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Edit Writer'), array('action' => 'edit', $writer['Writer']['id'])); ?> 
		<?php echo $this->Form->postLink(__('Delete Writer'), array('action' => 'delete', $writer['Writer']['id']), null, __('Are you sure you want to delete # %s?', $writer['Writer']['id'])); ?> 
		<?php echo $this->Html->link(__('List Writers'), array('action' => 'index')); ?> 
		<?php echo $this->Html->link(__('New Writer'), array('action' => 'add')); ?> 
		<?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> 
		<?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> 
	</div>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Biography'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['biography']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['created']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="related">
		<h3><?php echo __('Related Books'); ?></h3>
		<?php if (!empty($writer['Book'])): ?>
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
			$i = 0;
			foreach ($writer['Book'] as $book): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($book['title'],'/'.$book['slug']); ?>&nbsp;
				</td>
				<td><?php echo $this->Html->image($book['image']); ?>&nbsp;</td>
				<td><?php echo $this->Number->currency($book['sale_price'],' VND',array('places'=>0,'wholePosition'=>'after')); ?>&nbsp;</td>
				<td><?php echo $this->Time->format('d-m-Y H:i:s',$book['created'],null,'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
				<td><?php echo $this->Time->format('d-m-Y H:i:s',$book['modified'],null,'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $book['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $book['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $book['id']), null, __('Bạn có đồng ý xóa hết tất cả các đánh giá về quyển sách %s không?', $book['title'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
</div>