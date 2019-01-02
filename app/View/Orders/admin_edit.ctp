<div class="orders form">
	<h2><?php echo __('Sửa đơn hàng'); ?> - User: <?php echo $user['User']['fullname'] ?></h2>
	<div class="submenu">
		<?php echo $this->Form->postLink(__('Xóa đơn hàng'), array('action' => 'delete', $this->request->data['Order']['id']), array('confirm' => __('Bạn có chắc chắn muốn xóa đơn hàng %s không', $this->request->data['Order']['id']))); ?>
		<?php echo $this->Html->link(__('Thêm người dùng'), array('controller'=> 'users', 'action'=> 'add')); ?>
	</div>
<?php 
	$customer_info = json_decode($this->request->data['Order']['customer_info']);
	$payment_info = json_decode($this->request->data['Order']['payment_info']);
	$order_info = json_decode($this->request->data['Order']['order_info']);
?>
<?php echo $this->Form->create('Order', array('novalidate' => true, 'inputDefaults'=> array('error'=>false))); ?>
	<fieldset>
		<?php echo $this->Form->input('id'); ?>
		<legend>Thông tin khách hàng</legend>
		<?php 
			echo $this->Form->input('name', array('label' => 'Tên', 'value'=> $customer_info->name));
			echo $this->Form->input('email', array('label' => 'Email', 'value'=> $customer_info->email));
			echo $this->Form->input('address', array('label' => 'Phone', 'value'=> $customer_info->address));
			echo $this->Form->input('phone', array('label' => 'Phone', 'value'=> $customer_info->phone));
		?>

		<legend>Thông tin đơn hàng</legend>
		<?php 
			if (isset($payment_info->coupon)) {
				echo $this->Form->input('coupon', array('readonly' => true, 'label' => 'Mã giảm giá', 'value'=> $payment_info->coupon));
				echo $this->Form->input('discount', array('readonly' => true, 'label' => '% giảm giá', 'value'=> $payment_info->discount));
				echo $this->Form->input('pay', array('readonly' => true, 'label' => 'Tiền phải trả', 'value'=> $payment_info->pay));
			}else{
				echo $this->Form->input('total', array('readonly' => true, 'label' => 'Tổng cộng', 'value'=> $payment_info->total));
			}
		?>

		<legend>Sách đã mua</legend>
		<?php  
			foreach ($order_info as $book) {
				echo "<div>";
				echo $this->Form->hidden('Book.'.$book->id.'.id', array('label'=>false, 'value'=>$book->id));
				echo $this->Form->input('Book.'.$book->id.'.title', array('label'=>'Tên sách', 'value'=>$book->title, 'div'=>array('class' => 'inline-input')));
				echo $this->Form->hidden('Book.'.$book->id.'.slug', array('label'=>false, 'value'=>$book->slug));
				echo $this->Form->input('Book.'.$book->id.'.sale_price', array('label'=>'Giá bán', 'value'=>$book->sale_price, 'div'=>array('class' => 'inline-input gb')));
				echo $this->Form->input('Book.'.$book->id.'.quantity', array('label'=>'Số lượng', 'value'=>$book->quantity, 'div'=>array('class' => 'inline-input sl')));
				echo "</div>";
			}
		?>

		<div class="input">
			<?php echo $this->Form->select('status', array(1 => 'Được chấp nhận', 2 => 'Tạm ngừng', 3=> 'Hủy'), array('empty' => false)); ?>
		</div>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>