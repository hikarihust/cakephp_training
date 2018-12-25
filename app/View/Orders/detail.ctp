<!-- new element -->
<div class="panel panel-info">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-th"></i> Chi tiết đơn hàng
	</h4>
	<?php if (isset($order)): ?>
		<?php 
			$customer_info = json_decode($order['Order']['customer_info']);
			$payment_info = json_decode($order['Order']['payment_info']);
			$order_info = json_decode($order['Order']['order_info']);
		?>
		<div class="row"> 
			<div class="col col-lg-6">
				<p><strong>Họ tên người mua hàng: </strong><span><?= $customer_info->name; ?></span></p>
				<p><strong>Email: </strong><span><?= $customer_info->email; ?></span></p>
				<p><strong>SDT: </strong><span><?= $customer_info->phone; ?></span></p>
				<p><strong>Địa chỉ: </strong><span><?= $customer_info->address; ?></span></p>
			</div>
			<div class="col col-lg-6">
				<p><strong>Mã đơn hàng: </strong><span><?= $order['Order']['id'] ?></span></p>
				<p><strong>Tổng cộng: </strong><span><?= $this->Number->currency($payment_info->total, ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span></p>
				<?php if (isset($payment_info->coupon)): ?>
					<p><strong>Mã giảm giá: </strong>
						<span><?= $payment_info->coupon; ?> - <strong>Giảm:</strong> <?= $payment_info->discount; ?>%
						</span>
					</p>
					<p><strong>Tiền phải trả: </strong>
						<span><?= $this->Number->currency($payment_info->pay, ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span>
					</p>
				<?php else: ?>
					<p><strong>Tiền phải trả: </strong>
						<span><?= $this->Number->currency($payment_info->total, ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span>
					</p>
				<?php endif ?>
			</div>
		</div>
		<hr>
		Tình trạng đơn hàng: 
		<?php if ($order['Order']['status'] == 0): ?>
			<span class="label label-info">Đang xử lý</span>
		<?php elseif ($order['Order']['status'] == 1): ?>
			<span class="label label-success">Đã xử lý</span>
		<?php else: ?>
			<span class="label">Hủy</span>
		<?php endif ?>
		<hr>
		<h4>Sách đã mua</h4>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sách</th>
					<th>Số lượng</th>
					<th>Giá</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($order_info as $book): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $book->title ?></td>
						<td><?= $book->quantity ?></td>
						<td><?= $this->Number->currency($book->sale_price, ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></td>
						<td>
							<?php if (isset($link)): ?>
								<?= $this->Html->link('<i class="glyphicon glyphicon-download"></i> Download', $link[$book->id], array('escape'=>false)) ?>
							<?php else: ?>
								Chưa xử lý
							<?php endif ?>
						</td>
					</tr>	
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		Đơn hành này không tồn tại.
	<?php endif ?>
</div> 
<!-- end element -->