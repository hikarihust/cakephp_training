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
		pr($books);
		die();
	}
}