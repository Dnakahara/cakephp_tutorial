<?php echo $this->Html->css('lightbox.min.css'); ?>
<?php echo $this->Html->css('blog.css?'.date('YmdHis')); ?>
<?php echo $this->Html->script('lightbox.min.js'); ?>
<div id="postView">
	<div id="postContent">
		<h1 class="postTitle" style="font-size: xx-large;color: #4D4E53;">
			<?php echo '<strong style="color: #ffc337;">'.h($post['Post']['title'][0]).'</strong>'.h(mb_substr($post['Post']['title'],1,99,"utf-8")); ?>
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
		<p id="postBody"><?php echo h($post['Post']['body']); ?></p>

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
</div><!-- postView -->

<script>
	(function(){
		//センタリングをする関数
		function centeringModalSyncer(){

			//画面(ウィンドウ)の幅を取得し、変数[w]に格納
			let w = $(window).width();

			//画面(ウィンドウ)の高さを取得し、変数[h]に格納
			let h = $(window).height();

			//コンテンツ(#modal-content)の幅を取得し、変数[cw]に格納
			//var cw = $('#modal-content').outerWidth(true);

			//コンテンツ(#modal-content)の高さを取得し、変数[ch]に格納
			//var ch = $('#modal-content').outerHeight(true);
			let img = $('#modal-content').find('img').eq(0);
			img.bind("load",function(){
				let ch = $(this).height();
				let cw = $(this).width();

				//コンテンツ(#modal-content)を真ん中に配置するのに、左端から何ピクセル離せばいいか？を計算して、変数[pxleft]に格納
				let pxleft = ((w - cw)/2);

				//コンテンツ(#modal-content)を真ん中に配置するのに、上部から何ピクセル離せばいいか？を計算して、変数[pxtop]に格納
				let pxtop = ((h - ch)/2);

				//[#modal-content]のCSSに[left]の値(pxleft)を設定
				$('#modal-content').css({"left": pxleft + "px"});

				//[#modal-content]のCSSに[top]の値(pxtop)を設定
				$('#modal-content').css({"top": pxtop + "px"});
			});
		}
		
		let imgArray = <?php echo json_encode($post['Attachment'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

		$(function(){
			console.log(imgArray);
			$('.thumbnail').click(function(){
				$(this).blur();
				if($('#modal-overlay').css('display')!=='none')return false;
				let imgIdx = parseInt(($(this).attr('id')).substring(9),10);
				let img = $('<img src="/files/attachment/photo/'+ imgArray[imgIdx]['photo_dir'] + '/' + imgArray[imgIdx]['photo'] + '"  class="img-responsive modalImg" id="modalImg' + imgIdx + '" />');
				$('#modal-content').prepend(img);
				img.ready(function(){
					centeringModalSyncer();
					$('#modal-overlay').fadeIn(800);
				});
			});
			
			$('#modal-overlay,#modal-close').click(function(){
				$('#modal-overlay').fadeOut(800,()=>{
					$('#modal-content img[id^="modalImg"]').remove();
				});
			});

			$('#modal-content').on('click','.modalImg',function(){
				event.stopPropagation();
			});

			$('#prev').click(function(){
				let modalContent = $(this).siblings('#modal-content');
				let beforeImg = modalContent.find('img[id^="modalImg"]');
				let beforeImgIdx = parseInt((beforeImg.attr('id')).substring(8),10);
				let afterImgIdx = (beforeImgIdx - 1 + imgArray.length) % imgArray.length;
				let afterImg =  $('<img src="/files/attachment/photo/'+ imgArray[afterImgIdx]['photo_dir'] + '/' + imgArray[afterImgIdx]['photo'] + '"  class="img-responsive modalImg" id="modalImg' + afterImgIdx + '" />');
				beforeImg.remove();
				modalContent.prepend(afterImg);
				afterImg.ready(function(){
					centeringModalSyncer();
				});
				event.stopPropagation();
			});

			$('#next').click(function(){
				let modalContent = $(this).siblings('#modal-content');
				let beforeImg = modalContent.find('img[id^="modalImg"]');
				let beforeImgIdx = parseInt((beforeImg.attr('id')).substring(8),10);
				let afterImgIdx = (beforeImgIdx + 1) % imgArray.length;
				let afterImg =  $('<img src="/files/attachment/photo/'+ imgArray[afterImgIdx]['photo_dir'] + '/' + imgArray[afterImgIdx]['photo'] + '"  class="img-responsive modalImg" id="modalImg' + afterImgIdx + '" />');
				beforeImg.remove();
				modalContent.prepend(afterImg);
				afterImg.ready(function(){
					centeringModalSyncer();
				});
				event.stopPropagation();
			});
		});
	})();
</script>
