<?php
session_start();
$message = ''; 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'grandeledb';
if(!isset($_COOKIE['user'])){
	header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
}
$cook_arr = unserialize($_COOKIE['user']);
$login = $cook_arr['login'];
$pass = $cook_arr['pass'];
try {
	$conn = new mysqli($host,$username,$password,$dbname);
 	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	if(count($user)==0){
		setcookie('user', null, time() + -1, "/");
		header("Location: http://{$_SERVER['SERVER_NAME']}/authform.php");
	}
} catch (Exception $e) {
	$message = 'Ошибка запроса';
	$_SESSION['message'] = $message;
	header("Location: http://{$_SERVER['SERVER_NAME']}/personal_area.php");
}
  if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadfile']['tmp_name'];
    $fileName = $_FILES['uploadfile']['name'];
    $fileSize = $_FILES['uploadfile']['size'];
    $fileType = $_FILES['uploadfile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../img/userimg/';
      $dest_path = $uploadFileDir . $newFileName;
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message = $login;
        $sql = "UPDATE `users` SET `imgpath` = '$dest_path' WHERE `users`.`login` = '$login' ";
        $conn->query($sql);
        $cook_arr = serialize(array('login' => $login, 'name'=>$user['name'], 'pass' => $pass, 'imgpath' => $dest_path));
 		setcookie('user', $cook_arr, time() + 3600, "/");
      }
      else 
      {
        $message = 'Проблемы с перемещением файла';
      }
    }
    else
    {
      $message = 'Запрещенный тип файла ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'Возникли проблемы с загрузкой файла<br>';
    $message .= 'Ошибка:' . $_FILES['uploadedFile']['error'];
  }
  $conn = null;
$_SESSION['message'] = $message;
header("Location: http://{$_SERVER['SERVER_NAME']}/personal_area.php");