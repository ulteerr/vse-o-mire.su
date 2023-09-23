<?php

namespace app\lib\common;

use PDO;
use PDOException;

class Db
{
	public $db;

	public function __construct()
	{
		$config = config('db');
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
				if (strpos($key, 'limit') !== false || strpos($key, 'offset') !== false || strpos($key, 'perPage') !== false) {
					$stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
				} else {
					$stmt->bindValue(':' . $key, $value);
				}
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}
}
