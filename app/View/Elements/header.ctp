<header>
<?php if(is_null($username)): 
echo '<p>LoginUser: GUEST</p>'; 
echo $this->Html->link('Sign Up!',array(
	'controller'=>'users',
	'action'=>'add'
));
echo $this->Html->link('Login!',array(
	'controller'=>'users',
	'action'=>'login'
));
else:?>
<p>LoginUser: <?php echo h($username); ?></p>
<?php
echo $this->Html->link('Log out',array(
	'controller'=>'users',
	'action'=>'logout'
));
endif; ?>
</header>
