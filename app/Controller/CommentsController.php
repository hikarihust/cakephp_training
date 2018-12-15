<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class CommentsController extends AppController{

	public $paginate = array(
		'order' => array('created' => 'desc'),
		'limit' => 5
	);

/**
 * add method
 * hiển thị 10 quyển sách mới nhất trên trang chủ
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('Đã gởi nhận xét!'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('Chưa gởi được, vui lòng thử lại'));
			}		
		}
	}
}