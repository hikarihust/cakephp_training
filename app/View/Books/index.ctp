<!-- new books -->
<div class="panel">
	<h4 class="panel-heading"><i class="glyphicon glyphicon-bookmark"></i> Sách mới
		<?= $this->Html->link('(xem tất cả →)', '/sach-moi',  array('class' => 'more')) ?>
	</h4>
	<?= $this->element('books', array('books', $books))  ?>
</div> 
<!-- end new books -->
<!--  bestseller -->
<div class="panel">
		<h4 class="panel-heading"><i class="glyphicon glyphicon-fire"></i> Sách bán chạy
			<a class="more" href="">(xem tất cả →)</a>
		</h4>
		<div class="row"> 
			<div class="col col-lg-3">
		    <div class="book-thumbnail">
		      <img src="http://placehold.it/140x200" alt="">
		      <div class="caption book-info">
		        <h4>Bí mật tư duy triệu phú</h4>
		        <a class="author" href="">T.Harv Eker</a>
		        <p class="price">Giá: 30,000đ</p>
		      </div>
		    </div>
	 	</div>
	 	<div class="col col-lg-3">
		    <div class="book-thumbnail">
		      <img src="http://placehold.it/140x200" alt="">
		      <div class="caption book-info">
		        <h4>Bí mật tư duy triệu phú</h4>
		        <a class="author" href="">T.Harv Eker</a>
		        <p class="price">Giá: 30,000đ</p>
		      </div>
		    </div>
	 	</div>
	 	<div class="col col-lg-3">
		    <div class="book-thumbnail">
		      <img src="http://placehold.it/140x200" alt="">
		      <div class="caption book-info">
		        <h4>Bí mật tư duy triệu phú</h4>
		        <a class="author" href="">T.Harv Eker</a>
		        <p class="price">Giá: 30,000đ</p>
		      </div>
		    </div>
	 	</div>
	 	<div class="col col-lg-3">
		    <div class="book-thumbnail">
		      <img src="http://placehold.it/140x200" alt="">
		      <div class="caption book-info">
		        <h4>Bí mật tư duy triệu phú</h4>
		        <a class="author" href="">T.Harv Eker</a>
		        <p class="price">Giá: 30,000đ</p>
		      </div>
		    </div>
	 	</div>
 	</div>
</div> 
<!-- end bestseller -->