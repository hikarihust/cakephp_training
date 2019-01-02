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
			'limit' => 8,
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
		$this->set('title_for_layout', 'Tác Giả - '.$writer['Writer']['name']);
	}

// ----------------------------------------admin-----------------------------------

/**
 * index method
 */
	public function admin_index(){
		$this->Writer->recursive = 0;
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit'=>5
		);

		$this->set('writers', $this->paginate());
	}

/**
 * view method
 */
	public function admin_view($id = null) {
		if (!$this->Writer->exists($id)) {
			throw new NotFoundException(__('Không tìm thấy tác giả này'));
		}
		$options = array('conditions' => array('Writer.' . $this->Writer->primaryKey => $id));
		$this->set('writer', $this->Writer->find('first', $options));
	}

/**
 * add method
 */
	public function admin_add(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Writer->set($this->request->data);
			unset($this->Writer->validate['slug']);
			if ($this->Writer->validates()) {
				$this->check_slug('Writer', 'name');
				$this->Writer->validate['slug'] = array(
					'notBlank' => array(
						'rule' => array('notBlank'),
						'message' => 'Phần slug không được để trống',
					),
					'unique' => array(
						'rule'=> 'isUnique',
						'message'=>'Slug cho tác giả này đã có, vui lòng đổi slug khác.'
					),
				);
				$this->Writer->set($this->request->data);
				if ($this->Writer->validates()) {
					$this->Writer->create();
					if ($this->Writer->save($this->request->data)) {
						$this->Session->setFlash(__('Đã lưu thành công!'));
						$this->redirect(array('action'=>'index'));
					}else{
						$this->Session->setFlash(__('Chưa lưu được, vui lòng thử lại.'));
					}
				}else{
					$this->set('errors', $this->Writer->validationErrors);
				}
			}else{
				$this->set('errors', $this->Writer->validationErrors);
			}
		}
		$books = $this->Writer->Book->find('list');
		$this->set('books', $books);
	}

}