<?php
	class functions
	{
		function __construct()
		{
			global $template;
			$this->template = $template;	
		}
		
		function get($val)
		{
			if(!empty($_GET[$val])){
				return addslashes($_GET[$val]);
			} else {
				return FALSE;
			}
		}
		
		function post($val)
		{
			if(!empty($_POST[$val])){
				return addslashes($_POST[$val]);
			} else {
				return FALSE;
			}
		}
		
		function printvar($var,$br = false)
		{
			if($br)
			{
				echo '<br><pre>';
				print_r($var);
				echo '</pre><br>';
			} else {
				echo '<pre>';
				print_r($var);
				echo '</pre>';	
			}
			
		}
		
		
	}
?>