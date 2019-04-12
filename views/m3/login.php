<?php
if(isset($login_error)){
	echo '<p><small>' . $login_error . '</small></p>';
}
echo Form::open(array('action' => 'index/m3/login', 'method' => 'post'));

	echo Form::label('Username:', 'username') . ' ';
	echo Form::input('username', '', array('class' => 'login-form'));
	echo '<br><br>';
	
	echo Form::label('Password: ', 'password') . ' ';
	echo Form::password('password', '', array('class' => 'login-form'));
	echo '<br><br>';

	echo Form::button('frmbutton', 'Login', array('class' => 'btn btn-default'));

echo Form::close();
?>

<

