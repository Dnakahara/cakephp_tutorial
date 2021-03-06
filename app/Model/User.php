<?php
App::uses('AppModel','Model');
App::uses('AuthComponent','Controller/Component');
App::uses('BlowfishPasswordHasher','Controller/Component/Auth');

class User extends AppModel{
	public $actsAs = array(
		'Acl'=>array(
			'type'=>'requester',
		),
	);
	
	public $hasMany = array(
		'Post'=>array(
			'className'=>'Post',
			'foreignKey'=>'user_id',
		),
	);

	public $belongsTo = array(
		'Group',
	);

	public $validate = array(
		'username'=>array(
			'alphaNumeric'=>array(
				'rule'=>'alphaNumeric',
				'message'=>'Each character of username is alphabet or Number',
			),
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Username is required',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',1,10),
				'message'=>'The number of charachter of User Name is limited between 1 and 10',
			),
		),
		'password'=>array(
			'alphaNumeric'=>array(
				'rule'=>'alphaNumeric',
				'message'=>'Each character of password is alphabet or Number',
			),
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Password is not blank',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',6,20),
				'message'=>'The number of charachter of password is limited between 6 and 20',
			),
			'passwordConfirm'=>array(
				'rule'=>'passwordConfirm',
				'message'=>'Please input same password again',
			),
		),
		'confirm'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Please input password again',
			),
		),
	);

	public function passwordConfirm($check){
		return $this->data['User']['password'] === $this->data['User']['confirm'];
	}

	public function beforeSave($options = array()){
		if(isset($this->data[$this->alias]['password'])){
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

	public function parentNode(){
		if(!$this->id && empty($this->data)){
			return null;
		}
		if(isset($this->data['User']['group_id'])){
			$groupId = $this->data['User']['group_id'];
		}else{
			$groupId = $this->field('group_id');
		}
		if(!$groupId){
			return null;
		}else{
			return array('Group'=>array('id'=>$groupId));
		}
	}
}
