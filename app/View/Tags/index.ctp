<?php echo $this->element('header'); ?>
<div class="jumbotron index">
<h1><?php echo __('Tag List'); ?></h1>
</div>
<table class="table-bordered table-striped table-condensed" style="line-height: 2.5em;">
	<thead>
		<tr class="row">
			<th class="col-md-10"><?php echo __('TagName'); ?></th>
			<th class="col-md-2"><?php echo __('Change'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($tags as $tag): ?>
		<tr class="row clickable-row">
			<td class="col-md-10"><?php echo $tag['Tag']['tagname']; ?></td>
			<td class="col-md-2 row btn-group"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'tags',
						'action'=>'edit',
						$tag['Tag']['id'],
					),
					array(
						'class'=>'col-md-6 btn btn-primary',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'tags',
						'action'=>'delete',
						$tag['Tag']['id']
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
	<?php unset($tags); ?>
</table>
