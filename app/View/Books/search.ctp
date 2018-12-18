<div class="panel panel-info">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-search"></i> Tìm kiếm</h4>
	<?= $this->Form->create('Book', array('url' => array('controller' => 'books', 'action' => 'get_keyword'), 'type' => 'post', 'novalidate' => true, 'class' => 'form-inline')); ?>
		<?php if (isset($keyword)): ?>
			<?= $this->Form->input('keyword', array('value' => $keyword, 'error' =>false, 'label' => false, 'placeholder' => 'tên sách, tên tác giả...', 'class' => 'col-lg-9', 'div' => false)); ?>
			<?php else: ?>
				<?= $this->Form->input('keyword', array('error' =>false, 'label' => false, 'placeholder' => 'tên sách, tên tác giả...', 'class' => 'col-lg-9', 'div' => false)); ?>
		<?php endif ?>
		<?= $this->Form->button('Tìm', array('type' => 'submit', 'class' => 'col-lg-2 btn btn-primary')) ?>
	<?= $this->Form->end(); ?>
</div>


<!-- Hiển thị lỗi xác thực dữ liệu khi nhập keyword để tìm kiếm -->
<?php if(isset($errors)): ?>
<div class="panel">
	<?= $this->element('errors', array('errors', $errors)) ?>
</div> 	
<?php endif; ?>

<!-- Hien thi ket qua tim kiem -->
<!-- new element -->
<?php if ($notfound == false && isset($results)): ?>
	<div class="panel">
		<h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i><small> Kết quả tìm kiếm: </small> <?php echo @$keyword; ?>
		</h4>
		<?= $this->element('books', array('books' => $results)); ?>
	</div> 
<?php elseif($notfound): ?>
	<div class="panel">
		<h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i><small> Kết quả tìm kiếm: </small> <?php echo @$keyword; ?>
		</h4>
		Không tìm thấy quyển sách này!
	</div> 
<?php endif ?>
<!-- end element -->

<!-- pagination -->
<?php if ($notfound == false && isset($results)): ?>
	<?= $this->element('pagination'); ?>
<?php endif ?>
<!-- end pagination -->