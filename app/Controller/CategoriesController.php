<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class CategoriesController extends AppController{

/**
 * view method
 * Xem thông tin chi tiết một quyển sách
 */
	public function view($slug = null){
		$options = array(
			'conditions' => array(
				'Category.slug' => $slug
			)
		);
		$category = $this->Category->find('first', $options);
		if (empty($category)) {
			throw new NotFoundException(__('Không tìm thấy!'));
		}
		$this->set('category', $category);
	}

}