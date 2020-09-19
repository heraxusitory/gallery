<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/constants.php');
$uploadPаth = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$expancion = ['image/jpeg', 'image/jpg', 'image/png'];
var_dump($error);
if (isset($_POST['submit'])) {
	$total = count($_FILES['uploadImage']['name']);
	var_dump($total);
	for ($i=0; $i < $total ; $i++) { 
		if (!empty($_FILES['uploadImage']['error'][$i])) {
		$message = "Ошибка!";
		break;
	}
		elseif ($_FILES['uploadImage']['size'][$i] <= SIZE_OF_IMAGES) {
		move_uploaded_file($_FILES['uploadImage']['tmp_name'][$i], $uploadPаth . $_FILES['uploadImage']['name'][$i]);
		$message = "Загрузка выполнена успешно!";
	} else {
		$message[] = "Размер загружаемого файла" . $_FILES['uploadImage']['name'][$i] . " свыше " . SIZE_OF_IMAGES . " байт";
		}
	}
	
}


// if (isset($_POST[])) {
// 	# code...
// }