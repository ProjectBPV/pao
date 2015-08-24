<?php
namespace C;
	class vakantie extends \baseController
	{
		public function __construct($route)
		{
			parent::__construct($route);
			$this->title = 'Mvc opensource data';
		}
		
		public function view()
		{
			$this->url = "http://opendata.rijksoverheid.nl/v1/sources/rijksoverheid/infotypes/schoolholidays/schoolyear/2015-2016?output=json";
			$this->vakantie = json_decode(file_get_contents($this->url),true);
			$this->view = "open.phtml";
			$this->model = $this->GetModel("gallery"); 
			$this->content = $this->model->content();
		}
	}
