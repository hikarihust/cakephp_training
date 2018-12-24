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
}