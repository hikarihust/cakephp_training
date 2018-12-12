<?php 

App::uses('AppController', 'Controller');

/**
 * 
 */
class BooksController extends AppController{
	public function truyvan(){
		$books = $this->Book->find('all', array(
			'recursive' => -1,
			'fields' => array('id', 'title'),
			'conditions' => array('id <' => 11),
			'order' => array('title' => 'asc'),
			'limit' => 5
		));

		// $books = $this->Book->query("select id, title from books");
		pr($books);
		die();
	}
}