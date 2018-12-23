<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class UsersController extends AppController{
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