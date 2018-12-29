
<?php foreach ($books as $book): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($book['Category']['name'],'/danh-muc/'.$book['Category']['slug']); ?>&nbsp;
		</td>
		<td>
			<?php echo $this->Html->link($book['Book']['title'],'/'.$book['Book']['slug']); ?>&nbsp;
		</td>
		<td><?php echo $this->Html->image($book['Book']['image']); ?>&nbsp;</td>
		<td><?php echo $this->Number->currency($book['Book']['sale_price'],' VND',array('places'=>0,'wholePosition'=>'after')); ?>&nbsp;</td>
		<?php echo $this->element('admin/timestamp',array('object'=>$book['Book'])); ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $book['Book']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $book['Book']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $book['Book']['id']), null, __('Bạn có đồng ý xóa hết tất cả các đánh giá về quyển sách %s không?', $book['Book']['title'])); ?>
		</td>
	</tr>
<?php endforeach; ?>