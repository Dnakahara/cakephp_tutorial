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

	public function parentNode(){
		return null;
	}
}
