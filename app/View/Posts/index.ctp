<?php echo $this->element('header'); ?>
<div class="jumbotron">
<h1>Blog posts</h1>
</div>
<?php echo $this->Flash->render('authorityError'); ?>
<?php 
echo $this->Html->link(
	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Add Post'),array(
		'controller'=>'posts',
		'action'=>'add',
	),
	array(
		'class'=>'btn btn-info btn-block',
		'escape'=>false,
		'style'=>'text-align: center;',
	)
);
?><p><?php __('Order : Newer'); ?></p>
<?php echo $this->Form->create('Post',array(
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
?><label>Tag</label><br/>
<?php
echo $this->Form->input('tag_id',array(
	'label'=>false,
	'options'=>$tag,
	'multiple'=>'checkbox',
	'class'=>'checkbox-inline',
));
echo $this->Form->button(
	'<span class="glyphicon glyphicon-search" aria-hidden="true"></span>'.__('Search'),array(
	'type'=>'submit',
	'class'=>'btn btn-primary',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
));
?>
</fieldset>
<?php echo $this->Form->end(); ?>
<table class="table-bordered table-striped table-condensed" style="line-height: 2.5em;margin-bottom: 20px;">
	<thead>
		<tr class="row">
			<th class="col-md-2"><?php echo __('Created'); ?></th>
			<th class="col-md-6"><?php echo __('Title'); ?></th>
			<th class="col-md-2"><?php echo __('Author'); ?></th>
			<th class="col-md-2"><?php echo __('Change'); ?></th>
		</tr>
	</thead>

	<!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

	<tbody>
		<?php foreach($posts as $post): ?>
		<tr class="row clickable-row">
			<td class="col-md-2"><?php echo $post['Post']['created']; ?></td>
			<td class="col-md-6"><?php
				echo $this->Html->link(
					$post['Post']['title'],array(
						'controller'=>'posts',
						'action'=>'view',
						$post['Post']['id'],
					),
					array(
						'style'=>'width:100%; height:100%; display:block;'
					)
				); 
			    ?>
			</td>
			<td class="col-md-2"><?php echo $post['User']['username']; ?></td>
			<td class="row col-md-2 btn-group"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'posts',
						'action'=>'edit',
						$post['Post']['id'],
					),
					array(
						'class'=>'col-md-6 btn btn-primary',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'posts',
						'action'=>'delete',
						$post['Post']['id']
					),
					array(
						'confirm'=>__('Are you sure?'),
						'class'=>'col-md-6 btn btn-warning',
					)
				);
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<?php unset($posts); ?>
</table>
<div class="pagination">
<?php
// 次ページと前ページのリンクを表示する
echo $this->Paginator->prev(
	'< Previous',
	null,
	null,
	array(
		'class' => 'disabled',
	)
);
// ページ番号を表示する
echo $this->Paginator->numbers();

echo $this->Paginator->next(
	'Next >',
	null,
	null,
	array(
		'class' => 'disabled',
	)
);

// 現在のページ番号 / 全ページ数 を表示する
echo $this->Paginator->counter();
?>
</div>
