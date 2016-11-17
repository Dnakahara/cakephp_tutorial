<?php echo $this->element('header'); ?>
<div class="jumbotron index">
<h1><?php echo __('Group List'); ?></h1>
</div>
<table class="table-bordered table-condensed" style="line-height: 2.5em;">
	<thead>
		<tr class="row">
			<th class="col-md-4"><?php echo __('GroupName'); ?></th>
			<th class="col-md-4"><?php echo __('Created'); ?></th>
			<th class="col-md-4"><?php echo __('Change'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($groups as $group): ?>
		<tr class="row">
			<td class="col-md-5"><?php echo $group['Group']['groupname']; ?></td>
			<td class="col-md-5"><?php echo $group['Group']['created']; ?></td>
			<td class="row col-md-2"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'groups',
						'action'=>'edit',
						$group['Group']['id'],
					),
					array(
						'class'=>'col-md-5 btn editBtn',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'groups',
						'action'=>'delete',
						$group['Group']['id']
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
	<?php unset($groups); ?>
</table>
