<?php echo $this->element('header'); ?>
<h1><?php echo __('Add Post'); ?></h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('title',array(
	'label'=>__('Title'),
	'class'=>'form-control',
	'div'=>array(
		'class'=>'form-group',
	),
));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
	'div'=>array(
		'class'=>'form-group dropup',
	),
));
//HABTM でPostとTagを結びつけるために、Formの入力先はTag.Tag
echo $this->Form->input('Tag.Tag',array(
	'label'=>__('Tag'),
	'options'=>$tag,
	'multiple'=>'checkbox',
	'class'=>'checkbox-inline',
));
echo $this->Form->textarea('body',array(
	'label'=>__('Body'),
	'class'=>'form-control',
	'rows'=>5,
	'div'=>array(
		'class'=>'form-group',
	),
	'style'=>'margin-bottom: 20px;',
));
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo $this->Form->input('Attachment.0.photo',array(
	'id'=>'file-input',
	'label'=>__('Please select image you want to upload'),
	'type'=>'file',
	'div'=>array(
		'class'=>'form-group',
	),
	'style'=>'display:none;',
));
?>
<div class="input-prepend" onclick="$('#file-input').click()" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">
	<a class="btn btn-inline"style="background-color: #00eeff">
		<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
	</a>
	<span id="cover" class="input-xlg uneditable-input" onclick="$('#file-input').click()">select file</span>
</div>
<?php
echo $this->Form->button(
	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save Post'),array(
	'type'=>'submit',
	'class'=>'btn btn-primary btn-block',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
));
echo $this->Form->end();
?>


<script>
	$(function(){
		$('#file-input').change(function() {
			$('#cover').html($(this).val().replace("C:\\fakepath\\",''));
		});
	});
</script>
