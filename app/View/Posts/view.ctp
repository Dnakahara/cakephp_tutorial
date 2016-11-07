<?php echo $this->Html->css('lightbox.min.css'); ?>
<?php echo $this->Html->css('slideModal.css'); ?>
<?php echo $this->Html->script('lightbox.min.js'); ?>
<?php echo $this->element('header'); ?>
<h1><?php echo h($post['Post']['title']); ?></h1>
<p><small><?php echo __('Created: '); echo $post['Post']['created']; ?></small></p>
<p><?php echo __('Category: '); echo h($post['Category']['categoryname']); ?></p>
<p><?php echo __('Tag: '); ?></p> 
<?php foreach($post['Tag'] as $tag):
echo h($tag['tagname']);
endforeach;
?>
<p><?php echo h($post['Post']['body']); ?></p>

<?php 
for($i = 0; $i < count($post['Attachment']); $i++){
	if($i % 6 == 0){echo '<div class="row">';}
	echo '<div class="col-md-2">';
	echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.$post['Attachment'][$i]['photo'],array(
		'class'=>'img-responsive thumbnail',
		'width'=>'256',
	));
	echo '</div>';
	if($i % 6 == 5 || $i+1 >= count($post['Attachment'])){echo '</div>';}
}
	# 下記が表示部分
?>

<div id="modal-overlay">
	<div id="modal-content">
	<?php
	for($i = 0; $i < count($post['Attachment']); $i++){
		echo $this->Html->image($imgSrcPrefix.$post['Attachment'][$i]['photo_dir'].DS.$post['Attachment'][$i]['photo'],array(
			'class'=>'img-responsive modalImg',
			'id'=>'modalImg'.$i,
		));
	}
	?>
		<img src="/images/close.png" alt="close modal" class="modalclose" />
	</div>
</div>

<script>
	$(function(){
		//センタリングをする関数
		function centeringModalSyncer(){

			//画面(ウィンドウ)の幅を取得し、変数[w]に格納
			var w = $(window).width();

			//画面(ウィンドウ)の高さを取得し、変数[h]に格納
			var h = $(window).height();

			//コンテンツ(#modal-content)の幅を取得し、変数[cw]に格納
			var cw = $("#modal-content").outerWidth({margin:true});

			//コンテンツ(#modal-content)の高さを取得し、変数[ch]に格納
			var ch = $("#modal-content").outerHeight({margin:true});

			//コンテンツ(#modal-content)を真ん中に配置するのに、左端から何ピクセル離せばいいか？を計算して、変数[pxleft]に格納
			var pxleft = ((w - cw)/2);

			//コンテンツ(#modal-content)を真ん中に配置するのに、上部から何ピクセル離せばいいか？を計算して、変数[pxtop]に格納
			var pxtop = ((h - ch)/2);

			//[#modal-content]のCSSに[left]の値(pxleft)を設定
			$("#modal-content").css({"left": pxleft + "px"});

			//[#modal-content]のCSSに[top]の値(pxtop)を設定
			$("#modal-content").css({"top": pxtop + "px"});
		}
		
		$('.thumbnail').click(function(){
			$(this).blur();
			if($('#modal-overlay').css('display')!=='none')return false;
			centeringModalSyncer()
			$('#modal-overlay').fadeIn(800);
		});
		
		$('#modal-overlay,#modal-close').click(function(){
			$('#modal-overlay').fadeOut(800);
		});
	});
</script>
