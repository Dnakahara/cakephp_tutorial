<div class="tagAddForm">
<?php echo $this->Form->create('Tag'); ?>
	<fieldset>
		<legend><?php
			echo __('Please input New Tag Name');
		?></legend>
		<?php
		echo $this->Form->input('tagname',array(
			'label'=>__('TagName'),
			'class'=>'form-control input-lg',
			'required'=>true,
			'div'=>array(
				'class'=>'form-group',
			),
		));
		echo $this->Form->button(
			'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save This'),array(
			'type'=>'submit',
			'class'=>'btn addSaveBtn btn-block',
			'div'=>array(
				'class'=>'form-group',
			),
			'escape'=>false,
		));
		echo $this->Form->end();
		?>
	</fieldset>
</div>
