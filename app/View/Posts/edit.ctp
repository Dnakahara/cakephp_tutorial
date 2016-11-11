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
<?php
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo __('Please select images you want to upload.');
echo $this->Form->input('Attachment.0.photo',array(
	'id'=>'file-input0',
	'class'=>'file-input',
	'label'=>false,
	'type'=>'file',
	'div'=>array(
		'class'=>'form-group',
	),
	'style'=>'display:none;',
));
?>
	<div id="input-wrap0" onclick="$('#file-input0').click()" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">
		<a class="btn btn-inline"style="background-color: #00eeff">
			<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
		</a>
		<span id="cover0" class="input-xlg uneditable-input">select file</span>
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
	'onclick'=>'selectedImageSetter()',
));
echo $this->Form->end();
?>

<script>
	function selectedImageSetter(){
		let $thumbnails = $('.thumbnail');
		for(var i = 0; i < $thumbnails.length; ++i){
			if($thumbnails.eq(i).hasClass('removed')){
				let img = '#PostremovedImages'+i;
				$(img).prop('checked',true);
			}
		}
	}
	$(function(){
		$('#AttachmentsWrap').on('change','.file-input',function(){
			let Number = $(this).attr('id').substring(10);
			let coverId = '#cover'+ Number;
			if($(this).val()==''){
				console.log($(this).val());
				$(coverId).html('select file');
			}
			$(coverId).html($(this).val().replace("C:\\fakepath\\",''));

			let inputWrapId = '#input-wrap' + Number;
			let nextNumber = parseInt(Number,10) + 1;

			let nextUploadForm = '<div class="form-group">'
					   + '	<input type="file" name="data[Attachment]['+ nextNumber +'][photo]" id="file-input'+ nextNumber + '" class="file-input" style="display:none;"/>'
					   + '</div>'
					   + '<div id="input-wrap' + nextNumber + '" onclick="$(' + "'" + '#file-input' + nextNumber + "'" + ').click()" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">'
					   + '	<a class="btn btn-inline" style="background-color: #00eeff">'
					   + '		<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>'
					   + '	</a>'
					   + '	<span id="cover' + nextNumber + '" class="input-xlg uneditable-input">select file</span>'
					   + '</div>';
			
			$('#AttachmentsWrap').append(nextUploadForm);
		});

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
