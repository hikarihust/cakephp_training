<div class="orders view">
<h2><?php  echo __('Chi tiết đơn hàng'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Sửa đơn hàng'), array('action' => 'edit', $order['Order']['id'])); ?> 
		<?php echo $this->Html->link(__('Thêm người dùng'), array('controller' => 'users', 'action' => 'add')); ?> 
	</div>
	<?php 
		$customer_info = json_decode($order['Order']['customer_info']);
		$payment_info = json_decode($order['Order']['payment_info']);
		$order_info = json_decode($order['Order']['order_info']);
	 ?>
	<div class="row"> 
		<div class="col col-lg-6">
			<p><strong>Họ tên người mua hàng: </strong><span><?php echo $customer_info->name; ?></span></p>
			<p><strong>Email: </strong><span><?php echo $customer_info->email; ?></span></p>
			<p><strong>SĐT: </strong><span><?php echo $customer_info->phone; ?></span></p>
			<p><strong>Địa chỉ: </strong><span><?php echo $customer_info->address; ?></span></p>
		</div>
		<div class="col col-lg-6">
			<p><strong>Mã đơn hàng: </strong><span><?php echo $order['Order']['id']; ?></span></p>
			<p><strong>Tổng cộng: </strong><span><?php echo $this->Number->currency($payment_info->total,' VND',array('places'=>0,'wholePosition'=>'after')); ?></span></p>

			<?php if (isset($payment_info->coupon)): ?>
				<p><strong>Mã giảm giá: </strong>
					<span>
						<?php echo $payment_info->coupon; ?> - 
						<strong>Giảm:</strong> <?php echo $payment_info->discount; ?>%
					</span>
				</p>
				<p><strong>Tiền phải trả: </strong><span><?php echo $this->Number->currency($payment_info->pay,' VND',array('places'=>0,'wholePosition'=>'after')); ?></span></p>
			<?php else: ?>
				<p><strong>Tiền phải trả: </strong><span><?php echo $this->Number->currency($payment_info->total,' VND',array('places'=>0,'wholePosition'=>'after')); ?></span></p>
			<?php endif ?>
		</div>
	</div>
	<p>
		<strong>Tình trạng đơn hàng: </strong>
	  	<?php if ($order['Order']['status']==0): ?>
    		<span class="label label-info">Đang xử lý</span>
    	<?php elseif($order['Order']['status']==1): ?>	
    		<span class="label label-success">Đã xử lý</span>
    	<?php else: ?>
    		<span class="label">Hủy</span>
    	<?php endif ?>
 	</p>
 	<h4>Sách đã mua</h4>
 	<table class="table table-striped" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Số lượng</th>
            <th>Giá</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1;  ?>
        <?php foreach ($order_info as $book): ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $book->title; ?></td>
				<td><?php echo $book->quantity; ?></td>
				<td><?php echo $this->Number->currency($book->sale_price,' VND',array('places'=>0,'wholePosition'=>'after')); ?></td>
			</tr>
        <?php endforeach ?>
        </tbody>
	</table>
</div>