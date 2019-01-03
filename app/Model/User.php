<?php 

App::uses('AppModel', 'Model');
class User extends AppModel{
	public $virtualFields = array(
		'fullname' => 'CONCAT(User.lastname, " ", User.firstname)'
	);
	public $actsAs = array(
		'Containable',
		'Acl' => array('type' => 'requester')
	);
	public $useTable = 'users';
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Tên đăng nhập không được để trống',
			),
			'unique' => array(
				'rule'=> 'isUnique',
				'message'=>'Tên đăng nhập đã được đăng ký, vui lòng đổi tên đăng nhập khác'
			),	
		),
		'lastname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Vui lòng điền vào họ của bạn'
			)
		),
		'firstname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Vui lòng điền vào tên của bạn'
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
			),
			'unique' => array(
				'rule'=> 'isUnique',
				'message'=>'Email đã được đăng ký, vui lòng đổi email khác'
			),
		),
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
		),
		'confirm' => array(
			'notBlank' => array(
				'rule'    => array('comparison', '!=', 0),
				'message' => 'Vui lòng check vào ô đồng ý điều khoản của trang web để đăng ký.'
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

 	public function beforeValidate($option = array()){
 		if (isset($this->data['User']['email'])) {
 			$user_info = AuthComponent::user();
 			if (!empty($user_info)) {
 				$user = $this->findById($user_info['id']);
 			}
 			if (!empty($user) && $this->data['User']['email'] == $user['User']['email']) {
 				unset($this->data['User']['email']);
 			}
 		}
 		return true;
 	}

	public function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    $data = $this->data;
	    if (empty($this->data)) {
	        $data = $this->read();
	    }
	    if (!$data['User']['group_id']) {
	        return null;
	    }
	    return array('Group' => array('id' => $data['User']['group_id']));
	}
}