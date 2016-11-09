<?php
App::uses('AppModel','Model');

class Zipcode extends AppModel{
	public $validate = array(
		'zipcode'=>array(
			'numeric'=>array(
				'rule'=>'numeric',
				'message'=>'The input is not zipcode',
			),
			'lengthBetween'=>array(
				'rule'=>array('lengthBetween',7,7),
				'message'=>'The input is not zipcode',
			),
		),
	);
}
