<div class="books view">
<h2><?php  echo __('Book'); ?></h2>
	<div class="submenu">
		<?php echo $this->Html->link(__('Cập nhật'), array('action' => 'edit', $book['Book']['id'])); ?> 
		<?php echo $this->Form->postLink(__('Xóa'), array('action' => 'delete', $book['Book']['id']), null, __('Bạn có đồng ý xóa tất cả các đánh giá hiện tại có cho quyển sách %s không?', $book['Book']['title'])); ?> 
		<?php echo $this->Html->link(__('Thêm danh mục'), array('controller' => 'categories','action' => 'add')); ?> 
		<?php echo $this->Html->link(__('Thêm sách'), array( 'action' => 'add')); ?> 
	</div>
	<dl>
		<dt><?php echo __('Tên sách'); ?></dt>
		<dd>
			<?php echo h($book['Book']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tác giả'); ?></dt>
		<dd>
			<?php if (!empty($book['Writer'])): ?>
				<?php foreach ($book['Writer'] as $writer): ?>
					<?php echo $this->Html->link($writer['name'],'/tac-gia/'.$writer['slug']); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</dd>
		<!-- đếm số comment -->
		<dt><?php echo __('Đánh giá'); ?></dt>
		<dd>
			<?php echo $book['Book']['comment_count'];//count($comments); ?> comments
			&nbsp;
		</dd>
		<!-- end -->
		<dt><?php echo __('Thumbnail'); ?></dt>
		<dd>
			<?php echo $this->Html->image($book['Book']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Giá tiền'); ?></dt>
		<dd>
			<?php echo h($book['Book']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Giá bán'); ?></dt>
		<dd>
			<?php echo h($book['Book']['sale_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Số trang'); ?></dt>
		<dd>
			<?php echo h($book['Book']['pages']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nhà xuất bản'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publisher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ngày xuất bản'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publish_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nội dung'); ?></dt>
		<dd>
			<?php echo $book['Book']['info']; ?>
			&nbsp;
		</dd>
	</dl>
	<!-- hiển thị comments -->
	<div class="related">
		<hr>
		<br>
		<h3><?php echo __('Các đánh giá'); ?></h3>
		<?php if (!empty($comments)): ?>
		<?php foreach ($comments as $comment): ?>
			<?php echo $comment['User']['fullname']; ?> đã gửi:
			"<?php echo $comment['Comment']['content']; ?>" - 
			<?php echo $this->Form->postLink(__('Xóa'), array('controller'=>'comments','action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?><br>
		<?php endforeach ?>
	<?php endif; ?>
	</div>
	<!-- end -->
</div>

