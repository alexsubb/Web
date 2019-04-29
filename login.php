<?php
	require "db.php";
	
	$data = $_POST;
	if( isset($data['do_login']) )
	{
		$errors = array();
		$user = R::findOne('user','',array($data['login']))
		if( $user )
		{
			if(password_verify($data['password'],$user->password))
			{
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Вы успешно Авторизованы!<br/>
				Можете перейти на <a href="/">главную</a> страницу! </div><hr>';
			} else 
			{
				$errors[] = 'Пароль введен не верно';
			}
		} else
		{
			$errors[] = 'Пользователя с таким логином не существует';
		}
		
		if(! empty($errors) )
		{
			echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
		}
	}
?>
 <form action="login.php" method="POST">
	<p>
		<p><strong>Ваш логин</strong>:</p>
		<input type="text" name="login">
	</p>
	<p>
		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password">
	</p>
	<p>
		<button type="submit" name="do_login">Зарегистрироваться</button>
	</p>
 </form>