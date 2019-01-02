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

}
