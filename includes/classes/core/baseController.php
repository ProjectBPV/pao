<?php
	class baseController
	{
		public $baseDir;
		public $db;
		public $template;
		public $action;
		public $post;
		
		function __construct($route)
		{
			$this->template = $route->template;
			$this->db = $route->db;
			$this->post = $route->post;
			$this->baseDir = $route->baseDir;
			$this->action = $route->action;
		}		
	}
?>