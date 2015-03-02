<?php
	class desktop
	{
		public function __construct()
		{
			global $template;
			$this->template = $template;
		}
		
		public function view()
		{
			return 'Dit is de desktop';
		}
	}
?>