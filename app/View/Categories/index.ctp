<?php echo $this->element('header'); ?>
<div class="jumbotron">
<h1><?php echo __('Category List'); ?></h1>
</div>
<table class="table-bordered table-striped table-condensed" style="line-height: 2.5em;">
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
			<td class="col-md-2 row btn-group"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'categories',
						'action'=>'edit',
						$category['Category']['id'],
					),
					array(
						'class'=>'col-md-6 btn btn-primary',
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
						'class'=>'col-md-6 btn btn-warning',
					)
				);
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<?php unset($categories); ?>
</table>
