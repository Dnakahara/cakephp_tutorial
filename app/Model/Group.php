<?php
App::uses('AppModel','Model');

class Group extends AppModel{
	public $actsAs = array(
		'Acl'=>array(
			'type'=>'requester',
		),
	);

	public $hasMany = array(
		'User'=>array(
			'className'=>'User',
			'foreignKey'=>'group_id',
		),	
	);

	public $validate = array(
		'groupname'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Group Name is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,10),
				'message'=>'The number of charachter of Group Name is limited between 1 and 10',
			),
		),
	);

	public function parentNode(){
		return null;
	}
}
