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
 * chi tiết đơn hàng
 */
	public function detail($id = null){
		$order = $this->Order->findById($id);
		if (!empty($order)) {
			$user_info = $this->get_user();
			if ($user_info['id'] == $order['Order']['user_id']) {
				$this->set('order', $order);
				if ($order['Order']['status'] == 1) {
					$books = json_decode($order['Order']['order_info']);
					$this->loadModel('Book');
					foreach ($books as $book) {
						$this->Book->recursive = -1;
						$result = $this->Book->findById($book->id);
						$link[$book->id] = $result['Book']['link_download'];
					}
					$this->set('link', $link);
				}
			}
		}
		$this->set('title_for_layout', 'Chi tiết đơn hàng');
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

// ----------------------------------------admin-------------------------------------------

/**
 * index method
 */
	public function admin_index(){
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

/**
 * Xử lý nhiều đơn hàng
 */
	public function admin_process(){
		if ($this->request->is('post')) {
			foreach ($this->request->data['Order']['id'] as $id => $value) {
				if ($value) {
					$ids[] = $id;
				}
			}
			if (!empty($ids)) {
				switch ($this->request->data['Order']['action']) {
					case 1:
						if ($this->Order->updateAll(array('Order.status'=>1), array('Order.id'=>$ids))) {
							$this->Session->setFlash('Đã xử lý đơn hàng thàng công');
						}else{
							$this->Session->setFlash('Có lỗi xảy ra, vui lòng thử lại');
						}
						break;

					case 2:
						if ($this->Order->updateAll(array('Order.status'=>0), array('Order.id'=>$ids))) {
							$this->Session->setFlash('Đã tạm ngưng đơn hàng thàng công');
						}else{
							$this->Session->setFlash('Có lỗi xảy ra, vui lòng thử lại');
						}
						break;

					case 3:
						if ($this->Order->updateAll(array('Order.status'=>2), array('Order.id'=>$ids))) {
							$this->Session->setFlash('Đã hủy đơn hàng thàng công');
						}else{
							$this->Session->setFlash('Có lỗi xảy ra, vui lòng thử lại');
						}
						break;
					
					default:
						$this->Session->setFlash('Không có xử lý này, vui lòng thử lại');
						break;
				}
			}else{
				$this->Session->setFlash('Bạn chưa chọn đơn hàng để xử lý');
			}
		}
		$this->redirect(array('action'=> 'index'));
	}

}