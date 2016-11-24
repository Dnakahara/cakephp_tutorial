<?php echo $this->Html->css('blog.css?'.date('YmdHis')); ?>
<div class="jumbotron">
<h1><strong style="color: #2D99FF;">E</strong>dit Tag</h1>
</div>
<div id="tagEditWrap">
<?php
echo $this->Form->create('Tag');
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('tagname',array(
	'label'=>__('Tag Name'),
	'class'=>'form-control input-lg',
	'div'=>array(
		'class'=>'form-group',
	),
	'required'=>true,
	'style'=>'font-size: x-large;font-weight: bold;',
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
</div>
