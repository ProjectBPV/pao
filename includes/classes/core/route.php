<?php
    class route
    {
    	public $baseDir;
		public $db;
		public $template;
		public $action;
		public $post;
		
    	public function __construct($template,$db)
		{
			$this->template = $template;
			$this->db = $db;
			$this->post = $_POST;
			$this->baseDir = preg_replace('/index.php/', '', $_SERVER['SCRIPT_NAME']);
			$this->action = (empty($_GET['method'])) ? 'view' : $_GET['method'];
			
			$template->prepare_data(array(
				'DIR' => $this->baseDir
			));		
		}
    }
	
?>