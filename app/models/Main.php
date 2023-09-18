<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
	public function getArticles()
	{
		$result = $this->db->row('SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 6');
		return $result;
	}
}
