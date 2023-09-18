<?php

namespace app\models;

use app\core\Model;

class Articles extends Model
{
	public function count()
	{
		$count = $this->db->row('SELECT COUNT(*) AS total FROM `articles`');
		$count = current($count);
		$totalRecords = $count['total'] ?? null;
		return $totalRecords;
	}
	public function get($offset, $recordsPerPage)
	{
		$result = $this->db->row("SELECT * FROM `articles` LIMIT $offset, $recordsPerPage");
		return $result;
	}

	public function slug($slug)
	{
		$result = $this->db->row("SELECT *  FROM `articles` WHERE `slug` = `$slug`;");
		return $result;
	}
}
