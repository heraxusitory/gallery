<?php

namespace uploadFilesHelper;

function checkFileType (array $filetypes, string $checkedFileType) {
	$file = 'image';
	foreach ($filetypes as $expansion) {
		$expReplace = preg_replace('/\./', '/', $expansion);
		$fileType = $file . $expReplace;
		if ($fileType == $checkedFileType) {
			return true;
		}
	}
	return false;
}

function getFileType ($nameOfImages) {
	$arr = explode('.', $nameOfImages);
	$count = count($arr);
	$result = '';
	$result = $arr[$count - 1];
	return '.' . $result;
}

function getFileSize ($nameOfImage) {
	$fileSize = filesize($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $nameOfImage);
	$result = '';
	if ($fileSize <= 1024) {
		$result = $fileSize . ' b';
	}
	elseif (($fileSize > 1024) && ($fileSize <= 1*1024*1024)) {
		$size = round($fileSize / 1024); 
		$result = $size . " Kb";
	}
	elseif (($fileSize > 1*1024*1024) && ($fileSize <= 5*1024*1024)) {
		$size = round($fileSize / (1024 * 1024)); 
		$result = $size . " Mb";
	} else {
		$size = round($fileSize / (1024 * 1024)); 
		$result = $size . " Mb";
	}
	return $result;

}

function getFileDate($nameOfImage) {
	$path = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $nameOfImage;
	return date("d M Y H:i", filectime($path));

}

// function sortArr($arr) {
// rsort($arr);
// 	return $arr;
// }
