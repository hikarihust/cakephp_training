<?php 

App::uses('AppModel', 'Model');
class Book extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'books';
	public $validate = array(
		'keyword' =>array(
			'rule' => array('notBlank'),
			'message' => 'Bạn phải gõ từ khóa để tìm kiếm.'
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'book_id',
			'dependent' => true
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Writer' => array(
			'className' => 'Writer',
			'joinTable' => 'books_writers',
			'foreignKey' => 'book_id',
			'associationForeignKey' => 'writer_id',
		)
	);

	public function latest(){
		return $this->find('all', array(
			'fields' => array('id', 'title', 'image', 'sale_price', 'slug'),
			'order' => array('created' => 'desc'),
			'limit' => 4,
			'condition' => array('published' => 1),
			'contain' => array('Writer'=> array(
				'fields' => array('name', 'slug')
			))
		));
	}

	public function best_seller($limit = 4){
		return $this->find('all', array(
			'fields' => array('id', 'title', 'image', 'sale_price', 'slug'),
			'condition' => array(
				'Book.hot' => 1,
				'Book.published' =>1
			),
			'order' => 'rand()',
			'limit' => $limit,
			'contain' => array('Writer' => array(
				'fields' => array('name', 'slug')
			))
		));
	}
}