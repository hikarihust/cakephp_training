<div class="writers view">
<h2><?php  echo __('Writer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Biography'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['biography']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($writer['Writer']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>