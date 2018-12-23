<?php 

App::uses('AppModel', 'Model');
class User extends AppModel{
	public $virtualFields = array(
		'fullname' => 'CONCAT(User.lastname, " ", User.firstname)'
	);
	public $actsAs = array('Containable');
	public $useTable = 'users';
	public $validate = array(

	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
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
 			'foreignKey' => 'user_id'
 		),
 		'Order' => array(
 			'className' =>'Order',
 			'foreignKey' => 'user_id'
 		)
 	);
}