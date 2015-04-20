<?php
	class desktop extends baseController
	{
		public function __construct($route)
		{
			parent::__construct($route);
			switch($this->action)
			{
				case 1:
					$content = $this->login();
					break;	
				default:
					$content = $this->view();
					break;
			}
			$this->template->prepare_data(array(
				'CONTENT' => $content
			));
		}
		
		public function view()
		{
			return 'Dit is de desktop';
		}
		public function login()
		{
			return 'login';
		}		
	}
?>