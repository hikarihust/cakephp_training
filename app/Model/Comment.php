<?php 

App::uses('AppModel', 'Model');
class Comment extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'comments';
	public $validate = array(
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'book_id'
		)
	);
}