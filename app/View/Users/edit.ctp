<?php echo $this->element('header'); ?>
<h1><?php __('Edit User Infomation'); ?></h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('username',array(
	'label'=>__('UserName'),
));
echo $this->Form->input('password',array(
	'label'=>__('NewPassword'),
	'value'=>'',
));
echo $this->Form->input('confirm',array(
	'type'=>'password',
	'label'=>__('NewPassword Again'),
	'required'=>true,
	'div'=>array(
		'class'=>'input password required',
	),
	'value'=>'',
));
echo $this->Form->end(__('Save'));
