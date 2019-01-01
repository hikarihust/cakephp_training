<div class="comments index">
	<h2><?php echo __('Các nhận xét'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm người dùng'), array('controller' => 'users', 'action' =>'add')); ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books', 'action' =>'add')); ?>
	</div>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'User'); ?></th>
			<th><?php echo $this->Paginator->sort('book_id', 'Sách'); ?></th>
			<th><?php echo $this->Paginator->sort('content', 'Nội dung'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
			<th class="actions"><?php echo __('Actions') ?></th>
		</tr>
		<?php foreach ($comments as $comment): ?>
			<tr>
				<td><?php echo h($comment['Comment']['id']); ?> &nbsp;</td>
				<td><?php echo $this->Html->link($comment['User']['fullname'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])) ?></td>
				<td><?php echo $this->Html->link($comment['Book']['title'], array('controller' => 'books', 'action' => 'view', $comment['Book']['id'])) ?></td>
				<td><?php echo h($comment['Comment']['content']); ?> &nbsp;</td>
				<td><?php echo $this->Time->format('d-m-Y H:i:s', $comment['Comment']['created'], null, 'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $comment['Comment']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comment['Comment']['id']), array('confirm'=> __('Bạn có đồng ý xóa comment này hay không'))); ?>
				</td>
			</tr>
		<?php endforeach ?>

	</table>
</div>