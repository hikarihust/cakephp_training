<div class="writers index">
	<h2><?php echo __('Các tác giả'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm tác giả'), array('action'=>'add')) ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller'=>'books', 'action'=>'add')) ?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name', 'Tên'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('biography', 'Tiểu sử'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($writers as $writer): ?>
		<tr>
			<td><?php echo h($writer['Writer']['id']); ?> &nbsp;</td>
			<td><?php echo h($writer['Writer']['name']); ?> &nbsp;</td>
			<td><?php echo h($writer['Writer']['slug']); ?> &nbsp;</td>
			<td><?php echo $this->Text->truncate($writer['Writer']['biography'], 50, array('extract' => false, 'ellipsis'=>'...')); ?> &nbsp;</td>
			<td><?php echo $this->Time->format('d-m-Y H:i:s', $writer['Writer']['created'], null, 'Asia/Ho_Chi_Minh'); ?> &nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action'=>'view', $writer['Writer']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action'=>'edit', $writer['Writer']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action'=>'delete', $writer['Writer']['id']), array('confirm' => __('Bạn có chắc chắn muốn xóa tác giả có id là %s này không?', $writer['Writer']['id']))); ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
	<?php echo $this->element('admin/pagination', array('object' => 'tác giả')); ?>
</div>