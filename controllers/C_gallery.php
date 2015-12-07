<?php

namespace C;

class gallery extends \baseController
{
	public function __construct($route)
	{
		parent::__construct($route);
		$this->title = 'Mvc gallery';
		$this->requiredScripts[] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js";
	}	

	public function view()
	{
		$this->view = "body.phtml";
		$this->model = $this->GetModel("gallery");
		$this->content = $this->model->content();
	}
}
