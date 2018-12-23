<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class UsersController extends AppController{
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