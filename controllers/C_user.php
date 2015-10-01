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
	
	public function edit()
	{
		$this->model = $this->GetModel("user");
		$this->view = "edit.phtml";
		$this->content = $this->model->getOne($this->db, $this->get['id']);
	}
	public function saveEdit()
	{
		$this->baseDir = preg_replace('^/admin/^', '',preg_replace('/index.php/', '', $_SERVER['SCRIPT_NAME']));
		$this->model = $this->GetModel("user");
		$this->view = "edit.phtml";
		$this->content = $this->model->edit($this->db, $this->get['id'], $this->post);
		$path = "$this->baseDir"."user/view";
		header("location: $path");
	}
	
	public function insert()
	{
		$this->model = $this->GetModel("user");
		$this->model->insert($this->db, $this->post);		
		$this->content = '';
		exit;
	}
}
