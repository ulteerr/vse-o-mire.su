<?php
function include_view($viewPath, $data = [])
{
	$filePath = base_path() . '/app/views/' . str_replace('.', '/', $viewPath) . '.php';
	if (file_exists($filePath)) {
		extract($data);
		include($filePath);
	}
}
