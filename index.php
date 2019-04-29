<?php
	require "db.php";
?>

<?php if( isset($_SESSION['logged_user']) ): ?>
	АВТОРИЗОВАН <br>
	Привет, <?php echo $_SESSION['logged_user']->login; ?>
	<hr>
	<a href="/logout.php">Выйти</a>
<?php else : ?>
	<a href = "/login.php">Авторизация</a> <br>
	<a href = "/signup.php">Регистрация</a>
<?php endif; ?>
