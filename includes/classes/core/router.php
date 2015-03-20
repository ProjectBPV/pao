<?php
	class Router extends helper
	{
		public function __construct($class, $method)
		{
			parent::__construct();

			if($this->AutoLoad($class)){
				$obj = new $class();
			
				$this->template->prepare_data(array(
					'CONTENT' => $obj->$method()
					));
			} else {
				$this->template->throw404();
			}
		}
		
		private function AutoLoad($class)
		{
			$path = "./modules/". $class. '.php';
			if(file_exists($path)) {
				require($path);
				return true;
			} else {
				return false;
			}
		}
	}
?>