<?php
function __autoload($class) {
	$found = false;
	$class = str_replace("\\", "_", $class);
	$maps = array('controllers', 'models', 'includes/core', 'view');
	foreach($maps as $key)
	{
		$path = "./$key/$class.php";
		if(file_exists($path)){
			require($path);
			$found = true;
		}
	}
	if(!$found) {
		throw new Exception("Class not found");
	}
}
?>
