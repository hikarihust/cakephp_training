<?php 

App::uses('AppModel', 'Model');
class Comment extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'comments';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			)
		),
		'book_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			)
		),
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Nội dung nhận xét không được để trống.'
			),
			'minlength' => array(
				'rule' => array('minlength', 8),
				'message' => 'Nội dung nhận xét phải có độ dài lớn hơn 8 ký tự'
			)
		)
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
			'foreignKey' => 'book_id',
			'counterCache' => true
		)
	);
}