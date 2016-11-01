<?php
App::uses('AppModel','Model');

class Category extends AppModel{
	public $hasMany = array(
		'Post'=>array(
			'className'=>'Post',
			'foreignKey'=>'category_id',
		),
	);
}
