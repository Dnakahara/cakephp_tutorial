<?php
App::uses('AppModel','Model');

class Post extends AppModel {
	public $actsAs = array(
		'Search.Searchable',
	);

	public $filterArgs = array(
		'category_id'=>array(
			'type'=>'value',
			'field'=>'Post.category_id',
			'allowEmpty'=>true,
		),
		'title'=>array(
			'type'=>'like',
			'field'=>'Post.title',
			'allowEmpty'=>true,
		),
		'tag_id'=>array(
			'type'=>'subquery',
			'field'=>'Post.id',
			'method'=>'tagSearch',
		),
	);
	
	public function tagSearch($data = array()){
		$this->PostsTag->Behaviors->attach('Containable',array(
			'autoFields'=>false
		));

		$this->PostsTag->Behaviors->attach('Search.Searchable');
		
		$query = $this->PostsTag->getQuery('all',array(
			'conditions'=>array(
				'PostsTag.tag_id'=>$data['tag_id'],
			),
			'fields'=>array(
				'post_id',
			),
			'contain'=>array(
				'Tag',
			),
		));
		return $query;
	}

	public $validate = array(
		'title'=>array(
			'rule'=>'notBlank'
		),
		'body'=>array(
			'rule'=>'notBlank'
		)
	);

	public $hasMany = array(
		'Attachment'=>array(
			'className'=>'Attachment',
			'foreignKey'=>'post_id',
		)
	);

	public $belongsTo = array(
		'Category'=>array(
			'className'=>'Category',
			'foreignKey'=>'category_id'
		),
		'User'=>array(
			'className'=>'User',
			'foreignKey'=>'user_id',
		),
	);
	
	public $hasAndBelongsToMany = array(
		'Tag'=>array(
			'className'=>'Tag',
			'joinTable'=>'posts_tags',
			'foreignKey'=>'post_id',
			'associationForeignKey'=>'tag_id',
			'unique'=>true,
			'with'=>'PostsTag',
		),
	);

	public function isOwnedBy($post,$user){
		//postテーブルの中に idが$post, postのuser_idが$userの列が存在するならtrue 
		$conditions = array(
			'id'=>$post,
			'user_id'=>$user
		);
		return $this->field('id',$conditions) !== false;
	}

	public function latestAllPosts(){
		return $this->find('all',array(
			'order'=>array(
				'Post.created'=>'desc'
			)
		));
	}
}
