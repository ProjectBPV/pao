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
			$this->content ='';
			
			$this->url = "http://opendata.rijksoverheid.nl/v1/sources/rijksoverheid/infotypes/schoolholidays/schoolyear/2015-2016?output=json";
			$this->model = new \M\json(); 
			$this->vakantie = $this->model->GetNoJson($this->url);
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
