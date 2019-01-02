<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 */
class Group extends AppModel {

	public $actsAs = array('Containable');
	public $useTable = 'groups';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Tên Group không được để trống.',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Tên Group này đã có, vui lòng nhập tên khác.'
			)
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
		)
	);
}
