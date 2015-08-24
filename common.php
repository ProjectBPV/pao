<?php
	require($dir.'/includes/autoloader.php');
	if(empty($_SESSION['acces'])) {
		$_SESSION['acces'] = 1;
	}
	$host = 'localhost';
	$database = 'mvc';
	$user = 'root';
	$db = new database($host, $database, $user, '');
	$route = new route($db);
	$router = new router($route);
?>