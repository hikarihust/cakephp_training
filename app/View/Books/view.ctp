<div class="books view">
	<?php //pr($book); ?>
<h2><?php  echo __('Book'); ?></h2>
	<dl>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($book['Book']['title']); ?>
			&nbsp;
		</dd>
		<!-- Đếm số lượng comment -->
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo $book['Book']['comment_count'] ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->image($book['Book']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info'); ?></dt>
		<dd>
			<?php echo h($book['Book']['info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($book['Book']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale Price'); ?></dt>
		<dd>
			<?php echo h($book['Book']['sale_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pages'); ?></dt>
		<dd>
			<?php echo h($book['Book']['pages']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publisher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publish Date'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publish_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<!-- hiển thị tác giả -->
<div class="related">
	<h3><?php echo __('Tác giả'); ?></h3>
	<?php if (!empty($book['Writer'])): ?>
	<?php foreach ($book['Writer'] as $writer): ?>
		<?= $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug']) ?> <br>
	<?php endforeach; ?>
<?php endif; ?>
</div>
<!-- end -->

<!-- hiển thị sách liên quan -->
<h3>Sách liên quan</h3>
<?= $this->element('books', array('books' => $related_books)) ?>

<!-- end -->

<!-- hiển thị comments -->
<div class="related">
	<h3><?php echo __('Comments'); ?></h3>
	<?php if (!empty($comments)): ?>
		<?php foreach($comments as $comment): ?>
			<?php echo $comment['User']['username']; ?> đã gửi:
			"<?php echo $comment['Comment']['content']; ?>" <br>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<!-- end -->

<!-- gởi comment -->
<div class="comments form">
	<?php if(isset($errors)): ?>
		<?php foreach($errors as $val1): ?>
			<?php foreach($val1 as $val2): ?>
				<?php echo $val2; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>

<?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'), 'type' => 'post', 'novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('label' => false, 'type' => 'text', 'value' =>1, 'hidden' => true));
		echo $this->Form->input('book_id', array('label' => false, 'type' => 'text', 'value' => $book['Book']['id'], 'hidden' => true));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!-- end -->