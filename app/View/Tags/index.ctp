<?php echo $this->element('header'); ?>
<h1><?php echo __('Tag List'); ?></h1>
<table>
	<tr>
		<th><?php echo __('TagName'); ?></th>
		<th><?php echo __('Change'); ?></th>
	</tr>
	<?php foreach($tags as $tag): ?>
	<tr>
		<td><?php echo $tag['Tag']['tagname']; ?></td>
		<td><div><?php
			echo $this->Html->link(
				__('Edit'),array(
					'controller'=>'tags',
					'action'=>'edit',
					$tag['Tag']['id'],
				)
			);
			?></div>
			<div><?php
			echo $this->Form->postLink(
				__('Delete'),array(
					'controller'=>'tags',
					'action'=>'delete',
					$tag['Tag']['id']
				),
				array('confirm'=>__('Are you sure?'))
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($tags); ?>
</table>
