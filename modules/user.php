<?php
	class user extends baseController
	{
		/*
		 * users
		 * -----
		 * userId
		 * voornaam
		 * tussenvoegsel
		 * achternaam
		 * wachtwoord
		 * email
		 * groep
		 * salt
		 */
		public $group = array( 1 => 'Admin', 2 => 'Begeleider');
		
		public function __construct($route)
		{
			parent::__construct($route);
			if(!empty($_GET['id']))
			{
				$this->id = $_GET['id'];
			}
			switch($this->action)
			{
				case 6:
					$content = $this->viewUser();
					break;
				case 5:
					$this->deleteUser();
					break;
				case 4:
					$this->saveEditUser();
					break;
				case 3:
					$content = $this->editUser();
					break;
				case 2:
					$this->saveUser();
					break;
				case 1:
					$content = $this->addUser();
					break;
				default:
					$content = $this->overview();
					break;
			}
			
			$this->template->prepare_data(array(
				'CONTENT' => $content
			));
		}	
		public function overview()
		{
			$usersSql = "SELECT * FROM `users` WHERE 1 = 1";
			$usersResult = $this->db->fetchall($usersSql);
			
			foreach($usersResult as $userKey)
			{
				$naam = substr($userKey['voornaam'], 0, 1).'. '.$userKey['tussenvoegsel'].' '.$userKey['achternaam'];
				$this->template->prepare_row_var('USERS', array( 
					'NAAM' => $naam,
					'GROUP' => $this->group[$userKey['groep']] ,
					'ID' => $userKey['userId'],
					'CONFIRM' => 'confirmDelete("'. $userKey['userId'].'","'. $naam .'");'
					));
			}
			
			$this->template->prepare_sub('overview', array(
				"TITEL" => 'Users',
				"DIR" => $this->baseDir
				));
			return $this->template->pparse_noecho('overview', 'user');
		}
		
		public function addUser()
		{
			$groups = array( 1 => 'Admin', 2 => 'Begeleider');
			foreach($this->group as $key => $val) {
				$this->template->prepare_row_var('GROUPS', array( 
					'VAL' => $key,
					'NAME' => $val
					));
			}
			$this->template->prepare_sub('add_or_edit', array(
				"DIR" => $this->baseDir,
				"CASE" => 2
				));
			return $this->template->pparse_noecho('add_or_edit','user');
		}
		
		public function saveUser()
		{
			$userSql = "INSERT INTO `users`(voornaam,tussenvoegsel, achternaam, wachtwoord, email, groep)
					VALUES(:voornaam, :tussenvoegsel, :achternaam, :wachtwoord, :email, :groep)";
			if(!empty($this->post)) {
				if(!empty($this->post['pw'])) {
					if($this->post['pw'] == $this->post['repw']) {
						if(empty($this->post['tussenvoegsel']))
							$this->post['tussenvoegsel'] = '';
						
						$this->db->sqlPrepare($userSql);
						$this->db->bindParameter(':voornaam', ucfirst($this->post['voornaam']), PDO::PARAM_STR);
						$this->db->bindParameter(':tussenvoegsel', $this->post['tussenvoegsel'], PDO::PARAM_STR);
						$this->db->bindParameter(':achternaam', ucfirst($this->post['achternaam']), PDO::PARAM_STR);
						$this->db->bindParameter(':wachtwoord', sha1($this->post['pw']), PDO::PARAM_STR);
						$this->db->bindParameter(':email', $this->post['email'], PDO::PARAM_STR);
						$this->db->bindParameter(':groep', $this->post['groep'], PDO::PARAM_STR);
						$this->db->executeNonQuery();
						
						$redir = $this->baseDir.'user/';
						header("Location: $redir");
					}
				}	
			}
		}
		
		public function editUser()
		{
			$userSql ="SELECT * FROM `users` WHERE userId = $this->id";
			
			$userResult = $this->db->fetch($userSql);
			
			foreach($this->group as $key => $val) 
			{
				$selected = '';
				if($key == $userResult['groep']) {
					$selected = "SELECTED";
				}
				$this->template->prepare_row_var('GROUPS', array( 
					'VAL' => $key,
					'NAME' => $val,
					'SELECTED' => $selected
					));
			}
			$this->template->prepare_sub('add_or_edit', array(
				"CASE" => 4,
				"DIR" => $this->baseDir,
			 	"ID" => $userResult['userId'],
			 	"TS" => $userResult['tussenvoegsel'],
				"VOORNAAM" => $userResult['voornaam'],
				"ACHTERNAAM" => $userResult['achternaam'],
				"EMAIL" => $userResult['email']
			));
			return $this->template->pparse_noecho('add_or_edit','user');
		}
		
		public function saveEditUser()
		{
			if(!empty($this->post)) {
				$userSql = "UPDATE `users`";
				$where = " WHERE userid = $this->id";
				
				foreach($this->post as $key => $val)
				{
					if($key == 'voornaam' || $key == 'achternaam')
						$val = ucfirst($val);

					if($key != "pw" && $key != "repw") {
						if(empty($add)) {
							$add = " SET `$key` = '$val'";
						} else {
							if($key == 'groep') {
								$add .= ", `$key` = $val";
							} else {
								$add .= ", `$key` = '$val'";
							}	
						}
					}
				} 
				
				if(!empty($this->post['pw'])) {
					if($this->post['pw'] == $this->post['repw']) {
						$add .= ", `wachtwoord` = '". sha1($this->post['pw'])."'";
					}
				}
								
				$this->db->execute($userSql.$add.$where);
				
				$redir = $this->baseDir."user/";
				header("Location: $redir");
			}
		}
		
		public function deleteUser()
		{
			if(!empty($this->id)) {
				$userSql = "DELETE FROM `users` WHERE userId = $this->id";
				$this->db->execute($userSql);
			}
			$redir = $this->baseDir .'user/';
			header("Location: $redir");
		}
		
		public function viewUser()
		{
			$userSql ="SELECT * FROM `users` WHERE userId = $this->id";
			
			$userResult = $this->db->fetch($userSql);
			
			foreach($this->group as $key => $val) 
			{
				$selected = '';
				if($key == $userResult['groep']) {
					$selected = "SELECTED";
				}
				$this->template->prepare_row_var('GROUPS', array( 
					'VAL' => $key,
					'NAME' => $val,
					'SELECTED' => $selected
					));
			}
			$this->template->prepare_sub('view', array(
				"CASE" => 3,
				"DIR" => $this->baseDir,
			 	"ID" => $userResult['userId'],
			 	"TS" => $userResult['tussenvoegsel'],
				"VOORNAAM" => $userResult['voornaam'],
				"ACHTERNAAM" => $userResult['achternaam'],
				"EMAIL" => $userResult['email']
			));
			return $this->template->pparse_noecho('view','user');
		}
	}

?>