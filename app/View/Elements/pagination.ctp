<ul class="pagination">
	<?= $this->Paginator->prev('«', array('tag' => 'li'), '«', array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')) ?> 
	<?= $this->Paginator->numbers(array(
		'separator' => '',
		'tag' => 'li',
		'currentClass' => 'active',
		'currentTag' => 'a'
	)) ?> 
	<?= $this->Paginator->next('»', array('tag' => 'li'), '»', array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')) ?>
</ul> 