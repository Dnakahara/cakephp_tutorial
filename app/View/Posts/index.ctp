<?php echo $this->element('header'); ?>
<h1>Blog posts</h1>
<?php echo $this->Flash->render('authorityError'); ?>
<?php 
echo $this->Html->link('Add Post',array(
	'controller'=>'posts',
	'action'=>'add'
));
?><p>最新順</p><?php
echo $this->Form->create('Post');
?>
<fieldset>
<legend>カテゴリー</legend>
<?php 
echo $this->Form->input('category',array(
	'options'=>$category,
	'empty'=>'未選択',
));
?>
</fieldset><?php
echo $this->Form->end('検索');
?><table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Author</th>
		<th>Created</th>
		<th>Change</th>
	</tr>

	<!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

	<?php foreach($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
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
		<td><?php echo $post['Post']['created']; ?></td>
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
