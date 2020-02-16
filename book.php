<?php session_start() ?>
<!DOCTYPE html>
<html lang="rus">
<head>
	<meta charset="UTF-8">
	<title>Grand-ele</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/book.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/header_bg_none.css" type="text/css">
</head>
<body>
<?php 
	require 'header.php';
?>
	<main>
		<div class="book-wrap">
			<form class="book-form" action="php/book.php" method="post">
					<div class="passport-wrap">
						<div class="text-book">Серия и номер паспорта:</div>
						<input type="text"  class="passport-input input" name='passport' value="<?=$_SESSION['bookfields']['passport']?>">
					</div>
					<div class="name-wrap">
						<div class="text-book">Имя:</div>
						<input type="text" class="text-input input" name="name" value="<?=$_SESSION['bookfields']['name']?>">
					</div>
					<div class="name-wrap">
						<div class="text-book">Фамилия:</div>
						<input type="text" class="text-input input" name='surname' value="<?=$_SESSION['bookfields']['surname']?>">
					</div>
					<div class="gender-wrap">
						<div class="text-book">Пол:</div>
						<select class="gender-select">
							<option class="gender-option" value="man">Мужской</option>
							<option class="gender-option" value="woman">Женский</option>
						</select>
					</div>
					<div class="date-wrap">
						<div class="text-book">Дата рождения:</div>
						<input class="input" type="date" name="birthDate" value="<?=$_SESSION['bookfields']['birthDate']?>">
					</div>
					<div class="date-wrap">
						<div class="text-book">Дата заселения:</div>
						<input class="input" type="date" name="arrivalDate" value="<?=$_SESSION['bookfields']['arrivalDate']?>">
					</div>
					<div class="date-wrap">
						<div class="text-book">Дата отъезда:</div>
						<input class="input" type="date" name="departureDate" value="<?=$_SESSION['bookfields']['departureDate']?>">
					</div>
					<input type="hidden" name="idRoom" value="<?=$_SESSION['bookIdRoom']?>">
					<button class="btn-book" type="submit">Забронировать</button>
					<div class="error-msg"><?=$_SESSION['bookerrors']?></div>
			</form>
			<div class="room-data">
				<div class="info-text">Номер комнаты: <?=$_SESSION['bookIdRoom']?></div>
				<div class="info-text">Кол-во мест: <?=$_SESSION['bookSize']?></div>
				<div class="info-text">Тип: <?=$_SESSION['bookType']?></div>
				<div class="info-text">Стоимость: <span id="cost"><?=$_SESSION['bookDayCost']?></span></div>
			</div>
		</div>
	</main>
<?php 
	require 'footer.php';
?>
</body>
</html>