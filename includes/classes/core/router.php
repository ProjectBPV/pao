<?php
	class Router extends functions
	{
		public function __construct($class, $method)
		{
			parent::__construct();

			if($this->AutoLoad($class)){
				$obj = new $obj();
			
				$this->template->prepare_data(array(
					'CONTENT' => $obj->$method()
					));
			} else {
				
			}
		}
		
		private function AutoLoad($class)
		{
			global $template;
			$path = './includes/classes/'. $class. '.php';
			if(file_exists($path)) {
				require($path);
				return true;
			} else {
				$this->template->throw404();
			}
		}
	}
?>