<?php
class PostTag extends AppModel{
	public $belongTo = array(
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
