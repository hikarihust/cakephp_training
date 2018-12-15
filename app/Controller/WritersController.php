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
		// phân trang dữ liệu books
		$this->loadModel('Book');
		$this->paginate = array(
			'fields' => array('id', 'title', 'slug', 'image', 'sale_price'),
			'order' => array('Book.created' => 'desc'),
			'limit' => 5,
			'contain' => array(
				'Writer' => array('name', 'slug')
			),
			'joins' => array(
				array(
					'table' => 'books_writers',
					'alias' => 'BookWriter',
					'type' => 'left',
					'conditions' => 'BookWriter.book_id = Book.id'
				),
				array(
					'table' => 'writers',
					'alias' => 'Writer',
					'type' => 'left',
					'conditions' => 'BookWriter.writer_id = Writer.id'
				)
			),
			'conditions' => array(
				'published' => 1,
				'Writer.slug' => $slug
			),
			'paramType' => 'querystring'
		);
		$books = $this->paginate('Book');
		$this->set('books', $books);
	}
}