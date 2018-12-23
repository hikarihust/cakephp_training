<?php 

App::uses('AppModel', 'Model');
class User extends AppModel{
	public $virtualFields = array(
		'fullname' => 'CONCAT(User.lastname, " ", User.firstname)'
	);
	public $actsAs = array('Containable');
	public $useTable = 'users';
	public $validate = array(
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Mật khẩu không được để trống',
			),
			'minlength' => array(
				'rule' => array('minlength', 6),
				'message'=>'Mật khẩu phải có độ dài tối thiểu là 6 ký tự'
			)
		),

		'confirm_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Xác nhận mật khẩu không được để trống',
			),
			'password_confirm' => array(
				'rule' => array('match_password','password'),
				'message'=>'Xác nhận mật khẩu không đúng'
			)
		)
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

 	public function match_password($check, $password_field = 'password'){
 		$password = $this->data['User'][$password_field];
 		$confirm_password = $this->data['User']['confirm_password'];
 		if (strcmp($password, $confirm_password) == 0) {
 			return true;
 		}else{
 			return false;
 		}
 	}

 	public function beforeSave($option = array()){
 		if (isset($this->data['User']['password'])) {
 			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
 		}
 		return true;
 	}
}