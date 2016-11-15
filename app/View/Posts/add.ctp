<?php echo $this->element('header'); ?>
<?php echo $this->Html->css('blog.css?'.date("YmdHis")); ?>
<h1><?php echo __('Add Post'); ?></h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('title',array(
	'label'=>__('Title'),
	'class'=>'form-control',
	'div'=>array(
		'class'=>'form-group',
	),
	'required'=>true,
));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
	'div'=>array(
		'class'=>'form-group dropup',
	),
	'required'=>true,
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
?>
<div id="AttachmentsWrap">
	<div id="fileForms">
<?php
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo __('Please select images you want to upload.');
echo $this->Form->input('Attachment.0.photo',array(
	'class'=>'file-input fileForm',
	'label'=>false,
	'type'=>'file',
	'div'=>false,
	'style'=>'display:none;',
	'onchange'=>'fileChange(this)',
));
?>
	</div>
	<div id="fileThumbnails">
		<div class="fileThumbnail" onclick="clickPropagate(this)" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">
			<a class="btn btn-inline"style="background-color: #00eeff">
				<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
			</a>
			<span class="input-xlg uneditable-input">select file</span>
		</div>
	</div>
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
	'onclick'=>'beforeSubmit()',
));
echo $this->Form->end();
?>


<script>
	function beforeSubmit(){
		let $fileForms = $('#fileForms>.fileForm');
		for(var i = 0; i < $fileForms.length; ++i){
			$fileForms.eq(i).attr('name','data[Attachment]['+i+'][photo]');
		}
	}
 
	function clickPropagate(fileThumbnail){
		let idx = $('#fileThumbnails>.fileThumbnail').index($(fileThumbnail));
		$('#fileForms>.fileForm').eq(idx).click();
	}

	function fileChange(fileForm){
		let $fileForms = $('#fileForms>.fileForm');
		let $fileThumbnails = $('#fileThumbnails>.fileThumbnail');
		let fileFormIdx = $fileForms.index($(fileForm));
		if($(fileForm).val()==''){
			$(fileForm).remove();
			$fileThumbnails.eq(fileFormIdx).remove();
			return;
		}
		
		$fileThumbnails.eq(fileFormIdx).children('span').html($(fileForm).val().replace("C:\\fakepath\\",""));

		let removeButton = '<a class="btn btn-inline pull-right"style="background-color: rgba(0,0,0,0.7);" onclick="uploadCancel(this.parentNode)">'
				 + '	<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #f55;background-color: rgba(0,0,0,0);"></span>'
				 + '</a>';
		$fileThumbnails.eq(fileFormIdx).append(removeButton);
		
		if(fileFormIdx + 1 < $fileForms.length){return;}

		let nextFileForm = '<input type="file" class="file-input fileForm" onchange="fileChange(this)" style="display: none;"/>';
		let nextFileThumbnail = '<div class="fileThumbnail" onclick="clickPropagate(this)" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">'
				      + '<a class="btn btn-inline"style="background-color: #00eeff">'
				      + '<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>'
				      + '</a>'
				      + '<span class="input-xlg uneditable-input">select file</span>'
				      + '</div>';
		$('#fileForms').append(nextFileForm);
		$('#fileThumbnails').append(nextFileThumbnail);
	}
	
	function uploadCancel(fileThumbnail){
		event.stopPropagation();
		let fileThumbnailIdx = $('#fileThumbnails>.fileThumbnail').index($(fileThumbnail));
		$(fileThumbnail).remove();
		$('#fileForms>.fileForm').eq(fileThumbnailIdx).remove();
		return;
	}
	$(function(){
		$('#file-input').change(function() {
			$('#cover').html($(this).val().replace("C:\\fakepath\\",''));
		});
	});
</script>
