<div class="actions">
	<h3><?php echo __('Menu'); ?></h3>
	<ul>
		<?php $user_info = $this->Session->read('user_info'); ?>
		<?php if ($user_info['group_id'] == 5): ?>
			<li><?php echo $this->Html->link(__('Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Writers'), array('controller' => 'writers', 'action' => 'index')); ?> </li>
		<?php endif ?>

		<?php if ($user_info['group_id'] == 1): ?>
			<li><?php echo $this->Html->link(__('Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Writers'), array('controller' => 'writers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Commens'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<?php endif ?>
	</ul>
</div>