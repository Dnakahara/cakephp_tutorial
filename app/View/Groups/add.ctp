<?php echo $this->element('header'); ?>
<div class="groupsForm">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php
			echo __('登録するグループの名前を入力してください');
		?></legend>
		<?php
		echo $this->Form->input('groupname');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
