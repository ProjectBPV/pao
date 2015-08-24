<?php
	class router extends baseController
	{
		public $controller = 'content';
		public $method = 'view';
		
		public function __construct($route)
		{
			parent::__construct($route);
			
			// Set controller and method
			if(!empty($this->get['controller'])) { 
			 	$load = '\C\\'.$this->get['controller'];
			} else {
				$load = '\C\\'.$this->controller; 
			}
			if(!empty($this->get['method'])) {
				$method = $this->get['method'];
			} else {
				$method = $this->method;
			}
			
			// load controller
			$controller = new $load($route);
			$controller->$method();
			
			
			// fetch and parse view
			$view =  $controller->view;
			$path = "view/$view";
			
			// set view vars
			$this->title = $controller->title;
			$this->obj = $controller;
			$this->content = $controller->content;
			
			if(file_exists($path)) {
				ob_start();
				$file = file_get_contents($path);
				eval("?>$file");
				$this->content = ob_get_clean();
			
				if(!empty($this->content)) {
					ob_start();
					$layout = file_get_contents('layout/layout.phtml');
					eval("?>$layout");
					$layout = ob_get_clean();
					print $layout;
				}
			}
		}
	}
?>