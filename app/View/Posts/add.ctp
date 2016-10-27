<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->textarea('body');
echo $this->Form->input('image',array('type'=>'binary'));
echo $this->Form->end('Save Post');
?>
