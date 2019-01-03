<ul class="nav navbar-nav">
    <?php if ($this->request->params['action'] == 'latest_books'): ?>
    	<li class="active">
    <?php else: ?>
    	<li>
    <?php endif ?>
    	<?= $this->Html->link('Sách mới', '/sach-moi') ?>
    </li>

    <?php if ($this->request->params['action'] == 'best_seller'): ?>
    	<li class="active">
    <?php else: ?>
    	<li>
    <?php endif ?>
    	<?= $this->Html->link('Sách bán chạy', '/sach-ban-chay') ?>
    </li>

    <?php if ($this->request->params['action'] == 'contact'): ?>
    	<li class="active">
    <?php else: ?>
    	<li>
    <?php endif ?>
    	<?= $this->Html->link('Liên hệ', '/lien-he') ?>
    </li>

    <?php if ($this->request->params['action'] == 'about'): ?>
    	<li class="active">
    <?php else: ?>
    	<li>
    <?php endif ?>
    	<?= $this->Html->link('About', '/about') ?>
    </li>
</ul>