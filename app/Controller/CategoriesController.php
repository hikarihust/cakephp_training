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
			'limit' => 5,
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

}