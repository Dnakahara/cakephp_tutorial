<?php echo $this->Html->css('blog.css?'.date('YmdHis')); ?>
<div class="jumbotron">
<h1><strong style="color: #2D99FF;">E</strong>dit Category</h1>
</div>
<div id="categoryEditWrap">
<?php
echo $this->Form->create('Category');
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('categoryname',array(
	'label'=>__('Category Name'),
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
