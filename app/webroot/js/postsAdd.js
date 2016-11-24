function beforeSubmit(){
	let $fileForms = $('#fileForms>.fileForm');
	$fileForms.eq($fileForms.length-1).remove();
	for(var i = 0; i < $fileForms.length; ++i){
		$fileForms.eq(i).attr('name','data[Attachment]['+i+'][photo]');
	}
	let $checkedList = $('.checkbox-inline input[type="checkbox"]:checked');
	let TAGMAX = JSON.parse($('#tagLimitMsg').attr('data-TAGMAX')); 
	if($checkedList.length > TAGMAX){
		$('#tagLimitMsg').css('color','red');
	}
}

function clickPropagate(fileThumbnail){
	let idx = $('#fileThumbnails>.fileThumbnail').index($(fileThumbnail));
	$('#fileForms>.fileForm').eq(idx).click();
}

function fileChange(fileForm){
	let $fileForms = $('#fileForms>.fileForm');
	let $fileThumbnails = $('#fileThumbnails>.fileThumbnail');
	let fileFormIdx = $fileForms.index($(fileForm));
	if($(fileForm).val()==''){
		$(fileForm).remove();
		$fileThumbnails.eq(fileFormIdx).remove();
		return;
	}
	
	$fileThumbnails.eq(fileFormIdx).children('span').html($(fileForm).val().replace("C:\\fakepath\\",""));

	let removeButton = '<a class="btn btn-inline pull-right"style="background-color: rgba(0,0,0,0.7);" onclick="uploadCancel(this.parentNode)">'
			 + '	<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #f55;background-color: rgba(0,0,0,0);"></span>'
			 + '</a>';
	$fileThumbnails.eq(fileFormIdx).append(removeButton);
	
	if(fileFormIdx + 1 < $fileForms.length){return;}

	let nextFileForm = '<input type="file" class="file-input fileForm" onchange="fileChange(this)" style="display: none;"/>';
	let nextFileThumbnail = '<div class="fileThumbnail" onclick="clickPropagate(this)" style="margin-bottom: 20px;border: ridge 2px #000000;border-radius: 0.4em;">'
			      + '<a class="btn btn-inline"style="background-color: #00eeff">'
			      + '<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>'
			      + '</a>'
			      + '<span class="input-xlg uneditable-input">select file</span>'
			      + '</div>';
	$('#fileForms').append(nextFileForm);
	$('#fileThumbnails').append(nextFileThumbnail);
}

function uploadCancel(fileThumbnail){
	event.stopPropagation();
	let fileThumbnailIdx = $('#fileThumbnails>.fileThumbnail').index($(fileThumbnail));
	$(fileThumbnail).remove();
	$('#fileForms>.fileForm').eq(fileThumbnailIdx).remove();
	return;
}
$(function(){
	$('#file-input').change(function() {
		$('#cover').html($(this).val().replace("C:\\fakepath\\",''));
	});
});
