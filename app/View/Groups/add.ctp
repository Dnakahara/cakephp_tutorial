<?php echo $this->element('header'); ?>
<div class="groupsForm">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php
			echo __('Please input New Group Name');
		?></legend>
		<?php
		echo $this->Form->input('groupname',array(
			'label'=>__('GroupName'),
		));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
