<?php
return [
	'register' => [
		'controller' => 'account',
		'action' => 'register',
		'name' => 'register',
	],
	'login' => [
		'controller' => 'account',
		'action' => 'login',
		'name' => 'login',
	],
	'articles' => [
		'controller' => 'articles',
		'action' => 'index',
		'name' => 'articles',
	],
	'articles/{slug}' => [
		'controller' => 'articles',
		'action' => 'show',
		'name' => 'articles.show',
	],
	'/' => [
		'controller' => 'main',
		'action' => 'index',
		'name' => 'index',
	]
];
