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

	/**
	 * Xử lý get_keyword
	 */
	public function get_keyword(){
		if ($this->request->is('post')) {
			$this->Book->set($this->request->data);
			if ($this->Book->validates()) {
				$keyword = $this->request->data['Book']['keyword'];
			}else{
				$errors = $this->Book->validationErrors;
				$this->Session->write('search_validation', $errors);
			}
			$this->redirect(array(
				'action' => 'search',
				'keyword' => $keyword
			));
		}
	}

	/**
	 * Tim kiem sach
	 */
	public function search(){
		$notfound = false;
		if (!empty($this->request->params['named']['keyword'])) {
			$keyword = $this->request->params['named']['keyword'];
			$this->paginate = array(
				'fields' => array('title', 'image', 'sale_price', 'slug'),
				'contain' => array(
					'Writer' => array('name', 'slug')
				),
				'order' => array('Book.created' => 'desc'),
				'conditions' => array(
					'Book.published' => 1,
					'or' => array(
						'title like' => '%'.$keyword.'%',
						'Writer.name like' => '%'.$keyword.'%'
					)
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
				)
			);
			$books = $this->paginate('Book');
			if (!empty($books)) {
				$this->set('results', $books);
			}else{
				$notfound = true;
			}	
			$this->set('keyword', $keyword);
		}
		if ($this->Session->check('search_validation')) {
			$this->set('errors', $this->Session->read('search_validation'));
			$this->Session->delete('search_validation');
		}
		$this->set('notfound', $notfound);
	}

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
		$this->set('title_for_layout', 'Home');
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
			'contain' => array(
				'Writer' => array('name', 'slug')
			),
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
		// Hiển thị sách liên quan
		$related_books = $this->Book->find('all', array(
			'fields' => array('title', 'image', 'sale_price', 'slug'),
			'conditions' => array(
				'category_id' => $book['Book']['category_id'],
				'Book.id <>' => $book['Book']['id'],
				'published' => 1
			),
			'limit' => 5,
			'order' => 'rand()',
			'contain' => array(
				'Writer' => array('name', 'slug')
			)
		));
		$this->set('related_books', $related_books);
		// Báo lỗi xác thực dữ liệu khi gởi comment
		if($this->Session->check('comment_errors')){
			$errors = $this->Session->read('comment_errors');
			$this->set('errors', $errors);
			$this->Session->delete('comment_errors');
		}
	}

/**
 * update comment_count trong bang books
 */
	// public function update_comment(){
	// 	$books = $this->Book->find('all', array(
	// 		'fields' => array('id'),
	// 		'contain' => 'Comment'
	// 	));
	// 	foreach ($books as $book) {
	// 		if (count($book['Comment']) > 0) {
	// 			$this->Book->updateAll(
	// 				array('comment_count' => count($book['Comment'])),
	// 				array('Book.id' => $book['Book']['id'])
	// 			);
	// 		}
	// 	}
	// }
}