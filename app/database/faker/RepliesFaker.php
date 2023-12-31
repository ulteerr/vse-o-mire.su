<?php

namespace app\database\faker;

use app\lib\common\Db;
use Faker\Factory;


class RepliesFaker
{
	public static function run()
	{
		$faker = Factory::create();
		$pdo = new Db();

		for ($i = 0; $i < 100000; $i++) {
			$content = $faker->realText;
			$user_id = $faker->numberBetween(1, 10);
			$comment_id = $faker->numberBetween(1, 10000);
			$query = "INSERT INTO replies (content, user_id,comment_id ) VALUES (?, ?, ?)";
			$stmt = $pdo->db->prepare($query);
			$stmt->execute([$content, $user_id, $comment_id ]);
		}

		echo "Данные для таблицы replies успешно добавлены.\n";
	}
}
