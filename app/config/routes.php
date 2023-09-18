<?php
return [
	'register' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'login' => [
		'controller' => 'account',
		'action' => 'login',
	],
	'articles' => [
		'controller' => 'articles',
		'action' => 'index',
	],
	'articles/{slug}' => [
		'controller' => 'articles',
		'action' => 'show',
	],
	'/' => [
		'controller' => 'main',
		'action' => 'index',
	]
];
