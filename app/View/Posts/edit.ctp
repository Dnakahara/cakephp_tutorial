<?php echo $this->element('header'); ?>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('title');
echo $this->Form->textarea('body');
echo $this->Form->input('Category.id',array(
	'label'=>'Category',
	'options'=>$category,
	'empty'=>'未選択',
	'value'=>$selectedCategory,
));
echo $this->Form->input('Tag.Tag',array(
	'label'=>'Tag',
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
	'label'=>'Image',
	'type'=>'file',
));
echo $this->Form->end('Save Post');
?>
