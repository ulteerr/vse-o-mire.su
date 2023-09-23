<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\common\RedisHelper;

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
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 2;
		$perPage = 10;
		$offset = max(($page - 1) * $perPage, 0);
		$offset = ($page - 1) * $perPage;

		$redis_key = "articles_slug_{$slug}";
		$redisHelper = new RedisHelper();

		if ($redisHelper->exists($redis_key)) {
			$data = unserialize($redisHelper->get($redis_key));
		} else {
			$article = $this->model->where([
				'slug' => ['operator' => '=', 'value' => $slug,],
			]);
			if ($article) {
				$comments = $article['comments'];
				foreach ($comments as &$comment) {
					$comment['replies'] = array_slice($comment['replies'], 0, 10);
				}
				unset($comment);
				unset($article['comments']);

				$data['article'] = $article;
				$data['comments'] = $comments;
				$redisHelper->set($redis_key, serialize($data));
			} else {
				$this->view->errorCode('404');
			}
		}
		if (!empty($data)) {
			$data['comments'] = array_slice($data['comments'], $offset, $perPage);
			$this->view->render('Страница статьи', $data);
		} else {
			$this->view->errorCode('404');
		}
	}
}
