<?= $this->Form->create('Book', array('url' => array('controller' => 'books', 'action' => 'get_keyword'), 'type' => 'post', 'novalidate' => true)); ?>
	<?php if (isset($keyword)): ?>
			<?= $this->Form->input('keyword', array('value' => $keyword, 'error' =>false, 'label' => false, 'placeholder' => 'Gõ vào từ khóa để tìm kiếm...')); ?>
		<?php else: ?>
			<?= $this->Form->input('keyword', array('error' =>false, 'label' => false, 'placeholder' => 'Gõ vào từ khóa để tìm kiếm...')); ?>
	<?php endif ?>
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
	Kết quả tìm kiếm của từ khóa <strong> <?php echo $keyword; ?> </strong> <br>
	<?= $this->element('books', array('books' => $results)); ?>
	<?= $this->element('pagination', array('object' => 'quyển sách')); ?>
	<?php elseif($notfound): ?>
		Không tìm thấy quyển sách này!
<?php endif ?>