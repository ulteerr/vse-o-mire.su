<?php

namespace app\lib\common;

class Log
{
	private static $channels = [];
	private static $config;

	private $channelName;

	private function __construct($channelName)
	{
		$this->channelName = $channelName;
	}

	public static function channel($channelName)
	{
		if (!isset(self::$channels[$channelName])) {
			self::$channels[$channelName] = new self($channelName);
		}

		return self::$channels[$channelName];
	}


	public function info($message)
	{
		$this->log('info', $message);
	}

	public function error($message)
	{
		$this->log('error', $message);
	}

	private function log($level, $message)
	{
		$logPath = $this->getLogPath();
		$logMessage = "[$level] $message";
		$logFile = base_path() . '/' . $logPath;
		$logDirectory = dirname($logFile);

		if (!is_dir($logDirectory)) {
			mkdir($logDirectory, 0755, true);
		}
		if (!file_exists($logFile)) {
			touch($logFile);
		}
		$file = fopen($logFile, 'a');

		if ($file) {
			fwrite($file, $logMessage . PHP_EOL);
			fclose($file);
		} else {
			error_log("Failed to open log file: $logFile");
		}
	}

	private function getLogPath()
	{
		self::$config = config('log');

		if (isset(self::$config[$this->channelName])) {
			return self::$config[$this->channelName]['path'];
		} else {
			return self::$config['default']['path'];
		}
	}
}
