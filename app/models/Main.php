<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
	public function getArticles()
	{
		$result = $this->db->row('SELECT `id`, `content` FROM articles');
		return $result;
	}
}
