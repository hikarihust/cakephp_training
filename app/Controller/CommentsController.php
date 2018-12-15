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
	public $helpers = array('Html', 'Form', 'Js'=>array("Jquery"),"Session");

/**
 * add method
 * hiển thị 10 quyển sách mới nhất trên trang chủ
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->set($this->request->data);
			if($this->Comment->validates()){
				if ($this->Comment->save($this->request->data)) {
					$this->Session->setFlash(__('Đã gởi nhận xét!'));
				} else {
					$this->Session->setFlash(__('Chưa gởi được, vui lòng thử lại'));
				}	
			}else{
				$comment_errors = $this->Comment->validationErrors;
				$this->Session->write('comment_errors', $comment_errors);
			}
			$this->redirect($this->referer());
		}
	}
}