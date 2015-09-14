<?php

namespace C;

class user extends \baseController
{
	public function __construct($route)
	{
		parent::__construct($route);
		$this->title = 'MVC User Management';
	}

	public function view()
	{
		$this->view = "user.phtml";
		$this->model = $this->GetModel("user");
		$this->content = $this->model->content($this->db);
	}

	public function add()
	{
		$this->view = "insert.phtml";
		$this->content = "";
	}
	
	public function insert()
	{
		$this->model = $this->GetModel("user");
		$this->model->insert($this->db, $this->post);		
		$this->content = '';
		exit;
	}
}
