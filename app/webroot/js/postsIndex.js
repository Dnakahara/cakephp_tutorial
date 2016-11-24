function searchFormClear(){
	$('#searchTitle').val('');
	$('#searchCategory').val('');
	let $searchTags = $('input[id^="searchTag"]');
	console.log($searchTags);
	for(let i = 0; i < $searchTags.length; ++i){
		let searchTag = '#searchTag'+ (i+1);
		console.log(searchTag);
		$(searchTag).prop('checked',false);
	}
}

function tagClick(tagid){
	event.stopPropagation();
	searchFormClear();
	let taginput = '#searchTag'+tagid;
	$(taginput).prop('checked',true);
	$('#postSearchBtn').click();
}

let postSearchFieldToggle = false;
$(function(){
	$('#postsWrap .post .btn').click(function(){
		event.stopPropagation();
	});
	$('#postsWrap .post').click(function(){
		location.href = $(this).find('.viewLink').attr('href');
	});

	$('#toggleSearchBtn').click(function(){
		$(this).blur();
		let $postSearchField = $('#postSearchField');
		$postSearchField.toggle('fast');
		postSearchFieldToggle = !postSearchFieldToggle;
		
		if(postSearchFieldToggle){
			$(this).html('<span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>Close Search');
		}else{
			$(this).html('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search');
		}
	});
});
