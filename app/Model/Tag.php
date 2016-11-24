<?php
App::uses('AppModel','Model');

class Tag extends AppModel{	
	public $hasAndBelongsToMany = array(
		'Post'=>array(
			'className'=>'Post',
			'joinTable'=>'posts_tags',
			'foreignKey'=>'tag_id',
			'associationForeignKey'=>'post_id',
			'unique'=>true,
			'with'=>'PostsTag',
		),
	);

	public $validate = array(
		'tagname'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Tag Name is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,8),
				'message'=>'The number of charachter of Tag Name is limited between 1 and 8',
			),
		),
	);
}
