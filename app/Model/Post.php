<?php
class Post extends AppModel {
	public $actsAs = array(
		'Search.Searchable',
	);

	public $filterArgs = array(
		'category_id'=>array('type'=>'value'),
	);

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
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Tag'=>array(
			'className'=>'Tag',
			'joinTable'=>'posts_tags',
			'foreignKey'=>'post_id',
			'associationForeignKey'=>'tag_id',
			'unique'=>true,
			'with'=>'PostTag',
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
