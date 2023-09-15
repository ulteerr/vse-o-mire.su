<?php

namespace app\core;

use app\lib\WebPack;

class View
{
	public $path;
	public $route;
	public $layout = 'default';
	public $base_layout;

	public function __construct($route = false)
	{
		if ($route) {
			$this->route = $route;
			$this->path = $route['controller'] . '/' . $route['action'];
		}

		$this->base_layout = base_path() . '/app/views/layouts/' .  $this->layout . '.php';
	}

	public function render($title, $vars = [])
	{
		extract($vars);
		$path = base_path() . '/app/views/' . $this->path . '.php';

		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			$webPack = new WebPack();

			$jsonConfig =  base_path() . '/webpack/webpack.config.json';
			if (file_exists($jsonConfig)) {
				$config = file_get_contents($jsonConfig);
				$config = json_decode($config, true);
				$port = $config['devServer']['port'] ?? null;
			}
			$script = $webPack->getScriptTag($GLOBALS['webpackconfig']['output']['filename'], $GLOBALS['webpackconfig']['plugins']['MiniCssExtractPlugin']['filename']);
			require $this->base_layout;
		}
	}

	public function redirect($url)
	{
		header('location:' . $url);
		exit;
	}
	public function errorCode($code)
	{
		http_response_code($code);
		$path = base_path() . '/app/views/errors/' . $code . '.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require $this->base_layout;
		}
		exit;
	}
}
