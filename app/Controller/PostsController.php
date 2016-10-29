<?php
class PostsController extends AppController{
	public $helpers = array('Html','Form','Flash');
	public $components = array('Flash','Paginator','Search.Prg');
	public $uses = array('Post','User','Attachment','Tag','Category');	
	public $presetVars = true;

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
			$this->Flash->set('<p>他の人の記事は編集・削除できません</p>',array(
				'key'=>'authorityError'
			));
			$this->redirect(array(
				'controller'=>'posts',
				'action'=>'index',
			));
		}	
	}

	public function index(){
		$this->Post->recursive = 0;
		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions'=>$this->Post->parseCriteria($this->passedArgs),
			'order'=>array('Post.modified'=>'desc')
		);
		$this->set('posts',$this->paginate());
		$this->set('username',$this->Auth->user('username'));
		$this->set('user_id',$this->Auth->user('id'));
		$this->set('category',$this->Category->find('list',array(
			'fields'=>array('Category.categoryname'),
		)));
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
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');


			if($this->Post->saveAll($this->request->data)){
				if(isset($this->request->data['Attachment'][0])){
					$this->Flash->success(__('Your post has been saved.'));
					$this->redirect(array('action'=>'index'));
				}
			}
		}
		$this->set('category',$this->Category->find('list',array(
			'fields'=>array('Category.categoryname'),
		)));
		$this->set('tag',$this->Tag->find('list',array(
			'fields'=>array('Tag.tagname'),
		)));
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
		$this->set('post',$post);
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


