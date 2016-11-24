<?php echo $this->Html->css('blog.css?'.date("YmdHis")); ?>
<div class="jumbotron">
<h1><span style="color: #2D99FF;">A</span>dd Post</h1>
</div>
<div id="postAddWrap">
<?php
echo $this->Form->create('Post',array('type'=>'file'));
echo $this->Form->input('title',array(
	'label'=>__('Title'),
	'class'=>'form-control input-lg',
	'maxlength'=>26,
	'div'=>array(
		'class'=>'form-group',
	),
	'required'=>true,
));
echo $this->Form->input('Category.id',array(
	'label'=>__('Category'),
	'options'=>$category,
	'empty'=>__('Not Selected'),
	'div'=>array(
		'class'=>'form-group',
	),
	'required'=>true,
));
?><label>Tag</label><br/>
<p id="tagLimitMsg" data-TAGMAX='<?php echo json_encode($TAGMAX, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>'><small>the number of tags is limited between 0 and <?php echo $TAGMAX; ?>.</small></p>
<?php
//HABTM でPostとTagを結びつけるために、Formの入力先はPost.Tag
echo $this->Form->input('Post.Tag',array(
	'label'=>false,
	'options'=>$tag,
	'multiple'=>'checkbox',
	'class'=>'checkbox-inline',
	'id'=>'TagTag',
));
echo $this->Form->textarea('body',array(
	'label'=>__('Body'),
	'class'=>'form-control',
	'rows'=>5,
	'div'=>array(
		'class'=>'form-group',
	),
	'style'=>'font-size: large;',
));
?>
<div id="AttachmentsWrap">
	<div id="fileForms">
<?php
//webroot/files/attachment(モデル名)/photo(保存先ディレクトリ名) の下に保存
echo __('Please select images you want to upload.');
echo $this->Form->input('Attachment.0.photo',array(
	'class'=>'file-input fileForm',
	'label'=>false,
	'type'=>'file',
	'div'=>false,
	'required'=>false,
	'style'=>'display:none;',
	'onchange'=>'fileChange(this)',
));
?>
	</div>
	<div id="fileThumbnails">
		<div class="fileThumbnail" onclick="clickPropagate(this)" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">
			<a class="btn btn-inline"style="background-color: #00eeff">
				<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
			</a>
			<span class="input-xlg uneditable-input">select file</span>
		</div>
	</div>
</div>
<?php
echo $this->Form->button(
	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Save Post'),array(
	'type'=>'submit',
	'class'=>'btn addSaveBtn btn-block',
	'div'=>array(
		'class'=>'form-group',
	),
	'escape'=>false,
	'onclick'=>'beforeSubmit()',
));
echo $this->Form->end();
?>
</div><!-- postAddWrap -->
<?php echo $this->Html->script('postsAdd',array('inline'=>true,)); ?>
