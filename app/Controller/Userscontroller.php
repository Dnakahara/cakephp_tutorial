<?php

App::uses('AppController','Controller');

class UsersController extends AppController{
	public $uses = array('User','Group');

	protected function isAuthorizedCheck($user = null){
		//all user can edit and delete his own UserInfomation
		if(in_array($this->action,array('edit','delete'))){
			$userId = (int)$this->request->params['pass'][0];
			if((int)$user['id'] === $userId)return;			
		}

		//Admin user can edit and delete all users.
		if(parent::isAuthorizedCheck($user))return;
		else{
			$this->Flash->set(__('You cannot edit and delete others infomation'),array(
				'key'=>'authorityError'
			));
			return $this->redirect(array(
				'controller'=>'users',
				'action'=>'index',
			));
		}
	}

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index','add','logout','login');
		// permissionSetting時には上の制限をコメントアウトして下のコメントアウトを外す
		//$this->Auth->allow();
	}

	/*
	public function permissionSetting(){
		// この関数はaros_acos の設定に使う
		// 使用時のみpublicにし、URLから呼び出して実行することができる。
		// いろんな操作でidに対応するgroupnameがずれてくる可能性もあるので
		// 実行前に必ず以下に書いてある情報が正しいかを確認すること！
		// id : groupname
		//  1 : Admin
		//  2 : Author

		$group = $this->User->Group;

		//Admin グループには全てを許可する
		$group->id = 1;
		$this->Acl->allow($group,'controllers');

		//Author グループにはGroup・Category・Tagの追加・編集・削除を許可しない
		$group->id = 2;
		$this->Acl->deny($group,'controllers');
		$this->Acl->allow($group,'controllers/Pages');
		$this->Acl->allow($group,'controllers/Posts');
		$this->Acl->allow($group,'controllers/Users');
		$this->Acl->allow($group,'controllers/Groups/index');
		$this->Acl->allow($group,'controllers/Categories/index');
		$this->Acl->allow($group,'controllers/Tags/index');

		exit;
	}
	 */

	public function index(){
		$this->User->recursive=0;
		$this->set('users',$this->paginate());
	}

	public function add(){
		if($this->request->is('post')){
			$this->User->create();
			if($this->User->saveAll($this->request->data)){
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array(
					'controller'=>'users',
					'action'=>'index',
				));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		}
		$this->set('groups',$this->Group->find('list',array(
			'fields'=>array('Group.groupname'),
		)));
	}
	
	public function edit($id = null){
		$this->isAuthorizedCheck($this->Auth->user());
		if(!$id){
			throw new NotFoundException(__('Invalid user'));
		}
		$this->User->id = $id;
		if(!$this->User->exists()){
			throw new NotFoundEXception(__('Invalid user'));
		}

		if($this->request->is('post') || $this->request->is('put')){
			if($this->User->save($this->request->data)){
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		}else{
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
			$this->set('user',$this->request->data);
		}
	}

	public function delete($id = null){
		$this->isAuthorizedCheck($this->Auth->user());
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		$this->User->id = $id;
		if(!$this->User->exists()){
			throw new NotFoundException(__('Invalid user'));
		}

		if($this->User->delete()){
			$this->Flash->success(__('User deleted'));
			return $this->redirect(array('action'=>'index'));
		}else {
			$this->Flash->error(
				__('The user with id: %s could not be deleted.',h($id))
			);
		}
	}

	public function login(){
		if($this->request->is('post')){
			if($this->Auth->login()){
				$this->redirect($this->Auth->redirectUrl());
			}else{
				$this->Flash->error(__('Invalid username or password.try, again!'));
			}
		}
	}
	
	public function logout(){
		$this->redirect($this->Auth->logout());
	}
}
