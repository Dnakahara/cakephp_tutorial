<div class="jumbotron">
<h1><span style="color: #5787F4;">B</span>log posts</h1>
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
<section id="postsWrap">
	<?php foreach($posts as $post):
	echo '<article class="post col-md-4">';
		echo '<div class="postHead">';
			echo '<h2 class="postTitle">';
				echo $this->Html->link(
					$post['Post']['title'],array(
						'controller'=>'posts',
						'action'=>'view',
						$post['Post']['id'],
					),
					array(
						'style'=>'width:100%; height:100%; display:block;color: #4D4E53;',
						'class'=>'viewLink',
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
		echo '</div>';
		echo '<hr>';
		echo '<div class="postThumbnail">';
		$bodyThumbnailMax = 200;
		$bodyThumbnail = mb_substr($post['Post']['body'],0,$bodyThumbnailMax,"utf-8");

		$nlCnt = 0;
		$tmpStr = '';
		for($i = 0; $i < mb_strlen($bodyThumbnail) && $nlCnt < 10; ++$i){
			$tmpChar = mb_substr($bodyThumbnail,$i,1,"utf-8");
			$nlCnt += $tmpChar == PHP_EOL;
			$tmpStr .= $tmpChar;
		}
		$bodyThumbnail = $tmpStr;

		if(mb_strlen($bodyThumbnail,"utf-8") == $bodyThumbnailMax){
			$bodyThumbnail = $bodyThumbnail.'...';
		}

		echo nl2br($bodyThumbnail);
		echo '</div>';
		echo '<div style="clear: both;width: 0px;height: 0px;"></div>';
		if(isset($username) && $post['User']['username'] == $username){
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
		}
	echo '</article>';
	?>
	<?php endforeach; ?>
	<?php unset($posts); ?>
</section>
<div style="clear: both"></div>
<div class="pagination">
	<?php
	// 次ページと前ページのリンクを表示する
	echo $this->Paginator->prev(
		'< Previous',
		null,
		null,
		array(
			'class' => 'disabled prev',
		)
	);
	// ページ番号を表示する
	echo $this->Paginator->numbers(array(
		'modulus'=>8,
		'first'=>1,
		'last'=>1,
	));

	echo $this->Paginator->next(
		'Next >',
		null,
		null,
		array(
			'class' => 'disabled next',
		)
	);
	?>
	<div id="pageCounter">
	<?php
	// 現在のページ番号 / 全ページ数 を表示する
	echo $this->Paginator->counter();
	?>
	</div>
</div>
<?php echo $this->Html->script('postsIndex'); ?>
