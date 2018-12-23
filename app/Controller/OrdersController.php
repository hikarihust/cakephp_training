<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class OrdersController extends AppController{
/**
 * checkout method
 * thanh toán đơn hàng và lưu thông tin đơn hàng
 */
	public function checkout(){
		if ($this->request->is('post')) {
			$user_info = $this->get_user();
			$data = array(
				'user_id' => $user_info['id'],
				'order_info' => json_encode($this->Session->read('cart')),
				'customer_info' => json_encode($this->request->data['Order']),
				'payment_info' => json_encode($this->Session->read('payment')),
				'status' => 0
			);
			if ($this->Order->saveAll($data)) {
				$this->Session->delete('cart');
				$this->Session->delete('payment');
			}else{
				$this->Session->setFlash('Thanh toán không thực hiện được!', 'default', array('class' => 'alert alert-danger'), 'order');
			}
			$this->redirect($this->referer());
		}
	}
}