<?php

namespace app\database\faker;

use Faker\Factory;
use app\lib\Db;

class UserFaker
{
	public static function run()
	{
		$faker = Factory::create();
		$pdo = new Db();

		for ($i = 0; $i < 10; $i++) {
			$username = $faker->userName;
			$email = $faker->email;
			$password = password_hash('1234', PASSWORD_DEFAULT);
			$role = $faker->numberBetween(1, 2);
			$imagePath = $faker->imageUrl();
			$query = "INSERT INTO users (username, email, password, role_id, image_path) VALUES (?, ?, ?, ?, ?)";
			$stmt = $pdo->db->prepare($query);
			$stmt->execute([$username, $email, $password, $role, $imagePath]);
		}

		echo "Данные для таблицы users успешно добавлены.\n";
	}
}
