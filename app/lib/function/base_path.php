<?php
function base_path($path = '')
{
	
	$basePath = realpath($_SERVER['DOCUMENT_ROOT']);
	$basePath = str_replace('/public', '', $basePath);
	if (!empty($path)) {
		$basePath .= '/' . ltrim($path, '/');
	}
	return $basePath;
}
