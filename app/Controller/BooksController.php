<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class BooksController extends AppController{
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
}