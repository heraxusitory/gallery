<?php

$uploadPаth = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$expancions = ['.jpg', '.jpeg', '.png', '.gif'];
$expancionssStr = implode(', ', $expancions);
echo "<pre>";
var_dump($_FILES['uploadImage']['name']);
echo "</pre>";

if (isset($_POST['submit'])) {
	if ((count($_FILES['uploadImage']['name'])) > 5) {
		$total = 1;
		$message[] = "Нельзя загрузить более 5 файлов!";			
	} else {
		$total = count($_FILES['uploadImage']['name']);
		for ($i=0; $i < $total ; $i++) { 
			if (!empty($_FILES['uploadImage']['error'][$i])) {
				$message = "Ошибка! (файл " . $_FILES['uploadImage']['name'][$i] . ")";
			} elseif ($_FILES['uploadImage']['size'][$i] <= MAX_FILE_SIZE) {
					if (uploadFilesHelper\checkFileType($expancions, $_FILES['uploadImage']['type'][$i])) {
						move_uploaded_file($_FILES['uploadImage']['tmp_name'][$i], $uploadPаth . $_FILES['uploadImage']['name'][$i]);
						$message[] = "Загрузка " . $_FILES['uploadImage']['name'][$i] . " выполнена успешно!";
					} else {
						$message[] = 'Daunskoe расширение!';
				}
			} else {
				$message[] = "Размер загружаемого файла " . $_FILES['uploadImage']['name'][$i] . " свыше " . MAX_FILE_SIZE . " байт";
			}
		}

	}
		
	
}

if (isset($_POST['delete_images'])) {
	if (count($_POST) > 1) {
		$path = '/upload/';
		$nameOfImages = imagesHelpers\getImageArr($path);
		var_dump($nameOfImages);
		foreach ($_POST as $keyOfCheckbox => $checkbox) {
			if (!empty($nameOfImages[$keyOfCheckbox])) {
				$unsetCheckboxes[] = $uploadPаth . $nameOfImages[$keyOfCheckbox];
			}	
		}
		var_dump($unsetCheckboxes);
		foreach ($unsetCheckboxes as $unsetCheckbox) {
			unlink($unsetCheckbox);
		}
	}
	
}
	
	// unset($_POST[$keyOfCheckbox]);
	// 				array_values($_POST);
	// 				unlink($uploadPаth . $nameOfImage);