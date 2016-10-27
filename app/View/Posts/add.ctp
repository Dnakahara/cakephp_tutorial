<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->textarea('body');
echo $this->Form->select('Category.categoryname',$category['categoryname']);
echo $this->Form->checkbox('Tag.tagname',$tag['tagname']);
echo $this->Form->input('Image.0.name',array('type'=>'file','multiple'=>'multiple'));
echo $this->Form->input('Image.0.model',array('type'=>'file','multiple'=>'multiple'));
echo $this->Form->input('Image.0.photo_person',array('type'=>'file','multiple'=>'multiple'));
echo $this->Form->end('Save Post');
?>
