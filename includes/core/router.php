<?php
	class router extends baseController
	{
		public $controller = 'content';
		public $method = 'view';
		public $baseDir = '';
		
		public function __construct($route)
		{
			parent::__construct($route);
			$this->baseDir = preg_replace('^/admin/^', '',preg_replace('/index.php/', '', $_SERVER['SCRIPT_NAME']));
			
			
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
			try {
			$controller = new $load($route);
			$controller->$method();
			} catch(exception $e){
				echo $e->getMessage();
				exit;
			}
			
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
				$content = ob_get_clean();
				$this->contentx = $content;
				if(!empty($content)) {
					ob_start();
					if(empty($controller->layout)){
						$layout = file_get_contents('layout/layout.phtml');
					} else {
						$layout = file_get_contents('layout/'.$controller->layout);
					}
					eval("?>$layout");
					$layout = ob_get_clean();
					print $layout;
				}
			}
		}
	}
?>