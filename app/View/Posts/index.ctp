<?php echo $this->element('header'); ?>
<h1>Blog posts</h1>
<?php echo $this->Flash->render('authorityError'); ?>
<?php 
echo $this->Html->link(__('Add Post'),array(
	'controller'=>'posts',
	'action'=>'add'
));
?><p><?php __('Order : Newer'); ?></p><?php
echo $this->Form->create('Post',array(
	'novalidate'=>true,
));
?>
<fieldset>
<legend><?php echo __('Search'); ?></legend>
<?php 
echo $this->Form->input('title',array(
	'label'=>__('Title'),
	'required'=>false,
));
echo $this->Form->input('category_id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
));
echo $this->Form->input('tag_id',array(
	'label'=>__('Tag'),
	'options'=>$tag,
	'multiple'=>'checkbox',
));
?>
</fieldset>
<?php echo $this->Form->end(__('Search')); ?>
<table>
	<tr>
		<th><?php __('Created'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Author'); ?></th>
		<th><?php __('Change'); ?></th>
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
				__('Edit'),array(
					'controller'=>'posts',
					'action'=>'edit',
					$post['Post']['id'],
				)
			);
			?></div>
			<div><?php
			echo $this->Form->postLink(
				__('Delete'),array(
					'controller'=>'posts',
					'action'=>'delete',
					$post['Post']['id']
				),
				array('confirm'=>__('Are you sure?'))
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($posts); ?>
</table>
