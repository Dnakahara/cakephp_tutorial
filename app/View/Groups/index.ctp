<?php echo $this->element('header'); ?>
<h1><?php echo __('Group List'); ?></h1>
<table class="table">
	<tr>
		<th><?php echo __('GroupName'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Change'); ?></th>
	</tr>
	<?php foreach($groups as $group): ?>
	<tr>
		<td><?php echo $group['Group']['groupname']; ?></td>
		<td><?php echo $group['Group']['created']; ?></td>
		<td><div><?php
			echo $this->Html->link(
				__('Edit'),array(
					'controller'=>'groups',
					'action'=>'edit',
					$group['Group']['id'],
				)
			);
			echo $this->Form->postLink(
				__('Delete'),array(
					'controller'=>'groups',
					'action'=>'delete',
					$group['Group']['id']
				),
				array('confirm'=>__('Are you sure?'))
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($groups); ?>
</table>
