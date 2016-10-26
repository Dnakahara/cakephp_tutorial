<?php

class Post extends AppModel {
	public $validate = array(
		'title'=>array(
			'rule'=>'notBlank'
		),
		'body'=>array(
			'rule'=>'notBlank'
		)
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
			)));
	}
}
