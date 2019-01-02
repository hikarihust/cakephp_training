<?php 

App::uses('AppModel', 'Model');
class Coupon extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'coupons';
	public $validate = array(
		'code' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Mã giảm giá không được để trống'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Mã giảm giá cho Coupon này đã có, vui lòng đổi mã giảm giá khác.'
			)
		),
		'percent' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Vui lòng nhập % giảm giá'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Ô % giảm giá chỉ được nhập ở dạng số'
			)
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Vui lòng nhập nội dung cho phần description'
			)
		)
	);
}