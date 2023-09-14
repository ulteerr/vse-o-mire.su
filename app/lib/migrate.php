<?php

require 'require.php';

use app\lib\Db;

$pdo = new Db;

if (isset($argv[1])) {
	$action = $argv[1];
	$query = "
        CREATE TABLE IF NOT EXISTS migrations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            migration_name VARCHAR(255),
			batch INT,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";
	$pdo->query($query);
	$query = $pdo->query("SELECT migration_name FROM migrations");
	$executed_migrations = $query->fetchAll(PDO::FETCH_COLUMN);
	$directory = base_path() . '/app/database/migrations_class/';
	if (!is_dir($directory)) {
		mkdir($directory, 0755, true);
	}
	if ($action === 'up') {
		$migration_files = glob(base_path() . '/migrations/*.php');
		foreach ($migration_files as $file) {
			$migration_name = pathinfo($file, PATHINFO_FILENAME);
			$migration_class_name  =  className($migration_name);
			$class_name =  $migration_class_name;


		
			$migration_file_content = file_get_contents($file);
			preg_match('/function up\(\)\s*{(.+?)}/s', $migration_file_content, $matches_up);
			preg_match('/function down\(\)\s*{(.+?)}/s', $migration_file_content, $matches_down);

			$up_method_code = "    public function up()\n    {\n";
			$up_method_code .= $matches_up[1];
			$up_method_code .= "\n    }\n";

			$down_method_code = "    public function down()\n    {\n";
			$down_method_code .= $matches_down[1];
			$down_method_code .= "\n    }\n";

			$class_content = "<?php\n\nnamespace app\\database\\migrations_class;\n\nclass $class_name\n{\n";
			$class_content .= $up_method_code;
			$class_content .= $down_method_code;
			$class_content .= "}\n";

			$set_file = file_put_contents(base_path() . "/app/database/migrations_class/$class_name.php", $class_content);
		}
		foreach ($migration_files as $file) {
			$migration_name = pathinfo($file, PATHINFO_FILENAME);
			$migration_class_name  =  className($migration_name);
			$migration_class_name = "app\\database\\migrations_class\\" . $migration_class_name;
			
			$migration = new $migration_class_name();
			$migration->up();
			$stmt = $pdo->db->prepare("INSERT INTO migrations (migration_name, batch) VALUES (:migration_name, :batch)");
			$stmt->bindParam(':migration_name', $migration_name);
			$stmt->bindValue(':batch', count($executed_migrations) + 1, PDO::PARAM_INT);
			$stmt->execute();

			echo "Миграция $migration_name выполнена успешно.\n";
		}
		echo "Все миграции выполнены.\n";
	} elseif ($action === 'down') {
		$stmt = $pdo->db->prepare("SELECT * FROM migrations ORDER BY batch DESC, id DESC LIMIT 1");
		$stmt->execute();
		$last_batch_migration = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($last_batch_migration !== false) {
			$batch = $last_batch_migration['batch'];

			$stmt = $pdo->db->prepare("SELECT * FROM migrations WHERE batch = :batch ORDER BY id DESC");
			$stmt->bindParam(':batch', $batch);
			$stmt->execute();
			$migrations_to_rollback = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($migrations_to_rollback as $migration) {
				$migration_class_name  =  className($migration['migration_name']);
				$class_file_name = $migration['migration_name'] . '.php';
				$class_file_path = base_path() . "/migrations/$class_file_name";

				if (file_exists($class_file_path)) {
					$migration_class_name = "app\\database\\migrations_class\\" . $migration_class_name;
					if (class_exists($migration_class_name)) {
						$migration_instance = new $migration_class_name();
						$migration_instance->down();

						$stmt = $pdo->db->prepare("DELETE FROM migrations WHERE id = :id");
						$stmt->bindParam(':id', $migration['id']);
						$stmt->execute();

						echo "Откат миграции {$migration['migration_name']} выполнен успешно.\n";
						$file_to_delete = base_path() . '/' . $migration_class_name . '.php';
						$file_to_delete = str_replace('\\', '/', $file_to_delete);
						unlink($file_to_delete);
					} else {
						echo "Класс миграции {$migration_class_name} не найден.\n";
					}
				} else {
					echo "Файл миграции {$migration['migration_name']} не найден.\n";
				}
			}
		} else {
			echo "Нет выполненных миграций для отката.\n";
		}
	}
} else {
	echo "Укажите параметр (up или down) для выполнения миграций.\n";
}

function className($class_name)
{
	$migration_class_name  =  str_replace('_', ' ', preg_replace('/^[0-9]+/', '', $class_name));
	$migration_class_name = ucwords($migration_class_name);
	$migration_class_name = str_replace(' ', '', $migration_class_name);

	return $migration_class_name;
}
