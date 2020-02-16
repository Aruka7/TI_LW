<?php 
session_start();
$type = $_POST['type'];
$lastDate = $_POST['lastDate'];
$firstDate = $_POST['firstDate'];
$firstCost = $_POST['firstCost'];
$lastCost = $_POST['lastCost'];
$countPeople = $_POST['countPeople'];

$_SESSION['filter']['type'] = $type;
$_SESSION['filter']['lastDate'] = $lastDate;
$_SESSION['filter']['firstDate'] = $firstDate;
$_SESSION['filter']['firstCost'] = $firstCost;
$_SESSION['filter']['lastCost'] = $lastCost;
$_SESSION['filter']['countPeople'] = $countPeople;
header("Location: http://{$_SERVER['SERVER_NAME']}/rooms.php");
?>