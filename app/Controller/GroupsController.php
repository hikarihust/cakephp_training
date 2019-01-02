<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

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

}
