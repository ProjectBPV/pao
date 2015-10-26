<?php
//print_r($_SERVER);
//print_r($_SERVER['PHP_AUTH_USER']);
//echo "<br>";
//print_r($_SERVER['PHP_AUTH_PW']);

if($_SERVER['PHP_AUTH_USER'] == "maikel")
{
	if($_SERVER['PHP_AUTH_PW'] == "raoul")
	{
		echo "Login!";
	}
}

?>