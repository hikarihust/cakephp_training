<?php if (!empty($user_info)): ?>
	<div class="panel">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-user"></i> <small>Xin chào <strong><?= $user_info['fullname'] ?></strong></small>
	</h4>
		<ul>
			<li><?= $this->Html->link('Cập nhật thông tin', '/cap-nhat-thong-tin') ?></li>
			<li><?= $this->Html->link('Đổi mật khẩu', '/doi-mat-khau') ?></li>
			<li><a href="">Lịch sử mua hàng</a></li>
			<li><?= $this->Html->link('Đăng xuất', '/logout') ?></li>
		</ul>
	</div>
<?php else: ?>
	<div class="panel">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> <small>Xin chào <strong>khách hàng</strong></small></h4>
		Nhấn vào <?= $this->Html->link('đây', '/login') ?> để đăng nhập <br>
		Nếu bạn chưa có tài khoản thì hãy đăng ký tại <?= $this->Html->link('đây', '/dang-ky') ?>
	</div>
<?php endif ?>