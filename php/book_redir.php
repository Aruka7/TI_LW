<?php
session_start();
$_SESSION['bookType'] = $_GET['type'];
$_SESSION['bookSize'] = $_GET['size'];
$_SESSION['bookIdRoom'] = $_GET['idRoom'];
$_SESSION['bookDayCost'] = $_GET['dayCost'];
 header("Location: http://{$_SERVER['SERVER_NAME']}/book.php");
 ?>