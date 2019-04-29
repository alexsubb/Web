<?php
	require "db.php";
	
	$data = $_POST;
	$regexp_login = "/^[a-z]+([-_]?[a-z0-9]+){0,2}$/i";
	$regexp_email = "^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$";
	if( isset($data['do_signup']) )
	{
		$errors = array();
		if( trim($data['login']) == '')
		{
			$errors[] = 'Введите логин';
		}
		if( trim($data['email']) == '')
		{
			$errors[] = 'Введите email';
		}
		if( $data['password'] == '')
		{
			$errors[] = 'Введите пароль';
		}
		if( $data['password_2'] != $data['password'])
		{
			$errors[] = 'Пароли не совпадают';
		}
		
		if( R::count('user',"login = ?", array($data['login'])) >0)
		{
			$errors[] = 'Пользователь с таким логином уже существует';
		}
		
		if( R::count('user',"email = ?", array($data['email'])) >0)
		{
			$errors[] = 'Пользователь с таким email уже существует';
		}
		
		if(preg_match(regexp_login,$data['login'])
		{
			$errors[] = 'Фармат логина не верный';
		}
		if(preg_match(regexp_email,$data['email'])
		{
			$errors[] = 'Фармат email не верный';
		}
		
		if( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'],PASSWORD_DEFAULT);
			R::store($user);
			echo '<div style="color: green;">Вы успешно зарегистрированны!</div><hr>';
		} else 
		{
			echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
		}
		
	
	}
?>

<form action="/signup.php" method="POST">
	<p>
		<p><strong>Ваш логин</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data['login'];?>">
	</p>
	<p>
		<p><strong>Ваш Email</strong>:</p>
		<input type="email" name="email" value="<?php echo @$data['email'];?>>
	</p>
	<p>
		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password">
	</p>
	<p>
		<p><strong>Подтвердить пароль</strong>:</p>
		<input type="password" name="password_2">
	</p>
	<p>
		<button type="submit" name="do_signup">Зарегистрироваться</button>
	</p>
	
	
</form>