<?php
$globals_vars = config('globals_vars');
foreach ($globals_vars as $key => $vars) {
	$GLOBALS[$key] = $vars;
}
$jsonConfig =  base_path() . '/webpack/webpack.config.json';
$port = null;

if (file_exists($jsonConfig)) {
	$config = file_get_contents($jsonConfig);
	$GLOBALS['webpackconfig'] = json_decode($config, true);
}
