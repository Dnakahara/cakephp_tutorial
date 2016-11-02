<?php echo $this->element('header'); ?>
<h1><?php echo __('Add Post'); ?></h1>
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('title',array('label'=>__('Title')));
echo $this->Form->textarea('body',array('label'=>__('Body')));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
));
//HABTM でPostとTagを結びつけるために、Formの入力先はTag.Tag
echo $this->Form->input('Tag.Tag',array(
	'label'=>__('Tag'),
	'options'=>$tag,
	'multiple'=>'checkbox',
));
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo $this->Form->input('Attachment.0.photo',array(
	'label'=>__('Image'),
	'type'=>'file',
));
echo $this->Form->end(__('Save Post'));
?>
