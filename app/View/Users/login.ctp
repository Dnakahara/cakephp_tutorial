<?php echo $this->element('header'); ?>
<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>
			<?php echo __('Please enter your username and password'); ?>
		</legend>
		<?php
		echo $this->Form->input('username',array(
			'label'=>__('UserName'),
			'class'=>'form-control',
			'div'=>array(
				'class'=>'form-group',
			),
		));
		echo $this->Form->input('password',array(
			'label'=>__('Password'),
			'class'=>'form-control',
			'div'=>array(
				'class'=>'form-group',
			),
		));
		echo $this->Form->button(
			__('Log In!'),array(
			'type'=>'submit',
			'class'=>'btn btn-info btn-block',
			'div'=>array(
				'class'=>'form-group',
			),
			'escape'=>false,
		));
		?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
