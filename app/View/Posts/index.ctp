<!-- File: /app/View/Posts/index.ctp -->
<h1>Blog posts</h1>
<?php if(false): ?>
<p>他のユーザーの記事は編集・削除できません</p>
<?php endif; ?>
<?php 
echo $this->Html->link('Add Post',array(
	'controller'=>'posts',
	'action'=>'add'
));
?><p>最新順</p>
<?php if(is_null($username)): ?>
<p><?php echo 'LoginUser:GUEST'; ?></p>
<?php
echo $this->Html->link('Sign Up!',array(
	'controller'=>'users',
	'action'=>'add'
));
echo $this->Html->link('Login!',array(
	'controller'=>'users',
	'action'=>'login'
))
?><?php else: ?>
<p>LoginUser:<?php echo h($username); ?></p>
<?php
echo $this->Html->link('Log out',array(
	'controller'=>'users',
	'action'=>'logout'
));
?><?php endif; ?>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Author</th>
		<th>Created</th>
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
					$post['Post']['id']
			)); 
		    ?>
		</td>
		<td><?php
			//Author name
		?></td>
		<td><?php echo $post['Post']['created']; ?></td>
		<td><?php
			echo $this->Html->link(
				'Edit',array(
					'controller'=>'posts',
					'action'=>'edit',
					$post['Post']['id']
			));
		?></td>
		<td><?php
			echo $this->Form->postLink(
				'Delete',array(
					'controller'=>'posts',
					'action'=>'delete',
					$post['Post']['id']
				),
				array('confirm'=>'Are you sure?')
			);
		?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($posts); ?>
</table>
