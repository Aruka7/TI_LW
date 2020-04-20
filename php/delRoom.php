<?php  
session_start();
$message = ''; 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';

$_SESSION['delRoom'] = null;

$idRoom = $_POST['idRoom'];
if($idRoom==null) exit();
$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "DELETE FROM `room` WHERE `idRoom` = '$idRoom'";
	$result = $conn->query($sql);
$_SESSION['delRoom'] = "Комната успешно удалена";
header("Location: http://{$_SERVER['SERVER_NAME']}/Admin_panel.php");
exit();
?>