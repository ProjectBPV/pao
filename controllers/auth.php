<?php
//print_r($_SERVER);
//echo base64_decode($_SERVER['PHP_AUTH_USER']);
//print_r(base64_decode($_SERVER['PHP_AUTH_USER']));
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