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
