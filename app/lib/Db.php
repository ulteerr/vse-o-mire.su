<?php

namespace app\lib;

use PDO;
use PDOException;

class Db
{
	public $db;

	public function __construct()
	{
		$config = require base_path() . '/app/config/db.php';
		try {
			$this->db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
		} catch (PDOException $e) {
			die("Ошибка подключения к базе данных: " . $e->getMessage());
		}
	}

	public function query($sql, $params = [])
	{

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			foreach ($params as $key => $value) {
				$stmt->bindValue(':' . $key, $value);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
		// return $result->fetchAll();
	}
	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}
}
