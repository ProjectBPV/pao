<?php
	require($dir.'/includes/autoloader.php');
	
	$host = 'localhost';
	$database = 'mvc';
	$user = 'root';
	$db = new database($host, $database, $user, '');
	$route = new route($db);
	$router = new router($route);
?>