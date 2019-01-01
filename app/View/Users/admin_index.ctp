<div class="users index">
	<h2><?php echo __('Danh sách người dùng'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm người dùng'), array('action' => 'add')) ?>
		<?php echo $this->Html->link(__('Thêm nhóm'), array('controller' => 'groups', 'action' => 'add')) ?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('active', 'Trạng thái tài khoản'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id', 'Group'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('fullname', 'Họ tên'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Ngày chỉnh sửa'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td>
				<?php if ($user['User']['active']): ?>
					Đang hoạt động
				<?php else: ?>
					Bị hủy
				<?php endif ?>
			</td>
			<td><?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action'=> 'view', $user['Group']['id'])) ?></td>
			<td><?php echo $this->Html->link(__($user['User']['username']), array('action'=> 'view', $user['User']['id'])) ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']) ?>&nbsp;</td>
			<td><?php echo h($user['User']['fullname']) ?>&nbsp;</td>
			<?php echo $this->element('admin/timestamp', array('object'=> $user['User'])); ?>
			<td class="actions">
				<?php if ($user['User']['active']): ?>
					<?php echo $this->Form->postLink(__('Khóa tài khoản'), array('action' => 'lock', $user['User']['id']), array('confirm' => __('Bạn có chắc chắn muốn khóa tài khoản của %s?', $user['User']['fullname']))); ?>
				<?php else: ?>
					<?php echo $this->Form->postLink(__('Mở khóa tài khoản'), array('action' => 'unlock', $user['User']['id']), array('confirm' => __('Bạn có chắc chắn muốn mở khóa tài khoản của %s?', $user['User']['fullname']))); ?>
				<?php endif ?>

				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])) ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Bạn có chắc chắn muốn xóa tài khoản %s', $user['User']['id']))); ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
	<?php echo $this->element('admin/pagination', array('object'=>'người dùng')); ?>
</div>