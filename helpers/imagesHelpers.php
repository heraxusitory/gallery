<?php

namespace imagesHelpers;

function getImageArr($dir) {
	$nameOfImages = scandir($_SERVER['DOCUMENT_ROOT'] . $dir);
	return $nameOfImages;
}