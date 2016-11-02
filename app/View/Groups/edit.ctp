<?php echo $this->elemet('header'); ?>
<h1><?php __('Edit Group Name'); ?></h1>
<?php
echo $this->Form->create('Group');
echo $this->Form->input('groupname',array(
	'label'=>__('Group Name'),
));
echo $this->Form->end(__('Save'));
