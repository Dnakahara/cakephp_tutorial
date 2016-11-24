<?php echo $this->Html->css('lightbox.min.css'); ?>
<?php echo $this->Html->css('blog.css?'.date('YmdHis')); ?>
<?php echo $this->Html->script('lightbox.min.js'); ?>
<article id="postView">
	<div id="postContent" data-imgArray='<?php echo json_encode($post['Attachment'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
		<h1 class="postTitle" style="font-size: xx-large;color: #4D4E53;">
			<?php echo '<span style="color: #ffc337;">'.h($post['Post']['title'][0]).'</span>'.h(mb_substr($post['Post']['title'],1,99,"utf-8")); ?>
		</h1>
		<?php
		echo '<p class="postInfo">';
			echo '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.__('Author: ').$post['User']['username'];
		echo '</p>'; 
		echo '<p class="postInfo">';
			echo '<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>'.__('Category: ').$post['Category']['categoryname'];
		echo '</p>';
		echo '<ul class="postTags">';
			foreach($post['Tag'] as $tag):
				echo '<li class="postTag postInfo"><a id="tag-a" href="javascript:void(0)"><span>'.$tag['tagname'].'</span></a></li>';
			endforeach;
		echo '</ul>';
		echo '<div style="clear: both;width: 0px;height: 0px;"></div>';
		echo '<hr>';
?>
		<p id="postBody"><?php echo nl2br(h($post['Post']['body'])); ?></p>

		<?php 
		for($i = 0; $i < count($post['Attachment']); $i++){
			if($i % 6 == 0){echo '<div class="row">';}
			echo '<div class="col-md-2">';
			echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.$post['Attachment'][$i]['photo'],array(
				'class'=>'img-responsive thumbnail',
				'id'=>'thumbnail'.$i,
				'width'=>'256',
			));
			echo '</div>';
			if($i % 6 == 5 || $i+1 >= count($post['Attachment'])){echo '</div>';}
		}
		?>

		<div id="modal-overlay">
			<div id="modal-content">
				<img src="/images/close.png" alt="close modal" class="modalclose" />
			</div>
			<div id="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
			<div id="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
		</div>
	</div><!-- postContent -->
</article><!-- postView -->
<?php echo $this->Html->script('postsView'); ?>
