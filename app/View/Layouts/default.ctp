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
	<?php echo $this->Html->css('blog.css?'.date("YmdHis")); ?>
	<?php echo $this->Html->script('jquery-1.12.4.min.js'); ?>
	<?php echo $this->Html->script('bootstrap.min.js'); ?>
</head>
<body style="padding-top: 70px;letter-spacing:0.1em;">
	<div class="col-md-offset-2 col-md-8" style="background-color: #ffffd2;padding-top: 15px;">
		<div id="header">
			<nav class="navbar nav-tabs navbar-default navbar-fixed-top" style="background-color: #2f3277;padding:2px 0;">
				<ul class="nav navbar-nav" style="width: 100%;">
					<li class="nav-item col-md-offset-2" style="padding-left: 15px;">
						<?php echo $this->Html->link(__('Posts'),array(
								'controller'=>'posts',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
								'style'=>'color:#ffffd2;',
							));
						?>
					</li>
					<li class="nav-item">
						<?php echo $this->Html->link(__('Users'),array(
								'controller'=>'users',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
								'style'=>'color:#ffffd2;',
							));
						?>
					</li>
					<li class="nav-item">
						<?php echo $this->Html->link(__('Groups'),array(
								'controller'=>'groups',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
								'style'=>'color:#ffffd2;',
							)); 
						?>
					</li>
					<li class="nav-item">
						<?php echo $this->Html->link(__('Categorys'),array(
								'controller'=>'categories',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
								'style'=>'color:#ffffd2;',
							)); 
						?>
					</li>
					<li class="nav-item">
						<?php echo $this->Html->link(__('Tags'),array(
								'controller'=>'tags',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
								'style'=>'color:#ffffd2;',
							)); 
						?>
					</li>
					<?php if(is_null($username)): ?>
					<li class="nav-item" style="float: right;margin-right: 15px;">
						<?php
						echo $this->Html->link(
							__('Sign Up!'),array(
								'controller'=>'users',
								'action'=>'add',
							),
							array(
								'id'=>'signupButton',
								'class'=>'btn btn-success',
								'style'=>'background-color: #ffffd2;border-color:#ffffd2;color:#220;',
							)
						);
						?>
					</li>
					<li class="nav-item" style="float: right;margin-right: 5px;">
						<?php
						echo $this->Html->link(
							__('Log In!'),array(
								'controller'=>'users',
								'action'=>'login',
							),
							array(
								'id'=>'loginButton',
								'class'=>'btn btn-md',
								'style'=>'background-color: #ffffd2;border-color:#ffffd2;color:#220;',
							)
						);
						echo '</li>';
						?>
					<?php else:?>
					<li class="nav-item" style="float: right;margin-right: 15px;">
					<?php
					echo $this->Html->link(
						__('Log out'),array(
							'controller'=>'users',
							'action'=>'logout',
						),
						array(
							'id'=>'logoutButton',
							'class'=>'btn btn-md',
							'style'=>'background-color: #ffffd2;border-color:#ffffd2;color:#220;',
						)
					);
					?>
					</li>
					<li class="nav-item" style="height: 48px;width: 141px;line-height: 50px;text-align: center;float: right;margin-right: 15px;border-color:#ffffd2;color:#ffffd2;border-radius: 5px;">
						<?php echo __('LoginUser: ').h($username); ?>
					</li>
					<?php endif; ?>
				</ul>
			</nav>
		</div><!-- header -->
		<div id="content">

			<?php echo $this->Flash->render(); ?>
			<?php echo $this->Flash->render('auth'); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php
			echo $this->Html->link(
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
	</div><!-- col-md-8 -->
	<div class="col-md-2">
		<div class="sidevar-nav affix" style="background-color: #bbb;padding: auto 0px;">
			<form id="zipcode-form" action="/zipcodes/search" method="POST">
				<div class="input text form-group">
					<label for="ZipcodeZipcode" class="control-label"><?php echo __('Zipcode');?></label>
					<input name="data[Zipcode][zipcode]" maxlength="7" type="text" id="ZipcodeZipcode" class="form-control" />
				</div>
				<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><?php echo __('Search');?></button>
			</form>
			<div class="input text form-group" id="address">
				<label for="address" class="control-label"><?php echo __('Address');?></label>
				<input name="data[address]" type="text" id="address-input" class="form-control" />
			</div>
			<div id="address-select" class="input select form-group" style="display: none;">
				<label for="address"><?php echo __('Address'); ?></label><br />
				<select name="data[address]" id="address-select-options" class="form-controll" style="font-size: 16px;border: 2px;">
					<option value="" selected="selected">Not Selected</option>
				</select>
			</div>
		</div>
	</div>
	<script>
		function addressSelected(){
			$('#address-input').val($("#address-select option:selected").text()); 
			$('#address-select').css('display','none');
			$('#address').css('display','block');
			$('#address-select-options').html('<option value="" selected="selected">Not Selected</option>');
		}

		$(function(){
			$('#address-select').change(addressSelected);

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
							$('#address-input').val(result[0]['Zipcode']['pref']+result[0]['Zipcode']['city']+result[0]['Zipcode']['street']);
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
							$('#address-select-options').html(options);
							$('#address-select').css('display','block');
						}else{
							$('#address-input').val('該当する住所はありません');
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
