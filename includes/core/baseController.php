<?php

class baseController
{
	public $db;
	public $post;
	public $get;
		
	public function __construct($route)
	{
		$this->db = $route->db;
		$this->post = $route->post;
		$this->get = $route->get;
	}
	
	public function GetModel($model){
		$model = '\M\\'.$model;
		return new $model();
	}
}
