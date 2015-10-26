<?php

namespace C;

class authenticater extends \baseController
{
	public function __construct($route)
	{
		parent::__construct($route);		
		$this->title = 'Login Authenticator';
	}

	public function login()
	{
		$this->view = "login.phtml";
		$this->model = $this->GetModel("content");
		$this->content = '';
		
		if(!empty($_POST)) {
			// Auth location	
			$url = "http://localhost/pao/controllers/auth.php";
			// values
			$username = $_POST['username'];
			$password = $_POST['password'];
			//start curl
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			
			// exec curl
			$output = curl_exec($ch);
			curl_close($ch);
			
			if($output == "Login!"){
				// set session
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['token'] = $_POST['password'];
				header('Location: ../');	
			} else {
				$this->content = 'Inloggegevens fout';
			}
		}
	}
	public function logout()
	{	session_unset();
    	session_destroy();
		if(empty($_SESSION))
		{
			header('Location: ../');	
		}
	}
}
