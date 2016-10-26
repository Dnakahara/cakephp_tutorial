<?php
class PostsController extends AppController{
	public $helpers = array('Html','Form','Flash');
	public $components = array('Flash');
	public $uses = array('Post','User');
	
	public function isAuthorized($user = null){
		//all author can add posts.
		if(in_array($this->action,array('add','index','view'))){
			return true;
		}

		//all author can edit and delete his own posts.
		if(in_array($this->action,array('edit','delete'))){
			$postId = (int)$this->request->params['pass'][0];
			if($this->Post->isOwnedBy($postId,$user['id'])){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}

	public function beforeFilter(){
		parent::beforeFilter();

		if(!$this->isAuthorized($this->Auth->user())){
			$this->redirect(array(
				'controller'=>'posts',
				'action'=>'index',
			));
		}	
	}

	public function index(){
		$this->set('posts',$this->Post->latestAllPosts()); 
		$this->set('username',$this->Auth->user('username'));
		$this->set('user_id',$this->Auth->user('id'));
		//$this->set('authorname',$this->User->find('');
	}

	public function view($id = null){
		if(!$id){
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post',$post);
	}

	public function add(){
		if($this->request->is('post')){
			$this->Post->create();
			$this->request->data['Post']['user_id'] = $user_id;
			if($this->Post->save($this->request->data)){
				$this->Flash->success(__('Your post has been saved.'));
				$this->redirect(array('action'=>'index'));
			}
		}
	}

	public function edit($id = null){
		if(!$id){
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid post'));
		}

		if($this->request->is(array('post','put'))){
			$this->Post->id = $id;
			if($this->Post->save($this->request->data)){
				$this->Flash->success(__('Your post has been updated.'));
				$this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(__('Unable to update your post.'));
		}

		if(!$this->request->data){
			$this->request->data = $post;
		}
	}

	public function delete($id){
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		if($this->Post->delete($id)){
			$this->Flash->success(
				__('The post with id: %s has been deleted.',h($id))
			);
		}else {
			$this->Flash->error(
				__('The post with id: %s could not be deleted.',h($id))
			);
		}
		return $this->redirect(array('action'=>'index'));
	}
}


