<?php 
session_start();
require 'php/CounterVisitings.php';
 ?>
<!DOCTYPE html>
<html lang="rus">
<head>
	<meta charset="UTF-8">
	<title>Grand-ele</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/user.css">
</head>
<body>
	<?php 
	require 'header.php';
	 ?>
	<section class="book">
		<div class="book-text">
			<span class="bold-text">БРОНИРОВАНИЕ</span>
			<br>
			<span class="small-text">Гарантия лучшей цены</span>
		</div>
		<form action="php/redir.php" method="get" class="book-form">
			<div class="form-text">Заезд</div>
			<input class="form-input calendar" type="date" name="firstDate">
			<div class="form-text">Выезд</div>
			<input class="form-input calendar" type="date" name="lastDate">
			<div class="form-text">Гостей</div>
			<input class="form-input form-number" type="text" value="1" name="size">
			<button class="book-btn" type="submit">Найти</button>
		</form>
	</section>
	<section class="history">
		<h1>История отеля Grand-ele</h1>
		<div class="content">
			<img class="history-img" src="img/History.jpg" alt="History">
			<div class="history-text">
				Уже более 60 лет наш отель радует своих постояльцев
				высоким качеством обслуживания, уютными
				апартаментами и по праву считается лучшим
				отелем всей сибири.
			</div>
		</div>
	</section>
	<section class="rooms">
		<h1>Номера</h1>
			<div class="content-rooms">
				<div class="room">
					<img src="img/room1.jpg" alt="room">
					<button class="room-btn">
						Узнать цену
					</button>
			</div>
				<div class="room">
					<img src="img/room2.jpg" alt="room">
					<button class="room-btn">
						Узнать цену
					</button>
				</div>
			</div>
	</section>
	<section class="contacts">
		<h1>Контакты</h1>
		<div class="contacts-content">
			<div class="contact-elem">
				<img class="ico-geo" src="img/geoico.png" alt="geo">
				Адресс: г.Томск ул.Вершинина дом 48
			</div>
			<div class="contact-elem max1">
				<img class="ico" src="img/telephoneico.png" alt="tele">
				Телефон: 
				<br>
				+7(999)999-99-99
				<br>
				<img class="ico" src="img/whtasappico.png" alt="what">
				WhatsApp:
				<br>
				 +7(999)999-99-99
				<br>
				<img class="ico" src="img/Viberico.png" alt="what">
				Viber:
				<br>
				 +7(999)999-99-99
			</div>
			<div class="contact-elem">
				<img class="ico" src="img/emailico.png" alt="email">
				<span>GrandEle@gmail.com</span>
				<br>
				Оставьте свое сообщение нам на почту
			</div>
		</div>
	</section>
	<section class="map">
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aeaef5f4f166ace2da00974d4bed9f6677b562daaa5a3f68544fbc97f66a0f4d7&amp;width=100%25&amp;height=447&amp;lang=ru_RU&amp;scroll=true"></script>
	</section>
	<?php 
	require 'footer.php';
	 ?>
</body>
</html>