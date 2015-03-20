<?php
	class helper
	{
		function __construct()
		{
			global $template, $db;
			$this->template = $template;	
			$this->db = $db;
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