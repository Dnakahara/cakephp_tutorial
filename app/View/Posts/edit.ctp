<?php echo $this->element('header'); ?>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('title',array('label'=>__('title')));
echo $this->Form->textarea('body',array('label'=>__('body')));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
	'value'=>$selectedCategory,
));
echo $this->Form->input('Tag.Tag',array(
	'label'=>__('Tag'),
	'options'=>$tag,
	'multiple'=>'checkbox',
	'selected'=>$selectedTag,
));
$preUploadedCnt = count($post['Attachment']);
for($i = 0; $i < $preUploadedCnt; $i++){
	echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.$post['Attachment'][$i]['photo']);
}
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo $this->Form->input('Attachment.0.photo',array(
	'label'=>__('Image'),
	'type'=>'file',
));
echo $this->Form->end(__('Save Post'));
