<div class="categoryAddForm">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php
			echo __('Please input New Category Name');
		?></legend>
		<?php
		echo $this->Form->input('categoryname',array(
			'label'=>__('CategoryName'),
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
