<?php session_start() ?>
<!DOCTYPE html>
<html lang="rus">
<head>
	<meta charset="UTF-8">
	<title>Grand-ele</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/user.css" type="text/css">
	<link rel="stylesheet" href="css/rooms.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/header_bg_none.css" type="text/css">
</head>
<body>
	<?php 
	require 'header.php';
	require 'php/request_rooms.php';
	 ?>
	<main>
		<div class="sidebar">
			<h1>Фильтр</h1>
			<div class="filter">
			<form action="php/upload_filter_properties.php" method="post">
				<div>
					<div class="filter-text">Тип:</div>
					<select class="filter-select" size="1" name="type" option="<?=$_SESSION['filter']['type']?>">
					<option value="%">Все</option>
					<option value="common">Стандартный</option>
					<option value="vip">VIP</option>
					</select>
				</div>
				<div>
					<div class="filter-text">Свободен с</div>
					<input class="filter-calendar filter-input" type="date" name="firstDate" value="<?=$_SESSION['filter']['firstDate']?>">
				</div>
				<div>
					<div class="filter-text">до</div>
					<input class="filter-calendar filter-input" type="date" name="lastDate" value="<?=$_SESSION['filter']['lastDate']?>">
				</div>
				<div>
					<div class="filter-text">Стоимость в сутки от:</div>
					<input class="filter-cost filter-input" type="text" name="frstCost" value="<?=$_SESSION['filter']['firstCost']?>">
				</div>
				<div>
					<div class="filter-text">до</div>
					<input class="filter-cost filter-input" type="text" name="lastCost" value="<?=$_SESSION['filter']['lastCost']?>">
				</div>
				<div>
					<div class="filter-text">Кол-во человек</div>
					<input class="filter-count filter-input" type="text" name="countPeople" value="<?=$_SESSION['filter']['countPeople']?>">
				</div>
				<button class="filter-btn" type="submit">Найти</button>
			</form>
			</div>
		</div>
		<div class="wrap">
			<?php 
			for ($i=0; $i < count($rooms_array); $i++) { 
			 ?>
			<div class="room-display">
				<div class="hidden-img">
					<img class="room-img" src="<?=$rooms_array[$i]['path']?>" alt="room">
				</div>
				<div class="room-text">
					<span class="room-type">Тип: <?php if($rooms_array[$i]['type']=='common'){
															echo "Стандартный";
														}
														else{
															echo $rooms_array[$i]['type'];
														}
														?>
					</span>
					<br>
					<span class="description">Двухместный номер</span>
					<span class="number"> №<?=$rooms_array[$i]['idRoom']?></span>
					<br>
					<span class="count-members">до <?=$rooms_array[$i]['size']?> мест<span>
					<br>
					<span class="cost">Стоимость в сутки <?=$rooms_array[$i]['dayCost']?>р.</span>
				</div>
				<form class="reserv" action="php/book_redir.php" method="get">
					<input type="hidden" name="idRoom" value="<?=$rooms_array[$i]['idRoom']?>">
					<input type="hidden" name="size" value="<?=$rooms_array[$i]['size']?>">
					<input type="hidden" name="dayCost" value="<?=$rooms_array[$i]['dayCost']?>">
					<input type="hidden" name="type" value="<?=$rooms_array[$i]['type']?>">
					<button class="sub-btn">Забронировать</button>
				</form>
			</div>
			<?php } ?>
		</div>
	</main>
		<?php 
		require 'footer.php';
		 ?>
</body>
</html>