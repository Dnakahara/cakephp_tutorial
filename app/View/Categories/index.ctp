<?php echo $this->element('header'); ?>
<div class="jumbotron index">
<h1><?php echo __('Category List'); ?></h1>
</div>
<table class="table-bordered table-condensed" style="line-height: 2.5em;">
	<thead>
		<tr class="row">
			<th><?php echo __('CategoryName'); ?></th>
			<th><?php echo __('Change'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categories as $category): ?>
		<tr class="row clickable-row">
			<td class="col-md-10"><?php echo $category['Category']['categoryname']; ?></td>
			<td class="col-md-2 row"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'categories',
						'action'=>'edit',
						$category['Category']['id'],
					),
					array(
						'class'=>'col-md-5 btn editBtn',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'categories',
						'action'=>'delete',
						$category['Category']['id']
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
	<?php unset($categories); ?>
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
