<?php echo $this->element('header'); ?>
<h1>Group List</h1>
<table>
	<tr>
		<th>GroupName</th>
		<th>Created</th>
	</tr>
	<?php foreach($groups as $group): ?>
	<tr>
		<td><?php echo $group['groupname']; ?></td>
		<td><?php echo $group['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($groups); ?>
</table>
