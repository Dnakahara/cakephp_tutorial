<?php echo $this->element('header'); ?>
<div class="jumbotron">
<h1><span style="color: #6DB553;">U</span>ser List</h1>
</div>
<?php echo $this->Flash->render('authorityError'); ?>
<table class="table-bordered table-condensed" style="line-height: 2.5em;">
	<thead>
		<tr class="row" style="text-align:center;">
			<th class="col-md-3"><?php echo __('UserName') ?></th>
			<th class="col-md-3"><?php echo __('Group'); ?></th>
			<th class="col-md-3"><?php echo __('Created'); ?></th>
			<th class="col-md-3"><?php echo __('Change'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user): ?>
		<tr class="row clickable-row" style="text-align:center;">
			<td class="col-md-4"><?php echo $user['User']['username']?></td>
			<td class="col-md-3"><?php echo $user['Group']['groupname']; ?></td>
			<td class="col-md-3"><?php echo $user['User']['created']; ?></td>
			<td class="row col-md-2"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'users',
						'action'=>'edit',
						$user['User']['id'],
					),
					array(
						'class'=>'col-md-5 btn editBtn',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'users',
						'action'=>'delete',
						$user['User']['id']
					),
					array(
						'confirm'=>__('Are you sure?'),
						'class'=>'col-md-5 btn deleteBtn',
					)

				);
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<?php unset($users); ?>
</table>
<div class="pagination">
	<?php
	// 次ページと前ページのリンクを表示する
	echo $this->Paginator->prev(
		'< Previous',
		null,
		null,
		array(
			'class' => 'disabled prev',
		)
	);
	// ページ番号を表示する
	echo $this->Paginator->numbers(array(
		'modulus'=>8,
		'first'=>1,
		'last'=>1,
	));

	echo $this->Paginator->next(
		'Next >',
		null,
		null,
		array(
			'class' => 'disabled next',
		)
	);
	?>
	<div id="pageCounter">
	<?php
	// 現在のページ番号 / 全ページ数 を表示する
	echo $this->Paginator->counter();
	?>
	</div>
</div>
