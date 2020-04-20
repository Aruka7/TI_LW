<?php
session_start();
$login = (trim($_POST['login']));
$pass = (trim($_POST['pass']));
$_SESSION['regfields']['login'] = $login;
$_SESSION['regerrors'][0] = "";

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
try {
 	$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	if(count($user)== 0){
		$_SESSION['regerrors'][0] = "Неверное имя пользователя или пароль";
		header("Location: http://{$_SERVER['SERVER_NAME']}/regform.php");
		exit();
	}
		$cook_arr = serialize(array('login' => $login, 'name'=>$user['name'], 'pass' => $pass, 'imgpath' => $user['imgpath']));
 		setcookie('user', $cook_arr, time() + 3600, "/");
 		$conn = null;
 		header("Location: http://{$_SERVER['SERVER_NAME']}/index.php");
 	}
 		catch (Exception $e) {
 		echo "Ошибка";
 		exit(); 
 	} 
?>