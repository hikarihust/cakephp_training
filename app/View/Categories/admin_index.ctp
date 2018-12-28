<div class="categories index">
	<h2><?php echo __('Danh mục sách'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm danh mục'), array('action' => 'add')) ?>
		<?php echo $this->Html->link(__('Thêm sách'), array('controller' => 'books','action' => 'add')) ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo "STT"; ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $i++; ?>&nbsp;</td>
		<td>
			<?php if ($category['Category']['parent_id'] != null): ?>
				+
			<?php endif ?>
			<?php echo $this->Html->link($category['Category']['name'],'/danh-muc/'.$category['Category']['slug']); ?>&nbsp;
		</td>
		<td><?php echo h($category['Category']['slug']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['description']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink('Lên', array('controller'=> 'categories', 'action' => 'up', $category['Category']['id'])) ?>
			<?php echo $this->Form->postLink('Xuống', array('controller'=> 'categories', 'action' => 'down', $category['Category']['id'])) ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Bạn có đồng ý xóa tất cả những quyển sách bên trong danh mục %s hay không?', $category['Category']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
		<?php 
			echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
		?>
	</p>
	<div class="paging">
	<?php 
		echo $this->Paginator->prev('< '.__('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next').' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
