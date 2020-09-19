<?php

$uploadPаth = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$expancions = ['.jpg', '.jpeg', '.png', '.gif'];
$expancionssStr = implode(', ', $expancions);
echo "<pre>";
var_dump($_FILES['uploadImage']['type']);
echo "</pre>";

if (isset($_POST['submit'])) {
	$total = count($_FILES['uploadImage']['name']);
	for ($i=0; $i < $total ; $i++) { 
		if (!empty($_FILES['uploadImage']['error'][$i])) {
			$message = "Ошибка! (файл " . $_FILES['uploadImage']['name'][$i] . ")";
		} elseif ($_FILES['uploadImage']['size'][$i] <= MAX_FILE_SIZE) {
			foreach ($expancions as $exp) {
				if (uploadFilesHelper\checkFileType($expancions, $_FILES['uploadImage']['type'][$i])) {
					move_uploaded_file($_FILES['uploadImage']['tmp_name'][$i], $uploadPаth . $_FILES['uploadImage']['name'][$i]);
					$message[] = "Загрузка " . $_FILES['uploadImage']['name'][$i] . " выполнена успешно!";
				} else {
					$message[] = 'Daunskoe расширение!';
				}
			}
		} else {
			$message[] = "Размер загружаемого файла " . $_FILES['uploadImage']['name'][$i] . " свыше " . MAX_FILE_SIZE . " байт";
		}
	}	
	
}