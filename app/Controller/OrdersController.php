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
 * status method - xác định trạng thái của đơn hàng để lưu vào csdl
 */
	private function OrderStatus($st = null){
		switch ($st) {
			case 1:
				$status = 1;
				break;

			case 2:
				$status = 0;
				break;

			case 3:
				$status = 2;
				break;
			
			default:
				$status = 1;
		}
		return $status;
	}

/**
 * edit method - edit đơn hàng
 */

	public function admin_edit($id = null){
		if ($this->request->is('post') || $this->request->is('put')) {		
			// lấy dữ liệu customer info dùng hàm array_slice, lấy từ vị trí đầu tiên, lấy đến vị trí tổng độ dài mảng -4 đếm từ vị trí cuối mảng
			$customer_info = array_slice($this->request->data['Order'], 1, -(count($this->request->data['Order'])-5));

			// lấy dữ liệu order_info từ $this->request->data['Book']; cấu trúc biến này đã được sắp xếp y hệt như ban đầu, do đã đặt tên các input trên view theo dạng Book.$id.field
			$order_info = $this->request->data['Book'];

			// dùng foreach để kiểm tra xem có input nào rỗng hay không, nếu input hiển thị thông tin sách bao gồm tên, số lượng và giá bán có 1 hoặc cả 3 đều rỗng thì nghĩa là xóa quển sách đó ra khỏ đơn hàng.
			foreach ($order_info as $book) {
			 	if ($book['title'] == null || $book['quantity'] == null || $book['sale_price'] == null) {
			 		unset($order_info[$book['id']]);
			 	}
			}

			//  tính lại giá trị tổng đơn hàng
			$total = $this->Tool->array_sum($order_info, 'quantity', 'sale_price');

			// lấy thông tin đơn hàng bằng hàm array_slice
			$payment_info = array_slice($this->request->data['Order'], 5, -1);

			// kiểm tra xem đơn hàng có coupon đi kèm hay không, nếu có thì cập nhật total và tính lại tiền phải trả -> pay rồi cập nhật vào cho biếm $payment_info, còn không thì chỉ cập nhật lại total vào cho biến $payment_info
			if (isset($payment_info['coupon'])) {
				$payment_info['total'] = $total;
				$payment_info['pay'] = $total - $total*$payment_info['discount']/100;
			}else{
				$payment_info['total'] = $total;
			}

			// xác định trạng thái của đơn hàng để lưu vào csdl
			$status = $this->OrderStatus($this->request->data['Order']['status']);

 			// gán dữ liệu vào biến $data để cập nhật vào csdl
			$data = array(
				'id' => $this->request->data['Order']['id'],
				'customer_info' => json_encode($customer_info),
				'payment_info' => json_encode($payment_info),
				'order_info' => json_encode($order_info),
				'status' => $status
			);

			if ($this->Order->save($data)) {
				$this->Session->setFlash(__('Đã cập nhật đơn hàng thành công'));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau.'));
			}
		}else{
			$options = array(
				'conditions' => array('Order.id' => $id)
			);
			$this->request->data = $this->Order->find('first', $options);
			$user = $this->Order->User->findById($this->request->data['Order']['user_id']); 
		}
		$this->set(compact('user'));
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