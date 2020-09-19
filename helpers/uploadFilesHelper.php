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