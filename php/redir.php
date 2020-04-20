<?php 
session_start();

$_SESSION['filter']['firstDate'] = $_GET['firstDate'];
$_SESSION['filter']['lastDate'] = $_GET['lastDate'];
$_SESSION['filter']['countPeople']  = $_GET['size'];
header("Location: http://{$_SERVER['SERVER_NAME']}/rooms.php");
 ?>