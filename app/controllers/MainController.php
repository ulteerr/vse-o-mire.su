<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller
{
	public function index()
	{
		$data = $this->model->getArticles();
		$vars = [
			'articles' => $data,
		];
		$this->view->render('Главная страница', $vars);
	}
}
