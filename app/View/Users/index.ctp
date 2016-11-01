<?php echo $this->element('header'); ?>
<h1>User List</h1>
<table>
	<tr>
		<th>UserName</th>
		<th>Group</th>
		<th>Created</th>
	</tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['username']?></td>
		<td><?php echo $user['Group']['groupname']; ?></td>
		<td><?php echo $user['User']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($users); ?>
</table>
