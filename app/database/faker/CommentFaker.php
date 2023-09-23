<?php

namespace app\database\faker;

use app\lib\common\Db;
use Faker\Factory;


class CommentFaker
{
	public static function run()
	{
		$faker = Factory::create();
		$pdo = new Db();

		for ($i = 0; $i < 10000; $i++) {
			$content = $faker->realText;
			$user_id = $faker->numberBetween(1, 10);
			$article_id = $faker->numberBetween(1, 100);
			$query = "INSERT INTO comments (content, user_id,article_id ) VALUES (?, ?, ?)";
			$stmt = $pdo->db->prepare($query);
			$stmt->execute([$content, $user_id, $article_id ]);
		}

		echo "Данные для таблицы comments успешно добавлены.\n";
	}
}
