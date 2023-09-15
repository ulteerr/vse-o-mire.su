<?php
$directory = __DIR__ . '/function/';

foreach (scandir($directory) as $filename) {
	$filePath = $directory . '/' . $filename;

	if (is_file($filePath) && pathinfo($filename, PATHINFO_EXTENSION) === 'php') {
		require_once $filePath;
	}
}

require base_path() . '/vendor/autoload.php';
require 'env.php';

if ($_ENV['APP_DEBUG']) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}

set_error_handler('errorHandler');

require 'global_vars.php';
