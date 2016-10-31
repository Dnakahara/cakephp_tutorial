<?php
class PostsTag extends AppModel{
	public $belongsTo = array(
		'Post' =>array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Tag' =>array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
	);
}
