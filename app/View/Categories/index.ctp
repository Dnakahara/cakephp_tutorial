<?php echo $this->element('header'); ?>
<h1><?php echo __('Category List'); ?></h1>
<table>
	<tr>
		<th><?php echo __('CategoryName'); ?></th>
		<th><?php echo __('Change'); ?></th>
	</tr>
	<?php foreach($categories as $category): ?>
	<tr>
		<td><?php echo $category['Category']['categoryname']; ?></td>
		<td><div><?php
			echo $this->Html->link(
				__('Edit'),array(
					'controller'=>'categories',
					'action'=>'edit',
					$category['Category']['id'],
				)
			);
			?></div>
			<div><?php
			echo $this->Form->postLink(
				__('Delete'),array(
					'controller'=>'categories',
					'action'=>'delete',
					$category['Category']['id']
				),
				array('confirm'=>__('Are you sure?'))
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($categories); ?>
</table>
