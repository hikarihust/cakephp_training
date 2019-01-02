<?php 

App::uses('AppController', 'Controller');

/**
 * Coupons Controller
 */
class CouponsController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add');
	}
	
/**
 * add method
 * nhập mã giảm giá
 */
	public function add(){
		if ($this->request->is('post')) {
			$code = $this->request->data['Coupon']['code'];
			$coupon = $this->Coupon->findByCode($code);
			if (!empty($coupon)) {
				$today = date('Y-m-d H:i:s');
				echo $start = $coupon['Coupon']['time_start'];
				$end = $coupon['Coupon']['time_end'];
				if ($this->Tool->between($today, $start, $end)) {
					$this->Session->write('payment.coupon', $coupon['Coupon']['code']);
					$this->Session->write('payment.discount', $coupon['Coupon']['percent']);
					$total = $this->Session->read('payment.total');
					$pay = $total - $total*$coupon['Coupon']['percent']/100;
					$this->Session->write('payment.pay', $pay);
				}else{
					$this->Session->setFlash('Mã giảm giá đã hết hạn!', 'default', array('class' => 'alert alert-danger'), 'coupon');
				}
			}else{
				$this->Session->setFlash('Sai mã giảm giá!', 'default', array('class' => 'alert alert-danger'), 'coupon');
			}
			$this->redirect($this->referer());
		}
	}

// ---------------------------------------------admin---------------------------------------------

/**
 * index method
 */
	public function admin_index(){
		$this->Coupon->recursive = 0;
		$this->set('coupons', $this->paginate());
	}

/**
 * add method
 */
	public function admin_add(){
		if ($this->request->is('post')) {
			$this->Coupon->set($this->request->data);
			if ($this->Coupon->validates()) {
				$this->Coupon->create();
				if ($this->Coupon->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu mã giảm giá mới'));
					$this->redirect(array('action'=>'index'));
				}else{
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại.'));
				}
			}else{
				$this->set('errors', $this->Coupon->validationErrors);
			}
		}
	}

/**
 * edit method
 */
	public function admin_edit($id = null) {
		if (!$this->Coupon->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Coupon']['id'] = $id;
			$this->Coupon->set($this->request->data);
			if ($this->Coupon->validates()) {
				if ($this->Coupon->save($this->request->data)) {
					$this->Session->setFlash(__('Đã cập nhật thành công'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau.'));
				}
			}else{
				$this->set('errors', $this->Coupon->validationErrors);
			}
		} else {
			$options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
			$this->request->data = $this->Coupon->find('first', $options);
		}
	}

/**
 * delete method
 */
	public function admin_delete($id = null) {
		$this->Coupon->id = $id;
		if (!$this->Coupon->exists()) {
			throw new NotFoundException(__('Không tìm thấy.'));
		}
		if ($this->request->is('post')) {
			if ($this->Coupon->delete()) {
				$this->Session->setFlash(__('Đã xóa thành công'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->Session->setFlash(__('Không xóa được, vui lòng thử lại sau'));
			$this->redirect(array('action' => 'index'));
		}
	}
}