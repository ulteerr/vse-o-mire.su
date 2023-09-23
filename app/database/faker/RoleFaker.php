<?php

namespace app\database\faker;

use app\lib\common\Db;

class RoleFaker
{
	public static function run()
	{
		$pdo = new Db();
		$query = "INSERT INTO roles (name) VALUES (?), (?)";
		$stmt = $pdo->db->prepare($query);
		$stmt->execute(['admin', 'user']);

		echo "Данные для таблицы roles успешно добавлены.\n";
	}
}
