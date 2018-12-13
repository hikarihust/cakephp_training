<p>	
	<?= $this->Paginator->counter("Trang {:page}/{:pages} hiển thị {:current} ". $object ." trong tổng số {:count} " . $object); ?> <br>
	<?= $this->Paginator->prev('Trang trước') ?> |
	<?= $this->Paginator->numbers(array(
		'separator' => ' - ',
	)) ?> |
	<?= $this->Paginator->next('Trang sau') ?>
</p>