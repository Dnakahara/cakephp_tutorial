<?php echo $this->element('header'); ?>
<h1>User List</h1>
<?php echo $this->Flash->render('authorityError'); ?>
<table class="table">
	<tr>
		<th><?php echo __('UserName') ?></th>
		<th><?php echo __('Group'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Change'); ?></th>
	</tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['username']?></td>
		<td><?php echo $user['Group']['groupname']; ?></td>
		<td><?php echo $user['User']['created']; ?></td>
		<td><div><?php
			echo $this->Html->link(
				__('Edit'),array(
					'controller'=>'users',
					'action'=>'edit',
					$user['User']['id'],
				)
			);
			echo $this->Form->postLink(
				__('Delete'),array(
					'controller'=>'users',
					'action'=>'delete',
					$user['User']['id']
				),
				array('confirm'=>__('Are you sure?'))
			);
			?></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($users); ?>
</table>
