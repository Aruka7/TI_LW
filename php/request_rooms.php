<?php 
require 'convertDate.php';
if ($_SESSION['filter']['type']==null) {
	$_SESSION['filter']['type'] = '%';
}
if($_SESSION['filter']['firstCost']==null){
	$_SESSION['filter']['firstCost'] = 0;
}
if ($_SESSION['filter']['lastCost']==null) {
	$_SESSION['filter']['lastCost'] = 9999999;
}
if ($_SESSION['filter']['firstDate']==null) {
	$firstDate = '2001-01-01';
}
else{
	$firstDate = $_SESSION['filter']['firstDate'];
}
if ($_SESSION['filter']['lastDate']==null) {
	$lastDate = '2001-01-01';
}
else{
	$lastDate = $_SESSION['filter']['lastDate'];
}
if ($_SESSION['filter']['countPeople']==null) {
	$_SESSION['filter']['countPeople'] = 1;
}
$type = $_SESSION['filter']['type'];
$firstCost = $_SESSION['filter']['firstCost'];
$lastCost = $_SESSION['filter']['lastCost'];
$countPeople = $_SESSION['filter']['countPeople'];
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
$countPeople = $countPeople-1;
try {
 	$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "SELECT * 
			FROM `room` 
			WHERE `idRoom` NOT IN
				(SELECT `room`.`idRoom`
 				 FROM `room`, `reservation`
 				 WHERE `room`.`idRoom` = `reservation`.`idRoom` AND (('$firstDate'>=`reservation`.`arrivalDate`AND'$firstDate'<`reservation`.`departureDate`)OR
 				 ('$lastDate'>`reservation`.`arrivalDate`AND'$lastDate'<=`reservation`.`departureDate`)OR
				 ('$firstDate'<=`reservation`.`arrivalDate`AND'$lastDate'>=`reservation`.`departureDate`)))
				 AND (`dayCost` > '$firstCost' AND `dayCost`< '$lastCost')
				 AND (`size`>= '$countPeople' )
				 AND (`type` LIKE '$type');";
	$result = $conn->query($sql);
	}
	catch(Exception $e){
		echo "Ошибка";
		exit();
	}
	$i = 0;
	$rooms_array;
	while ($row = $result->fetch_assoc()) {
        $rooms_array[$i]=$row;
        $i++;
    }
 ?>