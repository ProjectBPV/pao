<?php
    class route
    {
		public $db;
		public $post;
		public $get;
		
    	public function __construct($db)
		{
			$this->db = $db;
			$this->post = $_POST;
			$this->get = $_GET;
		}
    }
	
?>