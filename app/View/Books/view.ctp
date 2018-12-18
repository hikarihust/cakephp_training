<!-- new books -->
<div class="panel">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-bookmark"></i> Chi tiết
	</h4>
	<div class="row"> 
		<div class="col col-lg-3">
			<div class="book-thumbnail">
				<?= $this->Html->image($book['Book']['image']); ?>
			</div>
		</div>
		<div class="col col-lg-9">
			<div class="bookinfo">
				<h4><?php echo h($book['Book']['title']); ?></h4>
				<p>Tác giả: 
					<?php if (!empty($book['Writer'])): ?>
					<?php foreach ($book['Writer'] as $key => $writer): ?>
						<?php if ($key < count($book['Writer'])-1): ?>
							<?= $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug']).' - ' ?> 
							<?php else: ?>
							<?= $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug'])?> 
						<?php endif ?>
					<?php endforeach; ?>
					<?php else: ?>
						Đang cập nhật
					<?php endif; ?>
				</p>				
				<p>
					Nhận xét: <?= $this->Html->link($book['Book']['comment_count'].' nhận xét', '#nhanxet') ?>
				</p>
				<p> Giá bìa: <?= $this->Number->currency($book['Book']['price'], ' VND', array('places' => 0, 'wholePosition' => 'after'))  ?>
				</p>
				<p class="yourprice">Giá bán: <span class="label label-danger"><?= $this->Number->currency($book['Book']['sale_price'], ' VND', array('places' => 0, 'wholePosition' => 'after'))  ?></span>
				</p>
				<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Thêm vào giỏ </button>
			</div>
		</div>

		<div class="col col-lg-12 book-content">
			<h4>Giới thiệu:</h4>
			<p>
				<?php echo h($book['Book']['info']); ?>
			</p>
			<div class=" col-lg-7">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Thông tin chi tiết</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nhà xuất bản:</td>
							<td><?php echo h($book['Book']['publisher']); ?></td>
						</tr>
						<tr>
							<td>Ngày xuất bản</td>
							<td><?php echo h($book['Book']['publish_date']); ?></td>
						</tr>
						<tr>
							<td>Số trang:</td>
							<td><?php echo h($book['Book']['pages']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div> 
<!-- end new books -->

<!-- related books -->
<div class="panel panel-success">
	<h4 class="panel-heading">
		<i class="glyphicon glyphicon-list-alt"></i> Sách liên quan
	</h4>
	<?= $this->element('books', array('books' => $related_books)) ?>
</div> 
<!-- end element -->

<!-- review -->
<div id="nhanxet" class="panel">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-comment"></i> Nhận xét
	</h4>
	<div class="row">	

		<div class="col col-lg-10">
			<?php if (!empty($comments)): ?>
				<?php foreach($comments as $comment): ?>
					<p class="comment">
						<strong><?php echo $comment['User']['username']; ?>:</strong>
						<?php echo $comment['Comment']['content']; ?>
					</p>
				<?php endforeach; ?>
			<?php else: ?>
				<p class="comment">
					Chưa có nhận xét nào
				</p>
			<?php endif; ?>
			<h4>Gửi nhận xét:</h4>
			<?php if(isset($errors)): ?>
				<?= $this->element('errors', array('errors', $errors)) ?>
			<?php endif; ?>
			<?php echo $this->Flash->render(); ?>
			<?= $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'), 'type' => 'post', 'novalidate' => true, 'class' => 'commentform')); ?>
				<?php
					echo $this->Form->input('user_id', array('label' => false, 'type' => 'hidden', 'value' =>1));
					echo $this->Form->input('book_id', array('label' => false, 'type' => 'hidden', 'value' => $book['Book']['id']));
					echo $this->Form->input('content', array('label' => false , 'type' => 'textarea' ,'row' => '5', 'class' => 'col-lg-12'));
				?>
				<?= $this->Form->button('Gửi', array('type' => 'submit', 'class' => 'pull-right btn btn-primary col-lg-3')) ?>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div> 
<!-- end review -->