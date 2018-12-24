<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class OrdersController extends AppController{

/**
 * lịch sử mua hàng
 */
	public function history(){
		$this->set('title_for_layout', 'Lịch sử mua hàng');
		$user_info = $this->get_user();
		$orders = $this->Order->findAllByUserId($user_info['id'], null, array('Order.created'=>'desc'));
		$this->set('orders', $orders);
	}

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
				$this->Session->setFlash('Đang đợi xử lý, vui lòng chuyển khoản để thanh toán đơn hàng của bạn.', 'default', array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('Thanh toán không thực hiện được!', 'default', array('class' => 'alert alert-danger'), 'order');
			}
			$this->redirect('/lich-su-mua-hang');
		}
	}
}