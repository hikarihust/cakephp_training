<div class="books view">
	<?php //pr($book); ?>
<h2><?php  echo __('Book'); ?></h2>
	<dl>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($book['Book']['title']); ?>
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
