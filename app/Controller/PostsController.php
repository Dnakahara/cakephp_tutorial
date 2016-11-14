<?php
App::uses('AppController','Controller');

class PostsController extends AppController{
	public $helpers = array('Flash');
	public $components = array(
		'Search.Prg'=>array(
			'presetForm'=>array(
				'paramType'=>'querystring',
				'model'=>'Post'
			),
			'commonProcess'=>array(
				'formName'=>null,
				'keepPassed'=>true,
				'action'=>null,
				'modelMethod'=>'validateSearch',
				'allowedParams'=>array(),
				'paramType'=>'querystring',
				'filterEmpty'=>false,
			),
		),
	);
	public $uses = array('Post','User','Attachment','Tag','PostsTag','Category');	
	public $presetVars = true;

	private function trimUploaded(){
		//saveしようとしている記事中の未入力のファイルフォームからのデータは取り除く
		for($i = 0; $i < count($this->request->data['Attachment']);$i++){
			if(isset($this->request->data['Attachment'][$i]['photo']['name'])
			   && $this->request->data['Attachment'][$i]['photo']['name']===''){
				unset($this->request->data['Attachment'][$i]);
			}
		}

		//取り除くだけでは連想配列の添え字がずれているので0から詰める
		array_values($this->request->data['Attachment']);

		//結局一つもファイルがアップロードされていなかったら、
		//空のデータをattachments テーブルに保存しないために、
		//一時的にPostとAttachmentのアソシエーションを切る
		if(count($this->request->data['Attachment']) == 0){
			$this->Post->unbindModel(array('hasMany'=>'Attachment'));
			unset($this->request->data['Attachment']);
		}
	}

	public function isAuthorizedCheck($user = null){

		//all user can edit and delete his own posts.
		if(in_array($this->action,array('edit','delete'))){
			$postId = (int)$this->request->params['pass'][0];
			if($this->Post->isOwnedBy($postId,$user['id']))return;
		}

		//Admin user can edit and delete all posts.
		if(parent::isAuthorizedCheck($user))return;
		else{
			$this->Flash->set(__('You cannot edit and delete others posts'),array(
				'key'=>'authorityError'
			));
			return $this->redirect(array(
				'controller'=>'posts',
				'action'=>'index',
			));
		}
	}

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','view'));
	}

	public function index(){
		$this->Post->recursive = 1;
		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions'=>$this->Post->parseCriteria($this->passedArgs),
			'order'=>array(
				'Post.modified'=>'desc'
			),
			'maxLimit'=>20,
		);
		$this->set('posts',$this->paginate());
//		debug($this->request->params['paging']);exit;
		$this->set('category',$this->Category->find('list',array(
			'fields'=>array('Category.categoryname'),
		)));
		$this->set('tag',$this->Tag->find('list',array(
			'fields'=>array('Tag.tagname'),
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
		unset($post['User']['password']);
		$this->set('post',$post);
		$imgSrcPrefix = '..'.DS.'..'.DS.'files'.DS.'attachment'.DS.'photo'.DS;
		$this->set('imgSrcPrefix',$imgSrcPrefix);
	}

	public function add(){
		if($this->request->is('post')){
			$this->Post->create();
			
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');

			$this->trimUploaded();

			if($this->Post->saveAll($this->request->data,array('deep'=>true))){
				$this->Flash->success(__('Your post has been saved.'));
				$this->redirect(array('action'=>'index'));
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
		$this->isAuthorizedCheck($this->Auth->user());

		if(!$id){
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid post'));
		}

		if($this->request->is(array('post','put'))){
			if($id!==$this->request->data['Post']['id']){
				$this->Flash->error(__('Unable to update your post.'));
			}
			
			$this->Post->id = $this->request->data['Post']['id'];
			$nowUploaded = $this->request->data['Attachment'];

			
			$this->request->data['Attachment'] = $post['Attachment'];
			if($nowUploaded !== null){
				foreach($nowUploaded as $img){
					$this->request->data['Attachment'] []= $img;
				}
			}

			$this->trimUploaded();

			if($this->Post->saveAll($this->request->data,array('deep'=>true))){
				if(!empty($this->request->data['Original']['removedImages'])){
					foreach($this->request->data['Original']['removedImages'] as $key=>$val){
						//debug($this->request->data['Attachment']);exit;
						if($this->Post->Attachment->delete($this->request->data['Attachment'][$val]['id'])){
							$this->Flash->success(
								__('The image with id: %s has been deleted.',h($this->request->data['Attachment'][$val]['id']))
							);
						}else {
							$this->Flash->error(
								__('The image with id: %s could not be deleted.',h($this->request->data['Attachment'][$val]['id']))
							);
						}
					}
				}
				$this->Flash->success(__('Your post has been updated.'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Flash->error(__('Unable to update your post.'));
		}

		if(!$this->request->data){
			$this->request->data = $post;
		}
		unset($post['User']['password']);
		$this->set('post',$post);

		$this->set('category',$this->Category->find('list',array(
			'fields'=>array('Category.categoryname'),
		)));
		$selectedCategory = $post['Category']['id'];
		$this->set('selectedCategory',$selectedCategory);

		$this->set('tag',$this->Tag->find('list',array(
			'fields'=>array('Tag.tagname'),
		)));
		$selectedTag = array();
		foreach($post['Tag'] as $tag){
			$selectedTag []= $tag['id'];
		}
		$this->set('selectedTag',$selectedTag);

		$imgSrcPrefix = '..'.DS.'..'.DS.'files'.DS.'attachment'.DS.'photo'.DS;
		$this->set('imgSrcPrefix',$imgSrcPrefix);
	}

	public function delete($id){
		$this->isAuthorizedCheck($this->Auth->user());
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
