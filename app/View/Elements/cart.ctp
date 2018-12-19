<?php echo $this->Session->flash('cart'); ?>
<?php if ($this->Session->check('cart')): ?>
	<?php $cart = $this->Session->read('cart'); ?>
	<!-- <ul> -->
	<ul>
		<?php foreach ($cart as $book): ?>
			<li> 
				<?= $this->Html->link($book['title'], '/'.$book['slug']) ?> 
				(<?= $this->Number->currency($book['sale_price'], ' VND', array('places' => 0, 'wholePosition' => 'after')); ?>)
			</li>
		<?php endforeach ?>
	</ul>
	<!-- </ul> -->
	<?php $total = $this->Session->read('payment.total'); ?>
	<p class="pricetotal"><span class="label">Tổng: <?= $this->Number->currency($total, ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span></p>
	<button type="button" class="btn btn-primary btn-block">Xem/Cập nhật Giỏ hàng</button>
<?php else: ?>
	Giỏ hàng đang rỗng!
<?php endif ?>
