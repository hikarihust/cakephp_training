<div class="groups view">
<h2><?php  echo __('Group'); ?></h2>
<div class="submenu">
	<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $group['Group']['id'])); ?> 
	<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $group['Group']['id']), null, __('Bạn có chắc muốn xóa nhóm người dùng # %s?', $group['Group']['name'])); ?> 
	<?php echo $this->Html->link(__('Thêm nhóm mới'), array('action' => 'add')); ?> 
	<?php echo $this->Html->link(__('Thêm người dùng mới'), array('controller' => 'users', 'action' => 'add')); ?> 
</div>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tên nhóm'); ?></dt>
		<dd>
			<?php echo h($group['Group']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mô tả'); ?></dt>
		<dd>
			<?php echo h($group['Group']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ngày tạo'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
	</dl>


	<div class="related">
		<br>
		<h3><?php echo __('Các người dùng của nhóm '). '"'.$group['Group']['name']. '"'; ?></h3>
		<?php if (!empty($group['User'])): ?>
			<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Id'); ?></th>
					<th><?php echo __('Username'); ?></th>
					<th><?php echo __('Email'); ?></th>
					<th><?php echo __('Họ tên'); ?></th>
					<th><?php echo __('Ngày tạo'); ?></th>
					<th><?php echo __('Ngày chỉnh sửa'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php
				$i = 0;
				foreach ($group['User'] as $user): ?>
				<tr>
					<td><?php echo h($user['id']); ?></td>
					<td><?php echo $this->Html->link($user['username'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?></td>
					<td><?php echo h($user['email']); ?></td>
					<td><?php echo h($user['fullname']); ?></td>
					<td><?php echo h($user['created']); ?></td>
					<td><?php echo h($user['modified']); ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Bạn có chắc muốn xóa người dùng # %s?', $user['fullname'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>