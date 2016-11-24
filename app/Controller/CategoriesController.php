<?php 
App::uses('AppController','Controller');

class CategoriesController extends AppController{
	public $uses = array('Category');	

	public function index(){
		$this->Category->recursive=0;
		$this->paginate = array(
			'order'=>array(
				'Category.id'=>'asc'
			),
			'limit'=>30,
			'maxLimit'=>30,
		);
		$this->set('categories',$this->paginate());
	}

	public function add(){
		if($this->request->is('post')){
			$this->Category->create();
			if($this->Category->saveAll($this->request->data)){
				$this->Flash->success(__('The category has been saved'));
				return $this->redirect(array(
					'controller'=>'categories',
					'action'=>'index',
				));
			}
			$this->Flash->error(
				__('The categories could not be saved. Please, try again.')
			);
		}

	}

	public function edit($id = null){
		if(!$id){
			throw new NotFoundException(__('Invalid category'));
		}

		$this->Category->id = $id;
		if(!$this->Category->exists()){
			throw new NotFoundException(__('Invalid category'));
		}
		if($this->request->is('post') || $this->request->is('put')){
			if($this->Category->save($this->request->data)){
				$this->Flash->success(__('The category has  been saved'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(
				__('The category could not be saved. Please, try again.')
			);
		}else{
			$this->request->data = $this->Category->findById($id);
			$this->set('category',$this->request->data);
		}

	}

	public function delete($id = null){
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		$this->Category->id = $id;
		if(!$this->Category->exists()){
			throw new NotFoundException(__('Invalid category'));
		}
		if($this->Category->delete()){
			$this->Flash->success(__('Category deleted'));
			return $this->redirect(array('action'=>'index'));
		}else {
			$this->Flash->error(
				__('The category with id: %s could not be deleted.',h($id))
			);
		}
	}
}
