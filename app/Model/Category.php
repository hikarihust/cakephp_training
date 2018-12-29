<?php 

App::uses('AppModel', 'Model');
class Category extends AppModel{
	public $actsAs = array('Containable', 'Tree');
	public $useTable = 'categories';
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Tên danh mục không được để trống'
			)
		),
		'slug' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Phần slug không được để trống'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Slug cho danh mục này đã có, vui lòng đổi slug khác.'
			)
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'category_id',
			'dependent' => true
		)
	);
}