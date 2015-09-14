<?php

namespace C;

class content extends \baseController
{
	public function __construct($route)
	{
		parent::__construct($route);
		$this->title = 'Mvc Controller';
	}

	public function view()
	{
		$this->view = "body.phtml";
		$this->model = $this->GetModel("content");
		$this->content = $this->model->content();

	}
}
