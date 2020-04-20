<?php 
if ($_SESSION['currentUser']==null) {
	$_SESSION['currentUser'] = 1;

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';

$conn = new mysqli($host,$username,$password,$dbname);
	if ($conn->connect_errno) {
   		printf("Соединение не удалось: %s\n", $conn->connect_error);
    	exit();
	}
	$sql = "UPDATE `statistics`
			SET `Number`= `Number`+1
			WHERE `CounterName`='CountVisits'";
	$result = $conn->query($sql);
}
 ?>