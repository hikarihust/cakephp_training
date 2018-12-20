<?php 

App::uses('AppModel', 'Model');
class Order extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'orders';
	public $validate = array();

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);
}