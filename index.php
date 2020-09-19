<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/helpers/uploadFilesHelper.php');
$nameOfImages = scandir(($_SERVER['DOCUMENT_ROOT'] . '/upload/'));

var_dump($nameOfImages);
require ($_SERVER['DOCUMENT_ROOT'] . '/constants.php');
echo "<pre>";
var_dump($_POST);
var_dump($_FILES);
var_dump($error);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/styles/main.css">
	<link rel="stylesheet" type="text/css" href="/styles/tools.css">
</head>
<body>
	<header class="main-header main-bg-img">
		<h1 class="main-title white-text"><span class="main-title_borderer">Gallery</span></h1>
	</header>
	<main>
		
		<div class="main-content">
			<section class="content">
				<div class="btn-panel">
					<form action="/form.php" method="POST">
						<button class="borderer-card b_r-15 b_white">
							<span class="white-text lg-text">Add <span>&#10010;</span></span>
						</button>
					</form>
				</div>
				<form method="POST" action="/">
					<div class="btn-panel">
						<button class="borderer-card b_r-15 b_white" name="delete_images">
							<span class="white-text lg-text">Delete <span>&#10006;</span></span>
						</button>
					</div>
					<div class="card-list">

						<?php foreach ($nameOfImages as $nameOfImage): ?>
							<?php 
							if ($nameOfImage === '.' || $nameOfImage === '..') {
								continue;
							}
							else {?>
								<div class="card bg-white">
									<div class="card-content">
										<div class="image-container">
											<img src="/upload/<?=$nameOfImage?>" alt="">
										</div>
										<div class="image-desc">
											<div>Name: <b><?=$nameOfImage?></b></div>
											<div>Size: <b><?=filesize($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $nameOfImage)?></b></div>
											<div>Expansion: <b><?=uploadFilesHelper\getFileType($nameOfImage)?></b></div>
											<div class="card_date">
												<div><i>01 January 2020</i></div>
											</div>
											<div class="choose_chbx-label bg-white border_custom_chbx">
												<label>
													<input type="checkbox" name="test" class="choose_chbx">
													Choose
												</label>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						<?php endforeach;?>
					</div>
				</form>		

			</section>
		</div>
	</main>
	<footer>
	</footer>

</body>
</html>