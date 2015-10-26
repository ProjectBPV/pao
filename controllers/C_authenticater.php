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
		$this->content = $this->model->content();
		
		if(!empty($_POST)) {
			$url = "http://localhost/pao/controllers/auth.php";
			$ch = curl_init();
			$username = $_POST['username'];
			$password = $_POST['password'];
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);
			echo "<pre>";
			if($output == "Login!"){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['token'] = $_POST['password'];
				echo "Works	";	
			}
			echo '<br>';
			//print_r($info);
			echo "</pre>";
			exit;
		} else {
			
		}	
	}
}
