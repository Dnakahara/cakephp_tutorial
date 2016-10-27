<?php
class Attachment extends AppModel{
	public $actsAs = array(
		'Upload.Upload'=>array(
			'image'=>array(

			)
		)
	);

	public $belongsTo = array(
		'Post'=>array(
			'className'=>'Post',
			'foreignKey'=>'post_id'
		)
	);
}
