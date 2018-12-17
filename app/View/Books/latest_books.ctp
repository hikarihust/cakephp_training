<!-- new element -->
<div class="panel">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-th"></i>
		Sách mới:
		<small class="sorts pull-right">Sắp xếp theo: 
			<?= $this->Paginator->sort('title', 'tên'); ?> ∙ 
			<?= $this->Paginator->sort('created', 'cũ/mới') ?>
		</small>
	</h4>
	<?= $this->element('books', array('books', $books)) ?>
</div> <!-- end element -->

<!-- pagination -->
<?= $this->element('pagination', array('object' => 'quyển sách')); ?>
<!-- end pagination -->