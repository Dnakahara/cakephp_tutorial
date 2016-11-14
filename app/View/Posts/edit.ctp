<?php echo $this->element('header'); ?>
<?php echo $this->Html->css('imageSelect.css'); ?>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
	'value'=>$selectedCategory,
	'div'=>array(
		'class'=>'form-group dropup',
	),
));
echo $this->Form->input('Tag.Tag',array(
	'label'=>__('Tag<br>'),
	'options'=>$tag,
	'multiple'=>'checkbox',
	'selected'=>$selectedTag,
	'class'=>'checkbox-inline',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
));
echo $this->Form->input('title',array(
	'label'=>__('title'),
	'class'=>'form-control',
	'div'=>array(
		'class'=>'form-group',
	),
));
echo $this->Form->input('body',array(
	'type'=>'textarea',
	'label'=>__('body'),
	'rows'=>30,
	'class'=>'form-control',
	'style'=>'margin-bottom:30px;',
	'div'=>array(
		'class'=>'form-group',
	),
));

echo '<p style="color: #a55;">'.__('Please select images you want to delete').'</p>';

$images = array();

for($i = 0; $i < count($post['Attachment']); $i++){
	$images[$i] = $i;
	if($i % 6 == 0){echo '<div class="row">';}
	echo '<div class="col-md-2 imageCover">';
	echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.$post['Attachment'][$i]['photo'],array(
		'class'=>'img-responsive thumbnail baseImage',
		'id'=>'thumbnail'.$i,
		'width'=>'256',
	));
	echo '</div>';
	if($i % 6 == 5 || $i+1 >= count($post['Attachment'])){echo '</div>';}
}
?>
<input type="hidden" name="data[Original][removedImages]" value="" id="PostremovedImages"/>
<?php foreach($post['Attachment'] as $idx=>$data):  ?>
<?php //for($i = 0; $i < count($post['Attachment']); $i++): ?>
<div class="none PostremovedImages">
	<input type="checkbox" name="data[Original][removedImages][]" value="<?php echo $idx ?>" id="PostremovedImages<?php echo $idx ?>" />
</div>
<?php endforeach; ?>
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

<!-- 

<form action="#" method="post" enctype="multipart/form-data">
	<div id="fileForms" class="form-group" style="display: none;">
	         <input type="file" class="file-input fileForm" onchange="fileChange(this)" />
	</div>
</form>

<script>
	$(function(){
		submit buttonをおしたとき、#fileForms>.fileForm のname属性を順に名づけていく実装も忘れずに
	}
</script>

-->

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
		let $thumbnails = $('.thumbnail');
		for(var i = 0; i < $thumbnails.length; ++i){
			if($thumbnails.eq(i).hasClass('removed')){
				let img = '#PostremovedImages'+i;
				$(img).prop('checked',true);
			}
		}

		let $fileForms = $('#fileForms>.fileForm');
		for(var i = 0; i < $fileForms.length; ++i){
			$fileForms.eq(i).attr('name','data[Attachment]['+i+'][photo]');
		}
	}
 
	function clickPropagate(fileThumbnail){
		let idx = $('#fileThumbnails>.fileThumbnail').index($(fileThumbnail));
		console.log(idx);
		$('#fileForms>.fileForm').eq(idx).click();
	}

	function fileChange(fileForm){
		let $fileForms = $('#fileForms>.fileForm');
		let $fileThumbnails = $('#fileThumbnails>.fileThumbnail');
		let fileFormIdx = $fileForms.index($(fileForm));
		console.log(fileFormIdx);
		if($(fileForm).val()==''){
			$(fileForm).remove();
			$fileThumbnails.eq(fileFormIdx).remove();
			return;
		}
		$fileThumbnails.eq(fileFormIdx).children('span').html($(fileForm).val().replace("C:\\fakepath\\",""));
		if(fileFormIdx + 1 < $fileForms.length){return;}
		console.log('hello');

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

	$(function(){
		$('.imageCover').on('click','.thumbnail', function(){
			if($(this).hasClass('removed')){
				$(this).removeClass('removed');
				$(this).parent().html(this.outerHTML);
			}
			else{
				$(this).addClass('removed');
				$(this).parent().html(this.outerHTML + '<span class="coverImage glyphicon glyphicon-remove" aria-hidden="true"></span>');
			}
		});

		$('.imageCover').on('click','span', function(){
			$(this).siblings().removeClass('removed');
			$(this).parent().html($(this).siblings()[0]);
		});
	});
</script>
