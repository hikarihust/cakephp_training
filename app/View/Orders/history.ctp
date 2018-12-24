<!-- new element -->
<div class="panel panel-info">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-th"></i> Lịch sử mua hàng 
	</h4>
	<h4>Dưới đây là toàn bộ thông tin mua hàng của bạn</h4>
	<?= $this->Session->flash(); ?>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>STT</th>
				<th>Thời gian</th>
				<th>Email</th>
				<th>Tiền thanh toán</th>
				<th>Tình trạng</th>
				<th>Chi tiết</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($orders as $order): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $this->Time->format('d-m-Y H:i:s', $order['Order']['created'], false, 'Asia/Ho_Chi_Minh') ?></td>
					<td><?= json_decode($order['Order']['customer_info'])->email ?></td>
					<td><?php echo $this->Number->currency(json_decode($order['Order']['payment_info'])->total,' VND',array('places'=>0,'wholePosition'=>'after')); ?></td>
					<td>
						<?php if ($order['Order']['status'] == 0): ?>
							<span class="label label-info">Đang xử lý</span>
						<?php elseif ($order['Order']['status'] == 1): ?>
							<span class="label label-success">Đã xử lý</span>
						<?php else: ?>
							<span class="label">Hủy</span>
						<?php endif ?>
					</td>
					<td><a href="#">Xem</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<hr>
	<strong>Ghi chú tình trạng đơn hàng:</strong>
	<ul>
		<li>Đã xử lý: đơn hàng đã được chấp nhận</li>
		<li>Đang xử lý: đơn hàng đang đợi xứ lý, bạn vui lòng thanh toán cho đơn hàng này</li>
		<li>Hủy: đơn hàng đã bị hủy, vui lòng liên hệ tại <a href="">đây</a> để biết thêm chi tiết</li>
	</ul>
</div> 
<!-- end element -->