<?php echo $this->element('header'); ?>
<article>
<h1><?php echo h($post['Post']['title']); ?></h1>
<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>
<p><?php echo h($post['Post']['body']); ?></p>
<p>カテゴリー: <?php echo h($post['Category']['categoryname']); ?></p>
<p>タグ: <?php foreach($post['Tag'] as $tag):
echo h($tag['tagname']);
endforeach;
?></p>
<?php for($i = 0; $i < count($post['Attachment']); $i++){
	echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.DS.$post['Attachment'][$i]['photo']);
}
?></p>
</article>
