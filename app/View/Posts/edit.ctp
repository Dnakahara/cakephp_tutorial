<?php echo $this->element('header'); ?>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->textarea('body');
echo $this->Form->input('Category.id',array(
	'label'=>'Category',
	'options'=>$category,
	'empty'=>'未選択',
));
echo $this->Form->input('Tag.id',array(
	'label'=>'Tag',
	'type'=>'select',
	'options'=>$tag,
	'multiple'=>'checkbox',
));
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->end('Save Post');
?>
