<div class="books index">
	<h2><?php echo __('Sách mới'); ?></h2>
	<p>
		<?= $this->Paginator->sort('title', 'Sắp xếp theo tên sách'); ?> |
		<?= $this->Paginator->sort('created', 'Mới nhất/Cũ nhất') ?>
	</p>

	<?= $this->element('books', array('books', $books)) ?>
	<?= $this->element('pagination', array('object' => 'quyển sách')); ?>
</div>