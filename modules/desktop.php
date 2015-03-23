<?php
	class desktop extends baseController
	{
		public function __construct($route)
		{
			parent::__construct($route);
		}
		
		public function view()
		{
			return 'Dit is de desktop';
		}
	}
?>