<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class UsersController extends AppController{

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
 * change_password - đổi mật khẩu
 */
	public function change_password(){
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				$user_info = $this->get_user();
				$this->User->id = $user_info['id'];
				$password = $this->request->data['User']['password'];
				if ($this->User->saveField('password', $password)) {
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
				$this->Session->setFlash('Sai tên đăng nhập hoặc mật khẩu!', 'default', array('class' => 'alert alert-danger'),'auth');
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
}