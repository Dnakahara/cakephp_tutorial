<div class="jumbotron">
<h1><strong style="color: #2D99FF;">E</strong>dit User</h1>
</div>
<div id="userEditWrap">
<?php
echo $this->Form->create('User');
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('username',array(
	'label'=>__('UserName'),
	'class'=>'form-control input-lg',
	'div'=>array(
		'class'=>'form-group',
	),
));
echo $this->Form->input('password',array(
	'type'=>'password',
	'label'=>__('NewPassword'),
	'class'=>'form-control input-lg',
	'required'=>true,
	'div'=>array(
		'class'=>'password form-group',
	),
	'value'=>'',
));
echo $this->Form->input('confirm',array(
	'type'=>'password',
	'label'=>__('NewPassword Again'),
	'class'=>'form-control input-lg',
	'required'=>true,
	'div'=>array(
		'class'=>'input password form-group',
	),
	'value'=>'',
));
echo $this->Form->button(
	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save This'),array(
	'type'=>'submit',
	'class'=>'btn addSaveBtn btn-block',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
));
echo $this->Form->end();
?>
</div><!-- userEditWrap -->
