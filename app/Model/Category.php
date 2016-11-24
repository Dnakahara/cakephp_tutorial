<?php
App::uses('AppModel','Model');

class Category extends AppModel{
	public $hasMany = array(
		'Post'=>array(
			'className'=>'Post',
			'foreignKey'=>'category_id',
		),
	);
	
	public $validate = array(
		'categoryname'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Category Name is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,10),
				'message'=>'The number of charachter of Category Name is limited between 1 and 10',
			),
		),
	);
}
