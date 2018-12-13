<?php foreach ($books as $book): ?>
	<?= $this->Html->link($book['Book']['title'], '/'.$book['Book']['slug']) ?> <br>
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