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
			$categories = $this->Category->find('all', array(
				'recursive' => -1,
				'order' => array('name' => 'asc')
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
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Đã tạo danh mục mới thành công!'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau!.'));
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
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Đã cập nhật danh mục thành công.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Không cập nhật được, vui lòng thử lại sau!.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$categories = $this->Category->generateTreeList();
		$this->set('categories',$categories);
	}

}