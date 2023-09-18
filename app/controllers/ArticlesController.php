<?php

namespace app\controllers;

use app\core\Controller;


class ArticlesController extends Controller
{
	public function index()
	{
		$count = $this->model->count();
		$recordsPerPage = 21;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;

		if (!empty($count)) {
			$totalPages = ceil($count / $recordsPerPage);
			$offset = ($page - 1) * $recordsPerPage;
			$articles = $this->model->get($offset, $recordsPerPage);
		}

		$vars = [
			'articles' => $articles ?? [],
			'totalPages' => $totalPages ?? null,
		];
		$this->view->render('Страница статей', $vars);
	}
	public function show($slug)
	{
		$article = $this->model->slug($slug);
		dd($article);
	}
}
