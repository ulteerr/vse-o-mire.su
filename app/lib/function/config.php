<?php
function config($configName)
{
	$configPath = base_path() . '/app/config/';
	$configParts = explode('.', $configName);
	$file = $configPath;
	foreach ($configParts as $part) {
		$configFile = $file . $part . '.php';
		if (file_exists($configFile)) {
			$configData = include $configFile;
			if (strpos($configName, '.') !== false) {
				foreach ($configParts as $partFiles) {
					if (isset($configData[$partFiles])) {
						$configData = $configData[$partFiles];
					}
				}
			}
			return $configData;
		} else {
			$file .= $part . '/';
		}
	}
}
