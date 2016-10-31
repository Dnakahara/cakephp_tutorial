<?php echo $this->element('header'); ?>
<h1>User List</h1>
<table>
	<tr>
		<th>UserName</th>
		<th>Role</th>
		<th>Created</th>
	</tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo $user['username']?></td>
		<td><?php echo $user['role']; ?></td>
		<td><?php echo $user['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($users); ?>
</table>
