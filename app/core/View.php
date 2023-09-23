<?php

namespace app\core;

use app\lib\common\WebPack;

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
			$script = $this->getWebPack();
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
			$script = $this->getWebPack();
			require $this->base_layout;
		}
		exit;
	}

	public function getWebPack()
	{
		$webPack = new WebPack();

		$script = $webPack->getScriptTag($GLOBALS['webpackconfig']['output']['filename'], $GLOBALS['webpackconfig']['plugins']['MiniCssExtractPlugin']['filename']);

		return $script;
	}
}
