<?php 
function ConvertDate($date){
	$newDate = $date[6].$date[7].$date[8].$date[9].'-'.$date[3].$date[4].'-'.$date[0].$date[1];
	return $newDate;
}
 ?>
