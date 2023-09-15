<?php

namespace app\lib;

class WebPack
{
	private $webpackPort;

	public function __construct()
	{

		$config =  $GLOBALS['webpackconfig'];
		$port = $config['devServer']['port'] ?? null;
		$this->webpackPort = $port ?: 9000;
	}

	public function isWebpackServerRunning($scriptPath)
	{

		$handle = curl_init("http://localhost:{$this->webpackPort}/{$scriptPath}");
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_NOBODY, true);

		curl_exec($handle);
		$error = curl_errno($handle);
		curl_close($handle);

		return !$error;
	}

	public function getScriptTag($scriptPath, $cssPath)
	{
		$isServerRunning = $this->isWebpackServerRunning($scriptPath);

		$scriptUrl = $isServerRunning ? "http://localhost:{$this->webpackPort}/{$scriptPath}" : $scriptPath;
		if ($isServerRunning) {
			return "<script src=\"http://localhost:{$this->webpackPort}/{$scriptPath}\"></script>";
		} else {
			return "<script src=\"$scriptUrl\"></script><link rel=\"stylesheet\" href=\"$cssPath\">";
		}
	}
}
