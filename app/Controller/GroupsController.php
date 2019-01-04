<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

/**
 * Đưa dữ liệu groups và users vào bảng aros
 */
	// public function admin_create_aros(){
	// 	$aro = $this->Acl->Aro;
	// 	$groups = $this->Group->find('all');
	// 	foreach ($groups as $group) {
	// 		$aro->create();
	// 		$aro->save(array(
	// 			'alias' => $group['Group']['name'],
	// 			'model' => 'Group',
	// 			'foreign_key' => $group['Group']['id']
	// 			));
	// 	}

	// 	//$this->loadModel('User');
	// 	$users = $this->Group->User->find('all');
	// 	foreach ($users as $user) {
	// 		$aro->create();
	// 		$aro->save(array(
	// 			'parent_id' => $user['User']['group_id'],
	// 			'alias' => $user['User']['username'],
	// 			'model' => 'User',
	// 			'foreign_key' => $user['User']['id']
	// 			));
	// 	}
	// 	exit;
	// }

/**
 * Thiết lập quyền cho user bình thường
 * ở đây chỉ cần cấp quyền cho user sử dụng những action yêu cầu đăng nhập để thực hiện
 * những action không yêu cầu đăng nhập, đã được Auth Component allow thì không cần cấp quyền ở đây
 */
	private function user_roles($model = 'Group', $foreign_key = null){
		//quyền gởi comment
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Comments/add');
		
		//quyền xem thông tin đơn hàng, check out khi thanh toán
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Orders/history');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Orders/detail');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Orders/checkout');

		//quyền cập nhật thông tin/password, logout
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Users/logout');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Users/change_password');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Users/change_info');
	}
/**
 * Thiết lập quyền quản lý cho manager
 */
	private function manager_roles($model = 'Group', $foreign_key = null){
		//manager cũng có quyền của user bình thường
		$this->user_roles($model,$foreign_key);

		//quyền quản lý books, categories và writers
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Books');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Categories');
		$this->Acl->allow(array('model'=>$model, 'foreign_key'=>$foreign_key),'Writers');

		//không cho phép xóa books, categories và writers
		$this->Acl->deny(array('model'=>$model, 'foreign_key'=>$foreign_key),'Books/admin_delete');
		$this->Acl->deny(array('model'=>$model, 'foreign_key'=>$foreign_key),'Categories/admin_delete');
		$this->Acl->deny(array('model'=>$model, 'foreign_key'=>$foreign_key),'Writers/admin_delete');
	}

/**
 * Hàm thiết lập quyền người dùng, gọi hàm này trên trình duyệt và chỉ chạy 1 lần
 * do hàm này mức truy cập là public nên phải update vào bảng acos mới chạy được.
 * gọi xong hàm này thì disable nó đi :)
 * trong hàm install hiện tại chỉ thiết lập quyền cho 1 người dùng là admin và 3 nhóm ng dùng là manager, user, và banned, 
 */
	// public function admin_install(){
	// 	//set quyền cho user admin có toàn quyền, user_id = 1
	// 	$this->Acl->allow(array('model'=>'User', 'foreign_key'=>1),'controllers');

	// 	//set quyền cho user bình thường, có các quyền cơ bản, group_id = 2 - group user
	// 	$this->user_roles('Group', 2);

	// 	//set quyền cho group quản lý, ngoài quyền cơ bản còn có thêm các quyền quản lý (books, categories và writers)
	// 	// group_id = 3 - group manager
	// 	$this->manager_roles('Group', 5);

	// 	//set quyền cho group bị cấm, không có bất kì quyền gì trên ChickenRainShop
	// 	// group_id = 4 - group banned
	// 	$this->Acl->deny(array('model'=>'Group', 'foreign_key'=>3),'controllers');

	// 	exit; //gọi lệnh này để không bị lỗi missing view
	// }

/**
 * index method
 */
	public function admin_index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 */
	public function admin_view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 */
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Group->set($this->request->data);
			if ($this->Group->validates()) {
				$this->Group->create();
				if ($this->Group->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu thành công'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau'));
				}
			}else{
				$this->set('errors', $this->Group->validationErrors);
			}
		}
	}

/**
 * edit method
 */
	public function admin_edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
			$this->Group->id = $id;
			$this->Group->set($this->request->data);
			if ($this->Group->validates()) {
				if ($this->Group->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu thành công'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau'));
				}
			}else{
				$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
				$this->request->data = $data;
				$this->set('errors', $this->Group->validationErrors);
			}
		}else{
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		} 
	}

/**
 * delete method
 */
	public function admin_delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Không tìm thấy'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Đã xóa thành công'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__('Không xóa được, vui lòng thử lại sau'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
