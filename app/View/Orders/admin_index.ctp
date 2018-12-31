<div class="orders index">
	<h2><?php echo __('Danh sách đơn hàng'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm người dùng'), array('controller'=>'users', 'action'=>'add')); ?>
	</div>
	<table>
		<tr>
			<td>Select</td>
			<th><?php echo $this->Paginator->sort('id', 'Mã đơn hàng') ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'User') ?></th>
			<th><?php echo $this->Paginator->sort('customer_info', 'Email') ?></th>
			<th><?php echo $this->Paginator->sort('payment_info', 'Giá trị đơn hàng') ?></th>
			<th><?php echo $this->Paginator->sort('status', 'Tình trạng') ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Ngày tạo') ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Ngày xử lý') ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php echo $this->Form->create('Order', array('url'=>array('controller'=> 'orders', 'action'=>'process'))); ?>
		<?php foreach ($orders as $order): ?>
		<tr>
			<td>
				<?php echo $this->Form->checkbox('Order.id.'.$order['Order']['id']); ?>
			</td>
			<td><?php echo h($order['Order']['id']); ?> </td>
			<td><?php echo $this->Html->link($order['User']['fullname'], array('controller'=>'users', 'action'=>'view', $order['User']['id'])) ?> &nbsp;</td>
			<td><?php echo json_decode($order['Order']['customer_info'])->email; ?>&nbsp;</td>
			<td><?php echo $this->Number->currency(json_decode($order['Order']['payment_info'])->total, ' VND', array('places'=> 0, 'wholePosition'=> 'after')); ?></td>
			<td>
				<?php if ($order['Order']['status']==0): ?>
					Chưa xử lý
				<?php elseif($order['Order']['status']==1): ?>
					Đã xử lý
				<?php else: ?>
					Hủy
				<?php endif ?>
			</td>
			<td><?php echo $this->Time->format('d-m-Y H:i:s', $order['Order']['created'], null, 'Asia/Ho_Chi_Minh'); ?> &nbsp;</td>
			<td><?php echo $this->Time->format('d-m-Y H:i:s', $order['Order']['modified'], null, 'Asia/Ho_Chi_Minh'); ?> &nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action'=>'view', $order['Order']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action'=>'edit', $order['Order']['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'),array('action'=>'delete', $order['Order']['id']), null, __('Bạn có chắc chắng muốn xóa hóa đơn %s này hay không', $order['Order']['id'])); ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
	<?php echo $this->element('admin/pagination', array('object'=>'đơn hàng')); ?>
	<div class="menu-select">
		<?php echo $this->Form->select('action', array('1'=>'Chấp nhận đơn hàng', '2'=>'Tạm ngưng đơn hàng', '3'=>'Hủy đơn hàng'), array('empty'=>false)); ?>
	</div>
	<?php echo $this->Form->end('Submit'); ?>
</div>