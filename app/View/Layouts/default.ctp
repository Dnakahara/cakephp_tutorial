<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php //echo $cakeDescription ?>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

//		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<?php echo $this->Html->script('jquery-1.12.4.min.js'); ?>
	<?php echo $this->Html->script('bootstrap.min.js'); ?>
</head>
<body style="padding-top: 70px;">
	<div class="col-md-2">
		<div class="sidevar-nav affix">
			<?php if(is_null($username)): 
			echo '<p>LoginUser: GUEST</p>';
			echo $this->Html->link('Sign Up!',array(
				'controller'=>'users',
				'action'=>'add',
				'class'=>'btn',
			));
			echo $this->Html->link('Login!',array(
				'controller'=>'users',
				'action'=>'login',
				'class'=>'btn',
			));
			 else:?>
			<p>LoginUser: <?php echo h($username); ?></p>
			<?php
			echo $this->Html->link('Log out',array(
				'controller'=>'users',
				'action'=>'logout'
			));
			endif;
			?>

			<form id="zipcode-form" action="/zipcodes/search" method="POST">
				<div class="input text form-group">
					<label for="ZipcodeZipcode" class="control-label"><?php echo __('Zipcode');?></label>
					<input name="data[Zipcode][zipcode]" maxlength="7" type="text" id="ZipcodeZipcode" class="form-control" />
				</div>
				<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><?php echo __('Seaerch');?></button>
			</form>
			<div class="input text form-group" id="address">
				<label for="address" class="control-label"><?php echo __('Address');?></label>
				<input name="data[address]" type="text" id="address-input" class="form-control" />
			</div>
			<div id="address-select" class="input select form-group" style="display: none;">
				<label for="address"><?php echo __('Address'); ?></label>
				<select name="data[address]" id="address-select-options" onchange="addressSelected()">
					<option value="" selected="selected">Not Selected</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-10">
<!--		<div class="container"> -->
			<div id="header">
				<!-- <h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1> -->
				<nav class="navbar nav-tabs navbar-default navbar-fixed-top">
					<ul class="nav navbar-nav">
						<li><?php echo $this->Html->link(__('Posts'),array(
							'controller'=>'posts',
							'action'=>'index',
						)); ?></li>
						<li><?php echo $this->Html->link(__('Users'),array(
							'controller'=>'users',
							'action'=>'index',
						)); ?></li>
						<li><?php echo $this->Html->link(__('Groups'),array(
							'controller'=>'groups',
							'action'=>'index',
						)); ?></li>
						<li><?php echo $this->Html->link(__('Categorys'),array(
							'controller'=>'categories',
							'action'=>'index',
						)); ?></li>
						<li><?php echo $this->Html->link(__('Tags'),array(
							'controller'=>'tags',
							'action'=>'index',
						)); ?></li>
						</ul>
				</nav>
			</div>
			<div id="content">

				<?php echo $this->Flash->render(); ?>
				<?php echo $this->Flash->render('auth'); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
	<?php echo $this->Html->link(
		$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
		'http://www.cakephp.org/',
		array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
	);
	?>
				<p>
					<?php echo $cakeVersion; ?>
				</p>
			</div>
		<?php echo $this->element('sql_dump'); ?>
<!--		</div> -->
	</div>
	<script>
		function addressSelected(){
			$('#address-input').val($('#address-select').val()); 
			$('#address-select').css('display','none');
			$('#address').css('display','block');
			$('#address-select-options').html("");
		}

		$(function(){
			$('#zipcode-form').submit(function(event) {
				// HTMLでの送信をキャンセル
				event.preventDefault();

				// 操作対象のフォーム要素を取得
				var $form = $(this);

				// 送信ボタンを取得
				// （後で使う: 二重送信を防止する。）
				var $button = $form.find('button');

				// 送信
				$.ajax({
					url: $form.attr('action'),
					type: $form.attr('method'),
					data: $form.serialize(),
					timeout: 10000,  // 単位はミリ秒
					dataType: 'json',
					
					// 送信前
					beforeSend: function(xhr, settings) {
					     // ボタンを無効化し、二重送信を防止
					     $button.attr('disabled', true);
					},
					// 応答後
					complete: function(xhr, textStatus) {
					     // ボタンを有効化し、再送信を許可
					     $button.attr('disabled', false);
					},
					// 通信成功時の処理
					success: function(result, textStatus, xhr) {
						if(result.length === 1){
							if(result[0]['Zipcode']['street'] === "以下に掲載がない場合"){
								result[0]['Zipcode']['street'] = "";
							}
							$('#address').val(result[0]['Zipcode']['pref']+result[0]['Zipcode']['city']+result[0]['Zipcode']['street']);
							console.log(result);
						}else if(result.length >= 2){
							var options = '<option value="" selected="selected">Not Selected</option>';
							for(var i = 0; i < result.length; ++i){
								if(result[i]['Zipcode']['street'] === "以下に掲載がない場合"){
									result[i]['Zipcode']['street'] = "";
								}
								var val = result[i]['Zipcode']['pref']+result[i]['Zipcode']['city']+ result[i]['Zipcode']['street'];
								options += '<option value="' + val + '">' + val + '</option>';
							}
							$('#address').css('display','none');
							console.log(options);
							$('#address-select-options').html(options);
							$('#address-select').css('display','block');
						}else{
							console.log('empty');
						}
					},
					// 通信失敗時の処理
					error: function(xhr, textStatus, error) {
						console.error('error');
					}
				});
			});
		});
	</script>
</body>
</html>
