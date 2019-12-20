<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="rus">
<head>
	<meta charset="UTF-8">
	<title>Gand-ele</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/reg.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="reghed">
			<a href="index.php"><img class="logo" src="img/Logo.jpg" alt="Logo"></a>
		<nav>
			<div class="header-top">
				<div class="hotel-name">Grand-ele</div>
					<button class="language">Русский/English</button>
			</div>
			<div class="nav-panel">
				<ul>
					<li><a class="nav-link" href="#">О НАС</a></li>
					<li><a class="nav-link" href="#">ОТЗЫВЫ</a></li>
					<li><a class="nav-link" href="rooms.html">НОМЕРА</a></li> 
					<li><a class="nav-link" href="#">ФОТОГАЛЕРЕЯ</a></li>
					<li><a class="nav-link" href="#">БРОНИРОВАНИЕ</a></li>
					<li class="border-none"><a class="nav-link" href="#">КОНТАКТЫ</a></li>
				</ul>
			</div>
		</nav>
		</div>
			<form class="reg-form" action="php/auth.php" method="post">
				<h1>Авторизация</h1>
				<div class="reg-text">Логин </div>
				<input class="reg-input" type="text" name="login" value="<?=$_SESSION['regfields']['login']?>">
				<div class="reg-text">Пароль </div>
				<input class="reg-input pass" type="password" name="pass">
				<div class="right"><?=$_SESSION['regerrors'][0]?></div>
				<br>
				<button class="reg-btn">Войти</button>
			</form>
	</header>
		<footer >
		<div class="text-gold">Сайт разработан Kharin & Kulishkin ind.</div>
		<div class="text-gold">2019г</div>
		<div class="text-gold">Все права защищены</div>
	</footer>
</body>
</html>