<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/constants.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/helpers/uploadFilesHelper.php');

$uploadPаth = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$expancions = ['.jpg', '.jpeg', '.png', '.gif'];
$expancionssStr = implode(', ', $expancions);


if ((count($_FILES['uploadImage']['name'])) > 5) {
	$total = 1;
	$message[0]['message'] = "Нельзя загрузить более 5 файлов!";			
	$message[0]['status'] = "error";
} else {
	$total = count($_FILES['uploadImage']['name']);
	for ($i=0; $i < $total ; $i++) { 
		if (!empty($_FILES['uploadImage']['error'][$i])) {
			$message = "Ошибка! (файл " . $_FILES['uploadImage']['name'][$i] . ")";
		} elseif ($_FILES['uploadImage']['size'][$i] <= MAX_FILE_SIZE) {
				if (uploadFilesHelper\checkFileType($expancions, $_FILES['uploadImage']['type'][$i])) {
					move_uploaded_file($_FILES['uploadImage']['tmp_name'][$i], $uploadPаth . $_FILES['uploadImage']['name'][$i]);
					$message[$i]['message'] = "Загрузка " . $_FILES['uploadImage']['name'][$i] . " выполнена успешно!";
					$message[$i]['status'] = 'ok';
				} else {
					$message[$i]['message'] = 'Daunskoe расширение!';
					$message[$i]['status'] = 'error';
			}
		} else {
			$message[$i]['message'] = "Размер загружаемого файла " . $_FILES['uploadImage']['name'][$i] . " свыше " . MAX_FILE_SIZE . " байт";
			$message[$i]['status'] = 'error';
		}
	}

}

$response['message'] = $message;
		
echo json_encode($response);