<div class="jumbotron">
<h1><strong style="color: #5787F4;">B</strong>log posts</h1>
</div>
<?php echo $this->Flash->render('authorityError'); ?>
<div id="searchField">
	<button type="button" id="toggleSearchBtn" class="btn btn-block btn-info" div="form-group" style="letter-spacing: 0.1em;">
		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search
	</button>
	<?php echo $this->Form->create('Post',array(
		'novalidate'=>true,
	));
	?>
		<fieldset id="postSearchField" class="none">
		<legend><?php echo __('Please input infomation for Searching'); ?></legend>
		<?php 
		echo $this->Form->input('title',array(
			'id'=>'searchTitle',
			'class'=>'input-lg',
			'label'=>__('Title'),
			'required'=>false,
		));
		echo $this->Form->input('category_id',array(
			'id'=>'searchCategory',
			'label'=>__('Category'),
			'options'=>$category,
			'empty'=>__('Not Selected'),
		));
		?><label>Tag</label><br/>
		<?php
		echo $this->Form->input('tag_id',array(
			'id'=>'searchTag',
			'label'=>false,
			'options'=>$tags,
			'multiple'=>'checkbox',
			'class'=>'checkbox-inline',
		));
		echo $this->Form->button(
			'<span class="glyphicon glyphicon-search" aria-hidden="true"></span>'.__('Search'),array(
			'type'=>'submit',
			'id'=>'postSearchBtn',
			'class'=>'btn btn-info',
			'div'=>array(
				'class'=>'form-group',
			),
			'escape'=>false,
		));
		?>
		</fieldset>
	<?php echo $this->Form->end(); ?>
</div>
<!--
<table class="table-bordered table-striped table-condensed" style="line-height: 2.5em;margin-bottom: 20px;">
	<thead>
		<tr class="row">
			<th class="col-md-2"><?php echo __('Created'); ?></th>
			<th class="col-md-6"><?php echo __('Title'); ?></th>
			<th class="col-md-2"><?php echo __('Author'); ?></th>
			<th class="col-md-2"><?php echo __('Change'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($posts as $post): ?>
		<tr class="row clickable-row">
			<td class="col-md-2"><?php echo $post['Post']['created']; ?></td>
			<td class="col-md-6"><?php
				echo $this->Html->link(
					$post['Post']['title'],array(
						'controller'=>'posts',
						'action'=>'view',
						$post['Post']['id'],
					),
					array(
						'style'=>'width:100%; height:100%; display:block;'
					)
				); 
			    ?>
			</td>
			<td class="col-md-2"><?php echo $post['User']['username']; ?></td>
			<td class="row col-md-2 btn-group"><?php
				echo $this->Html->link(
					__('Edit'),array(
						'controller'=>'posts',
						'action'=>'edit',
						$post['Post']['id'],
					),
					array(
						'class'=>'col-md-6 btn btn-primary',
					)
				);
				echo $this->Form->postLink(
					__('Delete'),array(
						'controller'=>'posts',
						'action'=>'delete',
						$post['Post']['id']
					),
					array(
						'confirm'=>__('Are you sure?'),
						'class'=>'col-md-6 btn btn-warning',
					)
				);
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
-->
<div id="postsWrap">
	<?php foreach($posts as $post):
	echo '<div class="post col-md-4">';
		echo '<h2 class="postTitle">';
			echo $this->Html->link(
				$post['Post']['title'],array(
					'controller'=>'posts',
					'action'=>'view',
					$post['Post']['id'],
				),
				array(
					'style'=>'width:100%; height:100%; display:block;color: #4D4E53;'
				)
			);
		echo '</h2>';
		echo '<p class="postInfo">';
			echo '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.__('Author: ').$post['User']['username'];
		echo '</p>'; 
		echo '<p class="postInfo">';
			echo '<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>'.__('Category: ').$post['Category']['categoryname'];
		echo '</p>';
		echo '<ul class="postTags">';
			foreach($post['Tag'] as $tag):
				echo '<li class="postTag postInfo"><a id="tag-a" href="javascript:void(0)" onclick="tagClick('.$tag['id'].')"><span>'.$tag['tagname'].'</span></a></li>';
			endforeach;
		echo '</ul>';
		echo '<div style="clear: both;width: 0px;height: 0px;"></div>';
		echo '<hr>';
		$bodyThumbnailMax = 200;
		$bodyThumbnail = mb_substr($post['Post']['body'],0,$bodyThumbnailMax,"utf-8");
		if(mb_strlen($bodyThumbnail,"utf-8") == $bodyThumbnailMax){
			$bodyThumbnail = $bodyThumbnail.'...';
		}

		echo $bodyThumbnail;
		echo '<div style="clear: both;width: 0px;height: 0px;"></div>';
		echo $this->Html->link(
			__('Edit'),array(
				'controller'=>'posts',
				'action'=>'edit',
				$post['Post']['id'],
			),
			array(
				'class'=>'btn postEditBtn',
			)
		);
		echo $this->Form->postLink(
			__('Delete'),array(
				'controller'=>'posts',
				'action'=>'delete',
				$post['Post']['id']
			),
			array(
				'confirm'=>__('Are you sure?'),
				'class'=>'btn postDeleteBtn',
			)
		);
	echo '</div>';
	?>
	<?php endforeach; ?>
	<?php unset($posts); ?>
</div>
<div style="clear: both"></div>
<div class="pagination">
<?php
// 次ページと前ページのリンクを表示する
echo $this->Paginator->prev(
	'< Previous',
	null,
	null,
	array(
		'class' => 'disabled',
		'style'=>'margin: 20px;',
	)
);
// ページ番号を表示する
echo $this->Paginator->numbers();

echo $this->Paginator->next(
	'Next >',
	null,
	null,
	array(
		'class' => 'disabled',
		'style'=>'margin: 20px;',
	)
);

// 現在のページ番号 / 全ページ数 を表示する
echo $this->Paginator->counter();
?>
</div>
<script>
	function Sleep( T ){ 
		var d1 = new Date().getTime(); 
		var d2 = new Date().getTime(); 
		while( d2 < d1+1000*T ){    //T秒待つ 
			d2=new Date().getTime(); 
		} 
		return; 
	} 

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
		searchFormClear();
		let taginput = '#searchTag'+tagid;
		$(taginput).prop('checked',true);
		$('#postSearchBtn').click();
	}

	let postSearchFieldToggle = false;
	$(function(){
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

</script>
