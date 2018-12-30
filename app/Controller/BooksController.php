<?php 

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');

/**
 * 
 */
class BooksController extends AppController{

	public $paginate = array(
		'order' => array('created' => 'desc'),
		'limit' => 5,
		'paramType' => 'querystring'
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
	 * Update payment
	 * cập nhật đơn hàng
	 */
	private function update_payment(){
		//tính tổng giá trị đơn hàng
		$cart = $this->Session->read('cart');
		$total = $this->Tool->array_sum($cart, 'quantity', 'sale_price');
		$this->Session->write('payment.total', $total);

		//kiểm tra xem có mã giảm giá hay không
		if ($this->Session->check('payment.coupon')) {
			$pay = $total - $this->Session->read('payment.discount')*$total/100;
			$this->Session->write('payment.pay', $pay);
		}
	}

	/**
	 * add to cart
	 * Thêm sách vào giỏ hàng
	 */
	public function add_to_cart($id = null){
		if ($this->request->is('post')) {
			//tìm thông tin về sản phẩm
			$book = $this->Book->find('first', array(
				'recursive' => -1,
				'conditions' => array('Book.id' => $id) 
			));
			if ($this->Session->check('cart.'.$id)) {
				$item = $this->Session->read('cart.'.$id);
				$item['quantity'] += 1;
			}else{
				$item = array(
					'id' => $book['Book']['id'],
					'title' => $book['Book']['title'],
					'slug' => $book['Book']['slug'],
					'sale_price' => $book['Book']['sale_price'],
					'quantity' => 1
				);
			}
			//tạo giỏ hàng và thêm sản phẩm vào giỏ hàng	
			$this->Session->write('cart.'.$id, $item);

			//tính tổng giá trị của giỏ hàng
			$this->update_payment();

			$this->Session->setFlash('Đã thêm quyển sách vào trong giỏ hàng!', 'default', array('class' => 'alert alert-info'), 'cart');
			$this->redirect($this->referer());
		}
	}

	/**
	 * Xem chi tiết giỏ hàng
	 */
	public function view_cart(){
		$this->layout = 'cart_default';
		$cart = $this->Session->read('cart');
		$payment = $this->Session->read('payment');
		$this->set(compact('cart', 'payment'));
		$this->set('title_for_layout', 'Giỏ hàng');
	}

	/**
	 * Làm rỗng giỏ hàng
	 */
	public function empty_cart(){
		if ($this->request->is('post')) {
			$this->Session->delete('cart');
			$this->Session->delete('payment');
			$this->redirect($this->referer());
		}
	}

	/**
	 * Xóa từng quyển sách ra giỏ hàng
	 */
	public function remove($id = null){
		if ($this->request->is('post')) {
			$this->Session->delete('cart.'.$id);
			$cart = $this->Session->read('cart');
			if (empty($cart)) {
				$this->empty_cart();
			}else{
				$this->update_payment();
			}
			$this->redirect($this->referer());
		}
	}

	/**
	 * Cập nhật số lượng từng quyển sách trong giỏ hàng
	 */
	public function update($id = null){
		if ($this->request->is('post')) {
			$quantity = $this->request->data['Book']['quantity'];
			$book = $this->Session->read('cart.'.$id);
			if (!empty($book) && $quantity > 0) {
				$book['quantity'] = round($quantity);
				$this->Session->write('cart.'.$id, $book);
				//cập nhật đơn hàng
				$this->update_payment();
			}
			$this->redirect($this->referer());
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
				),
				'limit' => 8
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
		$this->set('title_for_layout', 'Tìm kiếm');
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
		// best seller
		$best_seller = $this->Book->best_seller();
		$this->set('best_seller', $best_seller);
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
			'limit' => 8,
			'contain' => array(
				'Writer' => array('name', 'slug')
			),
			'conditions' => array('published' => 1),
			'paramType' => 'querystring'
		);
		$books = $this->paginate();
		$this->set('books', $books);
		$this->set('title_for_layout', 'Sách mới');
	}

/**
 * best_seller method
 * hiển thị sách bán chay 
 */
	public function best_seller(){
		$books = $this->Book->best_seller(16);
		$this->set('title_for_layout', 'Sách bán chạy');
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
					'User' => array('fullname')
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
			'limit' => 4,
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

// ------------------------------------------admin----------------------------------------------//

/**
 * index method
 *
 * @return void
 */
	public function admin_index(){
		$this->paginate = array(
				'order' => array('Book.created' => 'desc'),
				'limit' => 5,
				'paramType' => 'querystring'
			);
		$this->Book->recursive = 0;
		$this->set('books', $this->paginate());
	}

/**
 * view method
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$options = array(
			'conditions' => array(
				'Book.id' => $id
			),
			'contain' => array(
				'Writer'=>array('name','slug')
				),
			);
		$book = $this->Book->find('first', $options);
		//pr($book);
		if (empty($book)) {
			throw new NotFoundException(__('Không tìm thấy quyển sách này!'));
		}
		$this->set('book', $book);
		//hiển thị comments
		$this->loadModel('Comment');
		$comments = $this->Comment->find('all',array(
			'conditions' => array(
				'book_id' => $book['Book']['id']
				),
			'order' => array('Comment.created'=>'asc'),
			'contain' => array(
				'User' => array('fullname')
				)
			));
		//pr($comments);
		$this->set('comments',$comments);
	}
/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Book->create();
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash(__('Đã lưu thành công!'));
				$this->redirect(array('action'=> 'index'));
			}else{
				$this->Session->setFlash(__('Không lưu được, vui lòng thử lại sau!'));
			}
		}
		$categories = $this->Book->Category->generateTreeList();
		$writers = $this->Book->Writer->find('list');
		$this->set(compact('categories', 'writers'));
	}

/**
 * Upload hinh anh tren trang web
 */
	private function uploadFile($folder = null){
		$file = new File($this->request->data['Book']['image']['tmp_name']);
		// $file_name = $this->request->data['Book']['image']['name'];
		$ext = pathinfo($this->request->data['Book']['image']['name'], PATHINFO_EXTENSION);
		$file_name = $this->request->data['Book']['slug']. '.'. $ext;
		if ($file->copy(APP.'webroot/files/'.$folder.'/'.$file_name)) {
			$result = array(
				'status' => true,
				'file_name' => $file_name
			);
		}else{
			$result = array(
				'status' => false,
				'file_name' => $file_name
			);
		}
		return $result;
	} 

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function admin_edit($id = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy quyển sách này'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Book->set($this->request->data);
			unset($this->Book->validate['slug']);
			if ($this->Book->validates()) {
				$this->check_slug('Book', 'name');
				$this->loadModel('Category');
				$category = $this->Category->findById($this->request->data['Book']['category_id']);
				$check = true;
				if (!empty($this->request->data['Book']['image']['name'])) {
					$result = $this->uploadFile($category['Category']['folder']);
					if ($result['status']) {
						$location = '/files/'.$category['Category']['folder'].'/'.$result['file_name'];
						$this->request->data['Book']['image'] = $location;
					}else{
						$this->Session->setFlash(__('Không upload được hình ảnh, vui lòng thử lại sau!.'));
						$check = false;
					}
				}else{
					unset($this->request->data['Book']['image']);
				}
				if ($check) {
					if ($this->Book->saveAll($this->request->data)) {
						$this->Session->setFlash(__('Cập nhật sách thành công!'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Không cập nhật được, vui lòng thử lại sau!.'));
					}
				}
			}else{
				$this->set('errors', $this->Book->validationErrors);
			}
		}else{
			$options = array('conditions' => array('Book.id' => $id));
			$this->request->data = $this->Book->find('first', $options);
		}
		$writers = $this->Book->Writer->find('list');
		$categories = $this->Book->Category->generateTreeList();
		$this->set(compact('categories', 'writers'));
	}

}