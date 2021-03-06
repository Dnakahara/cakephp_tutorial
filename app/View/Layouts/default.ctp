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
<body style="padding-top: 52px;letter-spacing:0.1em;">
	<div class="col-md-offset-2 col-md-8" style="background-image: url('/img/cream-paper.png');background-color: #333333;padding-top: 15px;">
		<header id="header">
			<nav class="navbar nav-tabs navbar-default navbar-fixed-top">
				<ul class="nav navbar-nav" style="width: 100%;">
					<li class="nav-item col-md-offset-2" style="padding-left: 15px;">
						<?php echo $this->Html->link(__('Posts'),array(
								'controller'=>'posts',
								'action'=>'index',
							),
							array(
								'class'=>'nav-a',
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
							)); 
						?>
					</li>
					<li class="nav-item col-md-2" style="float: right;"></li>
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
								'class'=>'btn',
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
								'class'=>'btn',
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
							'class'=>'btn',
						)
					);
					?>
					</li>
					<li class="nav-item" style="height: 48px;width: 141px;line-height: 50px;text-align: center;float: right;margin-right: 15px;border-color:#ffe3ad;color:#ffe3ad;border-radius: 5px;">
						<?php echo __('LoginUser: ').h($username); ?>
					</li>
					<li class="nav-item" style="float: right;margin-right: 15px;">
						<?php
						echo $this->Html->link(
							'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'.__('Add Post'),array(
								'controller'=>'posts',
								'action'=>'add',
							),
							array(
								'class'=>'btn addSaveBtn',
								'escape'=>false,
							)
						);
						?>
					</li>
					<?php endif; ?>
				</ul>
			</nav>
		</header><!-- header -->
		<div id="content">

			<?php echo $this->Flash->render(); ?>
			<?php echo $this->Flash->render('auth'); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<footer id="footer">
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
		</footer>
		<?php #echo $this->element('sql_dump'); ?>
	</div><!-- col-md-8 -->
	<div class="col-md-2" style="margin-top: 52px;">
		<aside class="sidevar-nav" style="background-color: #bbb;">
			<form id="zipcode-form" action="/zipcodes/search" method="POST">
				<div class="input text form-group">
					<label for="ZipcodeZipcode" class="control-label"><?php echo __('Zipcode');?></label>
					<input name="data[Zipcode][zipcode]" maxlength="7" type="text" id="ZipcodeZipcode" class="form-control" required="true" />
				</div>
				<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><?php echo __('Search');?></button>
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
		</aside>
	</div>
	<?php echo $this->Html->script('layoutsDefault'); ?>
</body>
</html>
