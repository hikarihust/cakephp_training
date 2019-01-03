<?php
App::uses('AppModel', 'Model');
/**
 *Page Model
 */
class Page extends AppModel {
	public $useTable = false;
	public $validate = array(
		'fullname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Họ và Tên không được để trống',
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Email không được để trống',
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email không đúng định dạng',
			)
		),
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Nội dung liên hệ không được để trống.',
			),
			'minlength' => array(
				'rule' => array('minLength',10),
				'message' => 'Nội dung liên hệ quá ngắn'
				)
		),
	);

}