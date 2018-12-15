<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class BooksController extends AppController{

	public $paginate = array(
		'order' => array('created' => 'desc'),
		'limit' => 5
	);

	public function truyvan(){
		// $books = $this->Book->find('all', array(
		// 	'recursive' => -1,
		// 	'fields' => array('id', 'title'),
		// 	'conditions' => array('id <' => 11),
		// 	'order' => array('title' => 'asc'),
		// 	'limit' => 5
		// ));

		// $books = $this->Book->query("select id, title from books");

		$books = $this->Book->find('first', array(
			// 'recursive' => 1
			'fields' => array('id', 'title'),
			'contain' => array(
				'Writer' => array(
					'fields' => array('id', 'name')
				), 
				'Comment' => array(
					'limit' => 1
				)
			)
		));
	}


/**
 * index method
 * hiển thị 10 quyển sách mới nhất trên trang chủ
 * @return void
 */
	public function index() {
		// Truy van du lieu tren Controller
		// $books = $this->Book->find('all', array(
		// 	'fields' => array('id', 'title', 'image', 'sale_price', 'slug'),
		// 	'order' => array('created' => 'desc'),
		// 	'limit' => 10,
		// 	'condition' => array('published' => 1),
		// 	'contain' => array('Writer'=> array(
		// 		'fields' => array('name', 'slug')
		// 	))
		// ));

		// Truy van du lieu tren Model
		$books = $this->Book->latest();
		$this->set('books', $books);
	}

/**
 * latest_books method
 * hiển thị tất cả các quyển sách và sắp xếp theo thứ tự từ mới đến cũ
 * phân trang dữ liệu
 */
	public function latest_books(){
		$this->paginate = array(
			'fields' => array('id', 'title', 'slug', 'image', 'sale_price'),
			'order' => array('Book.created' => 'desc'),
			'limit' => 5,
			'contain' => array(
				'Writer' => array('name', 'slug')
			),
			'conditions' => array('published' => 1),
			'paramType' => 'querystring'
		);
		$books = $this->paginate();
		$this->set('books', $books);
	}

/**
 * view method
 * Xem thông tin chi tiết một quyển sách
 */
	public function view($slug = null){
		$options = array(
			'conditions' => array(
				'Book.slug' => $slug
			),
			// 'contain' => array(
			// 	'Writer' => array('name', 'slug')
			// ),
		);
		$book = $this->Book->find('first', $options);
		if (empty($book)) {
			throw new NotFoundException(__('Không tìm thấy quyển sách này!'));
		}
		$this->set('book', $book);
		// Hiển thị comment
		$this->loadModel('Comment');
		$comments = $this->Comment->find('all', array(
				'conditions' => array(
					'book_id' => $book['Book']['id']
				),
				'order' => array('Comment.created' => 'asc'),
				'contain' => array(
					'User' => array('username')
				)
			)
		);
		$this->set('comments', $comments);
	}
}