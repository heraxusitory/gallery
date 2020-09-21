<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/constants.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/helpers/uploadFilesHelper.php');
// echo "<pre>";
// var_dump($_POST);
// var_dump($_FILES);
// echo "</pre>";
// var_dump($message);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Image</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/styles/main.css">
	<link rel="stylesheet" type="text/css" href="/styles/tools.css">
	<link rel="stylesheet" type="text/css" href="/styles/form.css">
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
</head>
<body>
	<header class="main-header main-bg-img">
		<h1 class="main-title white-text"><span class="main-title_borderer">Gallery</span></h1>
	</header>
	<main>
		<div class="main-content">
			<section class="content">
				<div class="link-back">
					<a href="/" class="btn-standart b_r-15 b_white">
						<span class="white-text mid-text">&#8617;</span> 
						<span class="white-text mid-text">Back</span>
					</a>
				</div>
				<form method="POST" action="/handlers/upload.php" enctype="multipart/form-data" id="uploadForm">
					<div class="btn-panel">
						<label class="borderer-card b_r-15 b_white" for="upload">
							<span class="white-text lg-text">Choose File</span>
						</label>
						<input required="true" type="file" name="uploadImage[]" hidden="true" id="upload" multiple="multiple" accept="<?=$expancionssStr?>">
					</div>
					<div id="fileList"></div>
					<div class="btn-panel">
						<button type="submit" name="submit" class="borderer-card b_r-15 b_white">
							<span class="white-text lg-text">Download</span>
						</button>
					</div>
					<div id="result">
						
					</div>
				</form>
			</section>
		</div>
	</main>
	<script type="text/javascript">
		$(document).ready(function() {
			// Получаем форму через jquery
			console.log($('#uploadForm'));
			// Получаем форму через DOM
			console.log(document.getElementById('uploadForm'));

			let inputFile = $('#upload');

			inputFile.on('change', function () {
				let files = this.files;
				console.log(files);
				let filesContainer = $('#fileList');
				filesContainer.text('');
				for (let key in files) {
					if (files[key].name && files[key].size) {
						filesContainer.prepend(`<div class="file">${files[key].name}</div>`);
					}	
				}
			});

			// 1. Получаем форму через jquery
			let $form = $('#uploadForm');

			// 2. Инициализируем обработчик события (событие submit - т.е. отправка формы)
			$form.on('submit', uploadImages);

			// 3. Пишем функцию для обработчика события
			function uploadImages() {
				//Дополнительно получаем форму не объектом jquery
				let thisForm = document.getElementById('uploadForm');
				let formData = new FormData(thisForm); // Собираем данные из формы

				// Сам AJAX - запрос
				$.ajax({
					url: 'handlers/upload.php', //url - хандлера
					type: 'POST', //метод отправки запроса
		            contentType: false, // Необходимы при отправке изображения
		            processData: false, // Необходимы при отправке изображения
					data: formData,
					dataType: 'json', //Указываем данные, которые отправляем запросом (В данном случае этот метод не принимает объект jquery, поэтому нам нужен объект DOM)

					success: function(data) { //функция при успешной отправке
						data.message.forEach(function(item) {
						  	if (item.status === 'ok') {
						  		$('#result').prepend(`<div class="success">${item.message}</div>`);
						  	}
						  	if (item.status === 'error') {
							  	$('#result').prepend(`<div class="error">${item.message}</div>`);	
						  	}
						});
						
					},
					error: function(error) { //функция при ошибке
						console.log(error);
					},
					complete: function() {
						inputFile.val('');
					}
				});

				// Чтобы странница не перезагружалась
				return false;
			}
		});
	</script>
</body>
</html>