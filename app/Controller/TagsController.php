<?php
App::uses('AppController','Controller');

class TagsController extends AppController{
	public function index(){
		$this->Tag->recursive=0;
		$this->set('tags',$this->paginate());
	}

	public function add(){
		if($this->request->is('post')){
			$this->Tag->crate();
			if($this->Tag->saveAll($this->request->data)){
				$this->Flash->success(__('The tag has been saved'));
				return $this->redirect(array(
					'controller'=>'tags',
					'action'=>'index',
				));
			}
			$this->Flash->error(
				__('The tag could not be saved. Please, try again.')
			);
		}

	}

	public function edit($id = null){
		debug($this->request->data);exit;
		$this->Tag->id = $id;
		if(!$this->Tag->exists()){
			throw new NotFoundException(__('Invalid tag'));
		}
		if($this->request->is('post') || $this->request->is('put')){
			if($this->Tag->save($this->reqeust->data)){
				$this->Flash->success(__('The tag has been saved'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(
				__('The tag could not be saved. Please, try again.')
			);
		}else{
			$this->request->data = $this->Tag->findById($id);
			$this->set('tag',$this->request->data);
		}

	}

	public function delete($id = null){
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		$this->Tag->id = $id;
		if(!$this->Tag->exists()){
			throw new NotFoundException(__('Invalid tag'));
		}
		if($this->Tag->delete()){
			$this->Flash->success(__('Tag deleted'));
			return $this->redirect(array('action'=>'index'));
		}else {
			$this->Flash->error(
				__('The tag with id: %s could not be deleted.',h($id))
			);
		}
	}
}
