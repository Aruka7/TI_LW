<?php 
if(!isset($_COOKIE['user'])){
	header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
}
$cook_arr = unserialize($_COOKIE['user']);
$login = $cook_arr['login'];
$pass = $cook_arr['pass'];
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
$conn = new mysqli($host,$username,$password,$dbname);
$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
if(count($user)==0){
	setcookie('user', null, time() + -1, "/");
	header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
}
if($user['accesslvl']<2){
	header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
}
?>
<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="rus">
<head>
	<meta charset="UTF-8">
	<title>Grand-ele</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/user.css">
	<link rel="stylesheet" type="text/css" href="css/header_bg_none.css">
	<link rel="stylesheet" href="css/Admin_panel.css" type="text/css">
</head>
<body>
	
<?php 
	require 'header.php';
	$cook_arr = unserialize($_COOKIE['user']);
?>
<main class="admin-main">
	<div>
		<form class="admin-form" method="post" action="php/addRoom.php" enctype="multipart/form-data">
			<h2>Добавление комнаты</h2>
			<div>Номер комнаты</div>
			<input type="text" name="idRoom">
			<div>Кол-во мест</div>
			<input type="text" name="size">
			<div>Тип</div>
			<select name="type">
				<option  value="common">Обычный</option>
				<option  value="vip">VIP</option>
			</select>
			<div>Стоимость в сутки</div>
			<input type="text" name="dayCost">
			<div>Загрузить изображение комнаты</div>
			<input type="hidden" name="max_size" value="30000" />
			<input type="file" name="RoomImg">
			<div><button class="add-btn" type="submit" name="addBtn">Добавить комнату</button></div>
			<div class="error-text"><?=$_SESSION['addRoomError']?></div>
		</form>
	</div>
	<div>
		<form class="admin-form" method="post" action="php/delRoom.php">
			<?php
			$message = ''; 
			$host = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'grandeledb';
			$conn = new mysqli($host,$username,$password,$dbname);
 			$sql = "SELECT * FROM `room`";
			$result = $conn->query($sql);
			?>
			<h2>Удаление комнаты</h2>
			<select name="idRoom">
				<?php 
				while ($row = $result->fetch_assoc()) {
				?>
				<option  value="<?=$row['idRoom']?>"><?=$row['idRoom']?></option>
				<?php 
				}
			 	?>
			</select>
			<div><button class="add-btn" type="submit" name="delBtn">Удалить комнату</button></div>
			<div class="error-text"><?=$_SESSION['delRoom']?></div>
		</form>
	</div>
	</main>
<?php 
	require 'footer.php';
?>
</body>
</html>
