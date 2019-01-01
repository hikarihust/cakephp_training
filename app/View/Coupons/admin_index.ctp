<div class="coupons index">
	<h2><?php echo __('Danh sách mã giảm giá') ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Thêm mã giảm giá'), array('action' => 'add')) ?>
	</div>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code', 'Mã giảm giá'); ?></th>
			<th><?php echo $this->Paginator->sort('percent', '%'); ?></th>
			<th><?php echo $this->Paginator->sort('description', 'Mô tả'); ?></th>
			<th><?php echo $this->Paginator->sort('time_start', 'Bắt đầu'); ?></th>
			<th><?php echo $this->Paginator->sort('time_end', 'Kết thúc'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Ngày chỉnh sửa'); ?></th>
			<th class="actions"> <?php echo __('Actions') ?> </th>
		</tr>
		<?php foreach ($coupons as $coupon): ?>
			<tr>
				<td><?php echo h($coupon['Coupon']['id']); ?> &nbsp;</td>
				<td><?php echo h($coupon['Coupon']['code']); ?> &nbsp;</td>
				<td><?php echo h($coupon['Coupon']['percent'].'%'); ?> &nbsp;</td>
				<td><?php echo h($coupon['Coupon']['description']); ?> &nbsp;</td>
				<td><?php echo $this->Time->format('d-m-Y H:i:s', $coupon['Coupon']['time_start'], null, 'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
				<td><?php echo $this->Time->format('d-m-Y H:i:s', $coupon['Coupon']['time_end'], null, 'Asia/Ho_Chi_Minh'); ?>&nbsp;</td>
				<?php echo $this->element('admin/timestamp', array('object'=>$coupon['Coupon'])); ?>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action'=> 'view', $coupon['Coupon']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action'=> 'edit', $coupon['Coupon']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete'), array('confirm'=> __('Bạn có chắc chắn muốn xóa coupon %s không?', $coupon['Coupon']['id']))); ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
	<?php echo $this->element('admin/pagination', array('object'=>'mã giảm giá')) ?>
</div>