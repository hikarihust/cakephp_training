<?php 

App::uses('AppModel', 'Model');
class Category extends AppModel{
	public $actsAs = array('Containable');
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
		)
	);
}