<?php 

App::uses('AppModel', 'Model');
class Writer extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'writers';
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Vui lòng điền tên tác giả'
			)
		),
		'slug' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Phần slug không được để trống',
			),
			'unique' => array(
				'rule'=> 'isUnique',
				'message'=>'Slug cho tác giả này đã có, vui lòng đổi slug khác.'
			),
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className' => 'Book',
			'joinTable' => 'books_writers',
			'foreignKey' => 'writer_id',
			'associationForeignKey' => 'book_id',
		)
	);
}