<?php
App::uses('AppController','Controller');

class GroupsController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
	}


	public function index(){
		$this->Group->recursive=0;
		$this->set('groups',$this->paginate());
	}

	public function add(){
		if($this->request->is('post')){
			$this->Group->create();
			if($this->Group->saveAll($this->request->data)){
				$this->Flash->success(__('The group has been saved'));
				return $this->redirect(array(
					'controller'=>'posts',
					'action'=>'index',
				));
			}
			$this->Flash->error(
				__('The group could not be saved. Please, try again.')
			);
		}
	}

	public function edit($id = null){
		$this->Group->id = $id;
		if(!$this->Group->exists()){
			throw new NotFoundEXception(__('Invalid user'));
		}

		if($this->request->is('post') || $this->request->is('put')){
			if($this->Group->save($this->request->data)){
				$this->Flash->success(__('The group has been saved'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(
				__('The group could not be saved. Please, try again.')
			);
		}else{
			$this->request->data = $this->Group->findById($id);
			$this->set('group',$this->request->data);
		}
	}

	public function delete($id = null){

		$this->request->allowMethod('post');

		$this->Group->id = $id;
		if(!$this->Group->exists()){
			throw new NotFoundException(__('Invalid group'));
		}

		if($this->Group->delete()){
			$this->Flash->success(__('group deleted'));
			return $this->redirect(array('action'=>'index'));
		}
	}
}
