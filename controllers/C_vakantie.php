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
			$this->view = "open.phtml";
			$this->content = 'hoi';
			
			$this->url = "http://opendata.rijksoverheid.nl/v1/sources/rijksoverheid/infotypes/schoolholidays/schoolyear/2015-2016?output=json";
			$this->model = $this->GetModel("json"); 
			$this->vakantie = $this->model->GetJson($this->url);
			$this->vakantie = json_decode($this->vakantie, true);
		}
		
		public function rest()
		{
			$this->content = '';
			$this->view ='empty.phtml';
			$this->layout = 'empty.phtml';
			
			$this->url = "http://opendata.rijksoverheid.nl/v1/sources/rijksoverheid/infotypes/schoolholidays/schoolyear/2015-2016?output=json";	
			$this->model = $this->GetModel("json"); 
			$this->json = $this->model->getJson($this->url);
			
		}
	}
