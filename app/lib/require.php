<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$directory = __DIR__ . '/function/';

foreach (scandir($directory) as $filename) {
	$filePath = $directory . '/' . $filename;

	if (is_file($filePath) && pathinfo($filename, PATHINFO_EXTENSION) === 'php') {
		require_once $filePath;
	}
}

require base_path() . '/vendor/autoload.php';
require 'env.php';
require 'global_vars.php';
