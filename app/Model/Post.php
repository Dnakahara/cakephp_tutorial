<?php
App::uses('AppModel','Model');

class Post extends AppModel {
	public $actsAs = array(
		'Search.Searchable',
	);

	public $filterArgs = array(
		'category_id'=>array(
			'type'=>'like',
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
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Title is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,26),
				'message'=>'The number of charachter of Title is limited between 1 and 13',
			),
		),
		'body'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Body is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,40000),
				'message'=>'The number of charachter of Body is limited between 1 and 6000',
			),
		),
		'category_id'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Category is required',
			),
		),
		'Tag' => array(
			'rule' => array('multiple', array(
				'min' => 0,
				'max' => 4,
			)),
			'message' => 'Tag Number  Error',
		),
	);

	public $hasMany = array(
		'Attachment'=>array(
			'className'=>'Attachment',
			'foreignKey'=>'post_id',
			'dependent'=>true,
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
