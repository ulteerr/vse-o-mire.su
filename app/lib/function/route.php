<?php
function route($name, $parameters = [])
{
	$routes = config('routes');
	$filteredRoutes = array_filter($routes, function ($route) use ($name) {
		return isset($route['name']) && $route['name'] === $name;
	});
	$filteredRoutes = current($filteredRoutes) ?? [];
	if (!empty($filteredRoutes)) {
		$url = $filteredRoutes;
		foreach ($parameters as $key => $value) {
			$str = str_replace(".{$key}", "/$value", $url['name']);
		}
		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
		$url = $protocol . $_SERVER['SERVER_NAME'] . '/' . trim($str, '/');
		
		return $url;
	} else {
		return '';
	}
}
