<?php
	class router extends baseController
	{
		public function __construct($route)
		{
			parent::__construct($route);
			$class = (empty($_GET['class'])) ? 'desktop' : $_GET['class'];

			if($this->AutoLoad($class)){
				$obj = new $class($route);
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