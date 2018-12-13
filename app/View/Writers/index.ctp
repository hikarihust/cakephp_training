<div class="writers index">
	<h2><?php echo __('Các tác giả'); ?></h2>
	<p>
		<?= $this->Paginator->sort('name', 'Sắp xếp theo thứ tự ngược lại'); ?> |
	</p>

	<?php foreach ($writers as $writer): ?>
		<?php echo $writer['Writer']['name']; ?> <br>
		<br>
	<?php endforeach ?>
	<p>	
		<?= $this->Paginator->counter("Trang {:page}/{:pages} hiển thị {:current} quyển sách trông tổng số {:count} quyển."); ?> <br>
		<?= $this->Paginator->prev('Trang trước') ?> |
		<?= $this->Paginator->numbers(array(
			'separator' => ' - ',
		)) ?> |
		<?= $this->Paginator->next('Trang sau') ?>
	</p>
</div>