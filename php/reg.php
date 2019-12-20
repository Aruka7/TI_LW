<?php
session_start();
$login = (trim($_POST['login']));
$name = (trim($_POST['name']));
$pass = (trim($_POST['pass']));
$_SESSION['regfields']['login'] = $login;
$_SESSION['regfields']['name'] = $name;
$_SESSION['regfields']['pass'] = $pass;
$_SESSION['regerrors'][0] = "";
$_SESSION['regerrors'][1] = "";
$_SESSION['regerrors'][2] = "";
$flag = false;
if (mb_strlen($login)<5||mb_strlen($login)>40) {
	$_SESSION['regerrors'][0] = "Некорректная длина логина";
	$flag = true;
}
if (mb_strlen($name)<3||mb_strlen($name)>40) {
	$_SESSION['regerrors'][1] = "Некорректная длина имени";
	$flag = true;
}
if (mb_strlen($pass)<5||mb_strlen($pass)>40) {
	$_SESSION['regerrors'][2] = "Некорректная длина пароля";
}
if($flag){
	header("Location: http://{$_SERVER['SERVER_NAME']}/regform.php");
	exit();
}
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
try {
 	$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "SELECT * FROM `users` WHERE `login` = '$login' ";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	if(count($user)!= 0){
		$_SESSION['regerrors'][0] = "Данный пользователь уже существует";
		header("Location: http://{$_SERVER['SERVER_NAME']}/regform.php");
		exit();
	}
	$sql = "INSERT INTO users (login,name,password) VALUES ('$login','$name','$pass')";
 	$conn->query($sql);
 }
 catch (Exception $e) {
 	echo "Ошибка подключения";
 	exit(); 
 } 
 $cook_arr = serialize(array('login' => $login, 'name'=>$name, 'pass' => $pass, 'imgpath' => "img/userimg/common.jpg"));
 setcookie('user', $cook_arr, time() + 3600, "/");
 header("Location: http://{$_SERVER['SERVER_NAME']}/index.php");
 $conn = null;
?>