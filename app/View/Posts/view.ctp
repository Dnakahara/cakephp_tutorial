<?php echo $this->element('header'); ?>
<article>
<h1><?php echo h($post['Post']['title']); ?></h1>
<p><small><?php echo __('Created: '); echo $post['Post']['created']; ?></small></p>
<p><?php echo h($post['Post']['body']); ?></p>
<p><?php echo __('Category: '); echo h($post['Category']['categoryname']); ?></p>
<p><?php echo __('Tag: '); 
foreach($post['Tag'] as $tag):
echo h($tag['tagname']);
endforeach;
?></p>
<?php for($i = 0; $i < count($post['Attachment']); $i++){
	echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.DS.$post['Attachment'][$i]['photo']);
}
?></p>
</article>
