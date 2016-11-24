<div class="usersAddForm">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php 
			echo __('Please input New User Infomation');
		?></legend>
			<?php
			echo $this->Form->input('username',array(
				'label'=>__('UserName'),
				'class'=>'form-control input-lg',
				'required'=>true,
				'div'=>array(
					'class'=>'form-group required',
				),
			));
			echo $this->Form->input('password',array(
				'type'=>'password',
				'label'=>__('Password'),
				'class'=>'form-control input-lg',
				'required'=>true,
				'div'=>array(
					'class'=>'password required form-group',
				),
				'value'=>'',
			));
			echo $this->Form->input('confirm',array(
				'type'=>'password',
				'label'=>__('Password Again'),
				'class'=>'form-control input-lg',
				'required'=>true,
				'div'=>array(
					'class'=>'input password',
				),
				'value'=>'',
				'style'=>'margin-bottom: 20px;',
			));
			echo $this->Form->input('group_id',array(
				'label'=>__('select groups'),
				'options'=>$groups,
				'div'=>array(
					'class'=>'form-group dropup',
				),
			));
			echo $this->Form->button(
				'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save This'),array(
				'type'=>'submit',
				'class'=>'btn btn-primary btn-block',
				'div'=>array(
					'class'=>'form-group',
				),
				'escape'=>false,
			));
			echo $this->Form->end();?>
	</fieldset>
</div>
