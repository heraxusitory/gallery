<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/handlers/handler.php');
echo "<pre>";
var_dump($_POST);
var_dump($_FILES);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Image</title>
	<link rel="stylesheet" type="text/css" href="/styles/main.css">
	<link rel="stylesheet" type="text/css" href="/styles/tools.css">
	<link rel="stylesheet" type="text/css" href="/styles/form.css">
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
				<form method="POST" action="/form.php" enctype="multipart/form-data">
					<div class="btn-panel">
						<label class="borderer-card b_r-15 b_white" for="upload">
							<span class="white-text lg-text">Choose File</span>
						</label>
						<input required="true" type="file" name="uploadImage[]" hidden="true" id="upload" multiple="multiple" accept=".jpg; .jpeg; .png; .gif">
					</div>
					<div class="btn-panel">
						<button type="submit" name="submit" class="borderer-card b_r-15 b_white">
							<span class="white-text lg-text">Download</span>
						</button>
					</div>
					<div><span><?php for ($i=0; $i < $total; $i++):
										echo "$message[$i]</br>";
					 				endfor;?> </span></div>
				</form>
			</section>
		</div>
	</main>

</body>
</html>