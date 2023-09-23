<?php

namespace app\models;

use app\core\Model;


class User extends Model
{
	public function get($id)
	{
		$data = ['id' => $id];
		$result = $this->db->row("SELECT *  FROM `users` WHERE id =:id", $data);
		return $result;
	}
}
