<!-- new books -->
<div class="panel">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-bookmark"></i> Sách mới
		<?= $this->Html->link('(xem tất cả →)', '/sach-moi',  array('class' => 'more')) ?>
	</h4>
	<?= $this->element('books', array('books' => $books))  ?>
</div> 
<!-- end new books -->
<!--  bestseller -->
<div class="panel">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-fire"></i> Sách bán chạy
		<?= $this->Html->link('(xem tất cả →)', '/sach-ban-chay', array('class' => 'more')) ?>
	</h4>
	<?= $this->element('books', array('books' => $best_seller)); ?>
</div> 
<!-- end bestseller -->