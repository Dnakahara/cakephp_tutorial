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
echo $this->Form->textarea('body',array(
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
	<input type="checkbox" name="data[Original][removedImages][]" checked="" value="<?php echo $idx ?>" id="PostremovedImages<?php echo $idx ?>" />
</div>
<?php endforeach; ?>
<?php

//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo $this->Form->input('Attachment.0.photo',array(
	'label'=>__('Image'),
	'type'=>'file',
	'div'=>array(
		'class'=>'form-group',
	),
));
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
			if($thumbnails.eq(i).attr('removed')){
				$('#removedImages'+i).attr('checked','checked');
			}
		}
	}
	$(function(){
		$('.imageCover').on('click','.thumbnail', function(){
			if($(this).attr('removed')!="true"){
				$(this).attr('removed','true');
				$(this).parent().html(this.outerHTML + '<span class="coverImage glyphicon glyphicon-remove" aria-hidden="true"></span>');
			}
			else{
				$(this).attr('removed','false');
				$(this).parent().html(this.outerHTML);
			}
		});
		$('.imageCover').on('click','span', function(){
			console.log($(this).siblings());
			$(this).siblings().attr('removed','false');
			$(this).parent().html($(this).siblings()[0]);
		});
	});
</script>
