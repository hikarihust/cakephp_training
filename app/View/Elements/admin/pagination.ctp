<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang {:page} / {:pages}, hiển thị {:current} '.$object.' trong tổng số {:count} '.$object.', đang hiển thị '.$object.' từ {:start} đến {:end}')
	));
	?>	
</p>
<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
</div>