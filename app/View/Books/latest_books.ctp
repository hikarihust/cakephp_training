<div class="books index">
	<h2><?php echo __('Sách mới'); ?></h2>
	<p>
		<?= $this->Paginator->sort('title', 'Sắp xếp theo tên sách'); ?> |
		<?= $this->Paginator->sort('created', 'Mới nhất/Cũ nhất') ?>
	</p>

	<?php foreach ($books as $book): ?>
		<?php echo $book['Book']['title']; ?> <br>
		<?= $this->Html->image($book['Book']['image'], array('width'=>'140px', 'height' => '200px'))  ?> <br>
		Giá bán:<?= $this->Number->currency($book['Book']['sale_price'], ' VND', array('places' => 0, 'wholePosition' => 'after'))  ?> <br>
		<?php foreach ($book['Writer'] as $writer) 
			echo $writer['name'].' ';
		?>
		<br>
		<br>
		<hr>
		<br>
	<?php endforeach ?>
	<?= $this->element('pagination', array('object' => 'quyển sách')); ?>
</div>