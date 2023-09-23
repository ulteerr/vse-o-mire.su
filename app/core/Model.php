<?php

namespace app\core;

use app\lib\common\Db;

abstract class Model
{
	public $db;

	public function __construct()
	{
		$this->db = new Db;
	}

}
