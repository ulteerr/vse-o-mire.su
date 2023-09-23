<?php

namespace app\controllers;

use app\core\Controller;


class MainController extends Controller
{
	public function index()
	{
		$data = $this->model->getArticles();
		$vars = [
			'articles' => $data,
		];
		$client = new \GuzzleHttp\Client();
			$start = microtime(true);
			$response = $client->get('http://vse-o-mire.su/articles/nqmdn9pfoqat-last-the-mock-turtlei9oevp8v6m');
			$end = microtime(true);
			$loadTime = $end - $start;
			var_dump("Время загрузки страницы страницы: " . number_format($loadTime, 2) . " секунды\n");
		$this->view->render('Главная страница', $vars);
	}
}
