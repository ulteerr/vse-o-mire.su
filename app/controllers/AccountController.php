<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{
	public function login()
	{
		$this->view->render('Вход');
	}

	public function register()
	{
		$this->view->render('Регистрация');
	}
}
