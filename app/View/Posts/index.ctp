<?php echo $this->element('header'); ?>
<h1>Blog posts</h1>
<?php echo $this->Flash->render('authorityError'); ?>
<?php 
echo $this->Html->link('Add Post',array(
	'controller'=>'posts',
	'action'=>'add'
));
?><p>最新順</p><?php
echo $this->Form->create('Post',array(
	'novalidate'=>true,
));
?>
<fieldset>
<legend>検索</legend>
<?php 
echo $this->Form->input('title');
echo $this->Form->input('category_id',array(
	'label'=>'Category',
	'options'=>$category,
	'empty'=>'未選択',
));
echo $this->Form->input('Tag.Tag',array(
	'label'=>'Tag',
	'options'=>$tag,
	'multiple'=>'checkbox',
));
?>
</fieldset>
<?php echo $this->Form->end('検索'); ?>
<table>
	<tr>
		<th>Created</th>
		<th>Title</th>
		<th>Author</th>
		<th>Change</th>
	</tr>

	<!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

	<?php foreach($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['created']; ?></td>
		<td><?php
			echo $this->Html->link(
				$post['Post']['title'],array(
					'controller'=>'posts',
					'action'=>'view',
					$post['Post']['id'],
				)
			); 
		    ?>
		</td>
		<td><?Php echo $post['User']['username']; ?></td>
		<td><div><?php
			echo $this->Html->link(
				'Edit',array(
					'controller'=>'posts',
					'action'=>'edit',
					$post['Post']['id'],
				)
			);
			?></div>
			<div><?php
			echo $this->Form->postLink(
				'Delete',array(
					'controller'=>'posts',
					'action'=>'delete',
					$post['Post']['id']
				),
				array('confirm'=>'Are you sure?')
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($posts); ?>
</table>
