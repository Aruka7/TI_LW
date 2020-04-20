<?php
session_start();
$_SESSION['addRoomError'] = null;

$idRoom = $_POST['idRoom'];
$size = $_POST['size'];
$type = $_POST['type'];
$dayCost = $_POST['dayCost'];
$max_size = $_POST['max_size'];

$flag = false;

if (mb_strlen($idRoom)<1||mb_strlen($idRoom)>99999||!is_numeric($idRoom)) {
	$flag = true;}
if (mb_strlen($size)<1||mb_strlen($size)>20||!is_numeric($size)) {
	$flag = true;
}
if (mb_strlen($dayCost)<1||mb_strlen($dayCost)>10||!is_numeric($dayCost)) {
	$flag = true;
}
if($flag){
	$_SESSION['addRoomError'] = "Некорректное заполнение полей";
	header("Location: http://{$_SERVER['SERVER_NAME']}/Admin_panel.php");
	exit();
}

$message = ''; 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
if(!isset($_COOKIE['user'])){
	header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
	exit();
}
try {
	$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "SELECT * FROM `room` WHERE `idRoom` = '$idRoom'";
	$result = $conn->query($sql);
	$room = $result->fetch_assoc();
	if(count($room)!=0){
		$_SESSION['addRoomError'] = "Комната с таким номером уже существует";
		header("Location: http://{$_SERVER['SERVER_NAME']}/Admin_panel.php");
		exit();
	}
	$dest_path = null;
	$message = null;
	$status = true;
	  if (isset($_FILES['RoomImg']) && $_FILES['RoomImg']['error'] === UPLOAD_ERR_OK)
 		 {
   		 $fileTmpPath = $_FILES['RoomImg']['tmp_name'];
   		 $fileName = $_FILES['RoomImg']['name'];
   		 $fileSize = $_FILES['RoomImg']['size'];
   		 $fileType = $_FILES['RoomImg']['type'];
   		 $fileNameCmps = explode(".", $fileName);
   		 $fileExtension = strtolower(end($fileNameCmps));
   		 $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
   		 $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
   		 if (in_array($fileExtension, $allowedfileExtensions))
    		{
     		 $uploadFileDir = '../img/rooms/';
     		 $dest_path = $uploadFileDir . $newFileName;
     		 if(!move_uploaded_file($fileTmpPath, $dest_path))
     		 {
        		 $message = 'Проблемы с перемещением файла';
        		 $status = false;
    		}
    	}
    else
    {
      $message = 'Запрещенный тип файла ' . implode(',', $allowedfileExtensions);
      $status = false;
    }
  }
  else
  {
    $message = 'Возникли проблемы с загрузкой файла<br>';
    $message .= 'Ошибка:' . $_FILES['RoomImg']['error'];
    $status = false;
  }
  if(!$status){
  	$_SESSION['addRoomError'] = $message;
	header("Location: http://{$_SERVER['SERVER_NAME']}/Admin_panel.php");
	exit();
  }
	$sql = "INSERT INTO `room` (`idRoom`, `size`, `type`, `dayCost`, `path`, `Description`) 
			VALUES ('$idRoom', '$size', '$type', '$dayCost', '$dest_path', NULL)";
	$result = $conn->query($sql);
	$message = "Успешная операция";
	$_SESSION['addRoomError'] = $message;
	header("Location: http://{$_SERVER['SERVER_NAME']}/Admin_panel.php");
	exit();
	}
	catch(Exception $e){
		echo "Неизвестная ошибка";
		exit();
	}
?>