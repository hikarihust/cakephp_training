<?php 

App::uses('AppModel', 'Model');
class Coupon extends AppModel{
	public $actsAs = array('Containable');
	public $useTable = 'coupons';
	public $validate = array();
}