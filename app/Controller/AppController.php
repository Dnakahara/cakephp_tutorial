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
App::uses('AuthComponent','Controller/Component');

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
	public $helpers = array(
		'Form',
		'Html',
		'Paginator',
	);

	public $components = array(
		'Acl',
		'Auth'=>array(
			'loginAction'=>array(
				'controller'=>'users',
				'action'=>'login',
			),
			'loginRedirect'=>array(
				'controller'=>'posts',
				'action'=>'index'
			),
			'logoutRedirect'=>array(
				'controller'=>'posts',
				'action'=>'index',
			),
			'authenticate'=>array(
				AuthComponent::ALL=>array(
					'userModel'=>'User',
				),
				'Form'=>array(
					'passwordHasher'=>'Blowfish'
				),
			),
			'authorize'=>array(
				AuthComponent::ALL=>array(
					'actionPath'=>'controllers',
					'userModel'=>'User',
				),
				'Actions',
			),
		),
		'Flash',
		'Paginator',
		'Session',
	);

	protected function isAuthorizedCheck($user = null){
		//Admin can access every action
		if(isset($user['group_id']) && $user['group_id']==='1'){
			return true;
		}

		//deny on default
		return false;
	}

	public function beforeFilter(){
		$this->Auth->allow('display');
	}
	
	public function beforeRender(){
		$this->set('username',$this->Auth->user('username'));
	}
}
