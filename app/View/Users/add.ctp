<?php echo $this->element('header'); ?>
<div class="usersForm">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php 
			echo __('登録するユーザーの情報を入力してください');
		?></legend>
		<small><span>*</span>がついている項目は必須です</small>
			<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('group_id',array(
				'options'=>$groups,
			));
			?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
