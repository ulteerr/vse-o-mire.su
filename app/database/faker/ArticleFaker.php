<?php

namespace app\database\faker;

use Faker\Factory;
use app\lib\Db;

class ArticleFaker
{
	public static function run()
	{
		$faker = Factory::create();
		$pdo = new Db();

		for ($i = 0; $i < 100; $i++) {
			$title = $faker->realText($maxNbChars = 30);
			$content = $faker->realText;
			$user_id = $faker->numberBetween(1, 10);
			$slug = transliterate($title);
			$image_path = $faker->imageUrl();
			$query = "INSERT INTO articles (title,slug, content, user_id,image_path) VALUES (?, ?, ?, ?, ?)";
			$stmt = $pdo->db->prepare($query);
			$stmt->execute([$title, $slug, $content, $user_id, $image_path]);
		}

		echo "Данные для таблицы articles успешно добавлены.\n";
	}
}
