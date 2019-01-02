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
				$user_info = $this->get_user();
				$this->request->data['Comment']['user_id'] = $user_info['id'];
				if ($this->Comment->save($this->request->data)) {
					$this->Session->setFlash(__('Đã gởi nhận xét!'), 'default', array('class' => 'alert alert-info'));
				} else {
					$this->Session->setFlash(__('Chưa gởi được, vui lòng thử lại'), 'default', array('class' => 'alert alert-danger'));
				}	
			}else{
				$comment_errors = $this->Comment->validationErrors;
				$this->Session->write('comment_errors', $comment_errors);
			}
			$this->redirect($this->referer().'#nhanxet');
		}
	}

// -------------------------------------admin--------------------------------------

/**
 * index method
 */
	public function admin_index(){
		$this->Comment->recursive = 0;
		$this->paginate = array(
			'order' => array('Comment.created' => 'desc'),
			'paramType' => 'querystring'
		);
		$this->set('comments', $this->paginate());
	}

/**
 * edit method
 */
	public function admin_edit($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Comment->set($this->request->data);
			if ($this->Comment->validates()) {
				if ($this->Comment->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu thành công'));
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau'));
				}
			}else{
				$this->set('errors', $this->Comment->validationErrors);
			}
		} 
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->request->data = $this->Comment->find('first', $options);
	}

/**
 * delete method
 */
	public function admin_delete($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Không tìm thấy'));
		}
		if ($this->request->is('post')) {
			if ($this->Comment->delete()) {
				$this->Session->setFlash(__('Đã xóa thành công'));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Không xóa được, vui lòng thử lại sau'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}
}