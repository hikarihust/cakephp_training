<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class CategoriesController extends AppController{

/**
 * Menu categories
 */
	public function menu(){
		if ($this->request->is('requested')) {
			$categories = $this->Category->find('threaded', array(
				'recursive' => -1,
				'order' => array('lft' => 'asc')
			));
			return $categories;
		}
	}

/**
 * view method
 * Xem thông tin chi tiết một quyển sách
 */
	public function view($slug = null){
		$options = array(
			'conditions' => array(
				'Category.slug' => $slug
			),
			'recursive' => -1
		);
		$category = $this->Category->find('first', $options);
		if (empty($category)) {
			throw new NotFoundException(__('Không tìm thấy!'));
		}
		$this->set('category', $category);
		// Phan trang du lieu books
		$this->loadModel('Book');
		$this->paginate = array(
			'fields' => array('id','title','slug','image','sale_price'),
			'order' => array('Book.created'=>'desc'),
			'limit' => 8,
			'contain' => array(
				'Writer' => array('name','slug'),
				'Category'=> array('slug')
				),
			'conditions' => array(
				'published' => 1,
				'Category.slug' => $slug
				),
			'paramType' => 'querystring'
			);
		$books = $this->paginate('Book');
		$this->set('books',$books);
	}

// --------------------------------admin-------------------------------------//

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		// $this->Category->recover();
		$this->paginate = array(
			'order' => array('lft' => 'asc')
		);
		$this->Category->recursive = -1;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Category->set($this->request->data);
			$this->Category->validate = array(
					'name' => array(
						'notBlank' => array(
							'rule' => array('notBlank'),
							'message' => 'Tên danh mục không được để trống'
						)
					),
				);
			if ($this->Category->validates()) {
				$this->check_slug('Category', 'name');
				$this->Category->create();
				if ($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('Đã tạo danh mục mới thành công!'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau!.'));
				}
			}else{
				$this->set('errors', $this->Category->validationErrors);
			}
		}
		$categories = $this->Category->generateTreeList();
		$this->set('categories',$categories);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy danh mục này'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Category->set($this->request->data);
			$this->Category->validate = array(
					'name' => array(
						'notBlank' => array(
							'rule' => array('notBlank'),
							'message' => 'Tên danh mục không được để trống'
						)
					),
				);
			if ($this->Category->validates()) {
				$this->check_slug('Category', 'name');
				$this->Category->id = $id;
				if ($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('Cập nhật danh mục mới thành công!'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không cập nhật được, vui lòng thử lại sau!.'));
				}
			}else{
				$this->set('errors', $this->Category->validationErrors);
			}
		}else{
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$categories = $this->Category->generateTreeList();
		$this->set('categories',$categories);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Không tìm thấy danh mục này!'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->removeFromTree($id,true)) {
			$this->Session->setFlash(__('Đã xóa danh mục thành công!'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Không xóa được, vui lòng thử lại sau!'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * up - Chuyển danh mục lên
 */
	public function admin_up($id = null){
		if ($this->request->is('post')) {
			$this->Category->id = $id;
			if ($this->Category->exists()) {
				$this->Category->moveUp($id, 1);
			}
		}
		$this->redirect($this->referer());
	}

/**
 * down - Chuyển danh mục xuống
 */
	public function admin_down($id = null){
		if ($this->request->is('post')) {
			$this->Category->id = $id;
			if ($this->Category->exists()) {
				$this->Category->moveDown($id, 1);
			}
		}
		$this->redirect($this->referer());
	}

}