<?php 
session_start();
$passport = (trim($_POST['passport']));
$name = (trim($_POST['name']));
$surname = (trim($_POST['surname']));
$gender = $_POST['gender'];
$birthDate = $_POST['birthDate'];
$arrivalDate = $_POST['arrivalDate'];
$departureDate = $_POST['departureDate'];
$idRoom = $_POST['idRoom'];
$_SESSION['bookfields']['passport'] = $passport;
$_SESSION['bookfields']['name'] = $name;
$_SESSION['bookfields']['surname'] = $surname;
$_SESSION['bookfields']['birthDate'] = $birthDate;
$_SESSION['bookfields']['arrivalDate'] = $arrivalDate;
$_SESSION['bookfields']['departureDate'] = $departureDate;
$_SESSION['bookerrors'] = "";

$flag = false;

if (mb_strlen($passport)<7||mb_strlen($passport)>20) {
	$_SESSION['bookerrors'] = "некорректное заполнение полей";
	$flag = true;
}
if (mb_strlen($name)<3||mb_strlen($name)>30) {
	$_SESSION['bookerrors'] = "некорректное заполнение полей";
	$flag = true;
}
if (mb_strlen($surname)<3||mb_strlen($surname)>30) {
	$_SESSION['bookerrors'] = "некорректное заполнение полей";
	$flag = true;
}
if ($birthDate==null||$arrivalDate==null||$departureDate==null) {
	$_SESSION['bookerrors'] = "некорректное заполнение полей";
	$flag = true;
}
if($flag){
	header("Location: http://{$_SERVER['SERVER_NAME']}/book.php");
	exit();
}
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
try {
	$conn = new mysqli($host,$username,$password,$dbname);
	if ($conn->connect_errno) {
   		printf("Соединение не удалось: %s\n", $conn->connect_error);
    	exit();
	}
	$sql = "SELECT * FROM `client` WHERE `passport` = '$passport' ";
	$result = $conn->query($sql);
	$client = $result->fetch_assoc();
	if (count($client)==0) {
		$sql = "INSERT INTO `client` (surname,name,passport,birthDate,Sex) VALUES ('$surname','$name','$passport','$birthDate','$gender')";
 		$conn->query($sql);
	}
	$sql = "SELECT * FROM `room` WHERE `idRoom` = '$idRoom'";
	$result = $conn->query($sql);
	$room = $result->fetch_assoc();
	$cost = $room['dayCost'];
	
	$sql = "SELECT * FROM `client` WHERE `passport` = '$passport'";
	$result = $conn->query($sql);
	$client = $result->fetch_assoc();
	$idClient = $client['idClient'];
	$result->free();
	//todo: проверить свободна ли комната

	$sql = "INSERT INTO `reservation` (`arrivalDate`,`departureDay`,`totCost`,`idClient`,`idRoom`) VALUES ('$arrivalDate','$departureDate',(TO_DAYS('$departureDate') - TO_DAYS('$arrivalDate'))*'$cost','$idClient','$idRoom')";
 	$conn->query($sql);
 	$conn->close();
 	$_SESSION['bookerrors'] = "Успешно";
 	header("Location: http://{$_SERVER['SERVER_NAME']}/book.php");
} catch (Exception $e) {
	$_SESSION['bookerrors'] = "Ошибка запроса данных";
	exit();
}