<?php
	class helper
	{
		function __construct()
		{
			global $template, $db;
			$this->template = $template;	
			$this->db = $db;
		}
	
		function printvar($var)
		{
				echo '<br><pre>';
				print_r($var);
				echo '</pre><br>';			
		}
		
		
	}
?>