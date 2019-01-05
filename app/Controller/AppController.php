<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session', 'Tool', 
		'Auth' => array(
			'loginAction' => '/login',
			'authError' => false,
			'loginRedirect' => '/',
			'authenticate' => array(
				'Form' => array(
					'scope' => array('User.active' => 1)
				)
			),
			'authorize' => array(
				'Actions' => array('actionPath'=>'controllers')
			)
		),
		'Acl'
	);

	public $helpers = array('Display');

	public function beforeFilter(){
		$this->Auth->allow('about','policy','contact', 'confirm', 'forgot', 'register', 'menu', 'view', 'index', 'best_seller', 'latest_books', 'add_to_cart', 'view_cart', 'empty_cart', 'update', 'remove', 'get_keyword', 'search');
		// $this->set('user_info', $this->get_user());
		if (substr($this->request->params['action'], 0, 6) == 'admin_') {
			$this->layout = 'admin';
		}
	}

	// public function get_user(){
	// 	if ($this->Auth->login()) {
	// 		return $this->Auth->user();
	// 	}
	// }

	public function check_slug($model,  $name, $slug_field = 'slug'){
		if(empty($this->request->data[$model][$slug_field])){
			$this->request->data[$model][$slug_field] = $this->Tool->slug($this->request->data[$model][$name]);
		}else{
			$this->request->data[$model][$slug_field] = $this->Tool->slug($this->request->data[$model][$slug_field]);
		}
	}
}
