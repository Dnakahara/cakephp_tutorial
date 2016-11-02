<?php echo $this->element('header'); ?>
<div class="usersForm">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php 
			echo __('Please input New User Infomation');
		?></legend>
			<?php
			echo $this->Form->input('username',array(
				'label'=>__('UserName'),
			));
			echo $this->Form->input('password',array(
				'label'=>__('Password'),
				'value'=>'',
			));
			echo $this->Form->input('confirm',array(
				'type'=>'password',
				'label'=>__('Password Again'),
				'required'=>true,
				'value'=>'',
				'div'=>array(
					'class'=>'input password required',
				),
			));
			echo $this->Form->input('group_id',array(
				'label'=>__('select groups'),
				'options'=>$groups,
			));
			?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
