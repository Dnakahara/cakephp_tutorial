<?php echo $this->element('header'); ?>
<h1><?php echo __('Edit User Infomation'); ?></h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('username',array(
	'label'=>__('UserName'),
	'class'=>'form-control',
	'div'=>array(
		'class'=>'form-group',
	),
));
echo $this->Form->input('password',array(
	'type'=>'password',
	'label'=>__('NewPassword'),
	'class'=>'form-control',
	'required'=>true,
	'div'=>array(
		'class'=>'password form-group',
	),
	'value'=>'',
));
echo $this->Form->input('confirm',array(
	'type'=>'password',
	'label'=>__('NewPassword Again'),
	'class'=>'form-control',
	'required'=>true,
	'div'=>array(
		'class'=>'input password form-group',
	),
	'value'=>'',
));
echo $this->Form->button(
	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save This'),array(
	'type'=>'submit',
	'class'=>'btn btn-primary btn-block',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
));
echo $this->Form->end();
