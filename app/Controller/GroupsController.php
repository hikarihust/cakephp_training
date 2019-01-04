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

	// public function admin_install(){
	// 	$this->Acl->allow(array('model'=>'Group', 'foreign_key'=>5),'Users/logout');
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
