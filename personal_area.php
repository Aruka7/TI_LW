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
</head>
<body>
	<?php 
	require 'header.php';
	$cook_arr = unserialize($_COOKIE['user']);
	 ?>
	<main>
		<div class="content-personal">
			<div class="personal-avatar">
				<img  src="<?=$cook_arr['imgpath']?>" alt="img">
				<form enctype="multipart/form-data" method="post" action="php/upload.php">
					<input type="hidden" name="max_size" value="30000" />
					<div class="wrap"><input type="file" name="uploadfile"></div>
					<button type="submit" name="uploadbtn">Загрузить</button>
					<div><?=$_SESSION['message']?></div>
				</form>
			</div>
			<div class="personal-inf">
				<form class="сhange-inf" method="post" action="php/change_name.php">
					<h2>Имя</h2>
					<div><input type="text" name="name"></div>
					<button type="submit">Изменить</button>
				</form>
				<form class="сhange-inf" action="php/change_pass.php">
					<h2>Пароль</h2>
					<div>Старый</div><input type="text" name="oldpass">
					<div>Новый</div><div><input type="text" name="newpass"></div>
					<button type="submit" >Изменить</button>
				</form>
			</div>
		</div>
	</main>
<?php 
	require 'footer.php';
?>
</body>
</html>