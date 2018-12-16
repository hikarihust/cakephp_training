<?= $this->Form->create('Book', array('novalidate' => true)); ?>
	<?= $this->Form->input('keyword', array('error' =>false, 'label' => false, 'placeholder' => 'Gõ vào từ khóa để tìm kiếm...')); ?>
<?= $this->Form->end('Search'); ?>

<!-- Hiển thị lỗi xác thực dữ liệu khi nhập keyword để tìm kiếm -->
<?php if(isset($errors)): ?>
	<?php foreach($errors as $val1): ?>
		<?php foreach($val1 as $val2): ?>
			<?php echo $val2; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endif; ?>
<!-- Hien thi ket qua tim kiem -->
<?php if ($notfound == false && isset($results)): ?>
	<?= $this->element('books', array('books' => $results)); ?>
	<?= $this->element('pagination', array('object' => 'quyển sách')); ?>
	<?php elseif($notfound): ?>
		Không tìm thấy quyển sách này!
<?php endif ?>