<?php 

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * 
 */
class UsersController extends AppController{

/**
 * forgot password - quen mat khau
 */
	public function forgot(){
		$this->set('title_for_layout', 'Quên mật khẩu');
		if ($this->request->is('post')) {
			$user = $this->User->findByEmail($this->request->data['User']['email']);
			if (!empty($user)) {
				$code = $this->Tool->generate_code();
				$link_confirm = 'http://localhost/cakephp_training/xac-nhan/'.$code;
				$this->User->id = $user['User']['id'];
				$this->User->saveField('code', $code);
				//gởi email link xác nhận
				// $email = new CakeEmail();
				// $email->from(array('vudinhquang22021989@gmail.com' => 'quang'))
				// 	->to(array($user['User']['email'] => $user['User']['name']))
				// 	->subject('Xác nhận thay đổi mật khẩu')
				// 	->send('Bạn vừa yêu cầu thay đổi mật khẩu, vui lòng nhấn vào link để xác nhận: '.$link_confirm);
				$this->Session->setFlash('Vui lòng kiểm tra hộp thư để xác nhận yêu cầu - '.$link_confirm, 'default', array('class' => 'alert alert-success'), 'forgot');
			}else{
				$this->Session->setFlash('Email này chưa được đăng ký trên trang web của chúng tôi', 'default', array('class' => 'alert alert-danger'), 'forgot');
			}
		}
	}

/**
 * confirm - xác nhận yêu cầu đổi mật khẩu khi quên mật khẩu
 */
	public function confirm($code = null){
		$confirm = false;
		if (!empty($code)) {
			$user = $this->User->findByCode($code);
			if (!empty($user)) {
				$confirm = true;
				if ($this->request->is('post')) {
					$this->User->set($this->request->data);
					if ($this->User->validates()) {
						if ($this->update_password($user['User']['id'])) {
							$this->User->updateAll(array('User.code' => null), array('User.id' => $user['User']['id']));
							$this->Session->setFlash('Đăng nhập với mật khẩu mới', 'default', array('class' => 'alert alert-info'), 'auth');
							$this->redirect('/login');
						}else{
							$this->Session->setFlash('Đã có lỗi xảy ra!', 'default', array('class' => 'alert alert-danger'), 'auth');
						}
					}else{
						$this->set('errors', $this->User->validationErrors);
					}
				}
			}
		}
		$this->set('confirm', $confirm);
		$this->set('title_for_layout', 'Yêu cầu đổi mật khẩu mới');
	}

/**
 * change_info - cập nhật thông tin người dùng
 */
	public function change_info(){
		$user_info = $this->get_user();
		if ($this->request->is('put') || $this->request->is('post')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				$data = array(
					'lastname' => $this->request->data['User']['lastname'],
					'firstname' => $this->request->data['User']['firstname'],
					'email' => $this->request->data['User']['email'],
					'phone_number' => $this->request->data['User']['phone_number'],
					'address' => $this->request->data['User']['address']
				);
				$this->User->id = $user_info['id'];
				if ($this->User->save($data)) {
					$this->Session->setFlash('Đã lưu thành công', 'default', array('class' => 'alert alert-info'));
				}else{
					$this->Session->setFlash('Có lỗi xảy ra, vui lòng thử lại!', array('class' => 'alert alert-danger'));
				}
			}else{
				$this->set('errors', $this->User->validationErrors);
			}
		}else{
			$this->request->data = $this->User->findById($user_info['id']);
		}
		$this->set('title_for_layout', 'Cập nhật thông tin');
	}

/**
 * register - đăng ký người dùng mới
 */
	public function register(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				$data = array(
					'group_id'=> 2,
					'lastname' => $this->request->data['User']['lastname'],
					'firstname' => $this->request->data['User']['firstname'],
					'username' => $this->request->data['User']['username'],
					'password' => $this->request->data['User']['password'],
					'email' => $this->request->data['User']['email'],
					'address' => $this->request->data['User']['address'],
					'phone_number' => $this->request->data['User']['phone_number']
				);
				if($this->User->save($data)){
					$this->Auth->login();
					$this->redirect('/');
				}else{
					$this->Session->setFlash('Đăng ký bị lỗi!', 'default', array('class'=>'alert alert-danger'));
				}
			}else{
				$this->set('errors', $this->User->validationErrors);
			}
		}
		$this->set('title_for_layout', 'Đăng ký');
	}



/**
 * update_password - cập nhật mật khẩu
 */
	private function update_password($id){
		$this->User->id = $id;
		$password = $this->request->data['User']['password'];
		if ($this->User->saveField('password', $password)) {
			return true;
		}else{
			return false;
		}
	}

/**
 * change_password - đổi mật khẩu
 */
	public function change_password(){
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				$user_info = $this->get_user();
				if ($this->update_password($user_info['id'])) {
					$this->Session->setFlash('Đã lưu thành công!', 'default', array('class' => 'alert alert-info'));
				}else{
					$this->Session->setFlash('Có lỗi xảy ra, vui lòng thử lại!', 'default', array('class' => 'alert alert-danger'));
				}
			}else{
				$this->set('errors', $this->User->validationErrors);
			}
		}
		$this->set('title_for_layout', 'Đổi mật khẩu');
	}

/**
 * login - đăng nhập xác thực người dùng
 */
	public function login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			}else{
				$user_info = $this->User->findByUsername($this->request->data['User']['username']);
				if (!empty($user_info) && $user_info['User']['active'] == 0) {
					$this->Session->setFlash('Tài khoản của bạn đã bị khóa', 'default', array('class' => 'alert alert-danger'),'auth');
				}else{
					$this->Session->setFlash('Sai tên đăng nhập hoặc mật khẩu!', 'default', array('class' => 'alert alert-danger'),'auth');
				}
			}
		}
		$this->set('title_for_layout', 'Đăng nhập');
	}

/**
 * logout - đăng xuất
 */
	public function logout(){
		$this->redirect($this->Auth->logout());
	}

// ---------------------------------------admin------------------------------------------

/**
 * index method
 */

	public function admin_index(){
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * add method
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu thành công'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau'));
				}
			}else{
				$this->set('errors', $this->User->validationErrors);
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy người dùng này.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(empty($this->request->data['User']['password'])){
				unset($this->request->data['User']['password']);
			}
			$this->User->id = $id;
			$data = $this->request->data;
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('Đã lưu thành công'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->request->data = $data;
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau'));
				}
			}else{

				$this->set('errors', $this->User->validationErrors);
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['password'] = null;
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * lock method - khóa tài khoản user
 */
	public function admin_lock($id = null){
		if ($this->request->is('post')) {
			if ($this->User->updateAll(array('User.active' =>0), array('User.id'=> $id))) {
				$this->Session->setFlash(__('Đã khóa tài khoản thành công.'));
			}
		}else{
			$this->Session->setFlash(__('Không khóa được'));
		}
		$this->redirect(array('action' => 'index'));
	}

/**
 * unlock method - mở khóa tài khoản user
 */
	public function admin_unlock($id = null){
		if ($this->request->is('post')) {
			if ($this->User->updateAll(array('User.active' =>1), array('User.id'=> $id))) {
				$this->Session->setFlash(__('Đã mở khóa tài khoản thành công.'));
			}
		}else{
			$this->Session->setFlash(__('Không mở khóa được'));
		}
		$this->redirect(array('action' => 'index'));
	}


}
