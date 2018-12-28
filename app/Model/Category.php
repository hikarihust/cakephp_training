<?php 

App::uses('AppModel', 'Model');
class Category extends AppModel{
	public $actsAs = array('Containable', 'Tree');
	public $useTable = 'categories';
	public $validate = array();

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