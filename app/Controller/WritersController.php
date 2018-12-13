<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class WritersController extends AppController{

	public $paginate = array(
		'order' => array('created' => 'desc'),
		'limit' => 5
	);

/**
 * index method
 * hiển thị 10 quyển sách mới nhất trên trang chủ
 * @return void
 */
	public function index() {
		$this->paginate = array(
			'fields' => array('name', 'slug'),
			'recursive' => -1,
			'order' => array('Writer.name' => 'asc'),
			'limit' => 5,
			'paramType' => 'querystring'
		);

		$writers = $this->paginate();
		$this->set('writers', $writers);
	}

/**
 *  view method
 */
	public function view($slug = null){
		$options = array(
			'conditions' => array(
				'Writer.slug' => $slug,
			),
			'recursive' => -1
		);
		$writer = $this->Writer->find('first', $options);
		if (empty($writer)) {
			throw new NotFoundException(__('Không tìm thấy tác giả này!'));
		}
		$this->set('writer', $writer);
	}
}