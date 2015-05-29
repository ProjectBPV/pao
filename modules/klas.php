<?php
	class klas extends baseController
	{
		/*
		 * klassen
		 * -----
		 * klasId
		 * klasnaam
		 * mentor
		 */
		private $base;
		
		public function __construct($route)
		{
			parent::__construct($route);
			$this->base = $this->baseDir.'klas/';
			
			if(!empty($_GET['id']))
			{
				$this->id = $_GET['id'];
			}
			switch($this->action)
			{
				case 6:
					$content = $this->viewKlas();
					break;
				case 5:
					$this->deleteKlas();
				case 4:
					$content = $this->saveEditKlas();
					break;
				case 3:
					$content = $this->editKlas();
					break;
				case 2:
					$this->saveKlas();
					break;
				case 1:
					$content = $this->addKlas();
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
			$klasSql = "SELECT * FROM `klassen` WHERE 1 = 1";
			$klasResult = $this->db->fetchall($klasSql);
			
			foreach($klasResult as $klasKey)
			{
				$this->template->prepare_row_var('KLASSEN', array( 
					'NAAM' => $klasKey['klasnaam'],
					'ID' => $klasKey['klasId'],
					'CONFIRM' => 'confirmDelete("'. $klasKey['klasId'].'","'. $klasKey['klasnaam'] .'");'
					));
			}
			
			$this->template->prepare_sub('overview', array(
				"TITEL" => 'Klassen',
				"DIR" => $this->baseDir
				));
			return $this->template->pparse_noecho('overview', 'klas');
		}
		
		public function addKlas()
		{
			$this->template->prepare_sub('add_or_edit', array(
				"DIR" => $this->baseDir,
				"CASE" => 2
				));
			return $this->template->pparse_noecho('add_or_edit', 'klas');
		}

		public function saveKlas()
		{
			$klasSql = "INSERT INTO `klassen`(klasnaam, mentor)
					VALUES(:klasnaam, :mentor) ";
			if(!empty($this->post)) {						
				$this->db->sqlPrepare($klasSql);
				$this->db->bindParameter(':klasnaam', $this->post['klasnaam'], PDO::PARAM_STR);
				$this->db->bindParameter(':mentor', ucfirst($this->post['mentor']), PDO::PARAM_STR);
				$this->db->executeNonQuery();
						
				header("Location: $this->base");
			}
		}

		public function editKlas()
		{
			$klasSql = "SELECT * FROM `klassen` WHERE klasId = $this->id";
			$klasResult = $this->db->fetch($klasSql);
			
			$this->template->prepare_sub('add_or_edit', array(
				"DIR" => $this->baseDir,
				"CASE" => 4,
				"ID" => $klasResult["klasId"],
				"KLASNAAM" => $klasResult["klasnaam"],
				"MENTOR" => $klasResult["mentor"],
			));
			return $this->template->pparse_noecho('add_or_edit', 'klas');
		}
		
		public function saveEditKlas()
		{
			$klasSql = " UPDATE `klassen`
							SET klasnaam = :klasnaam,
				 				mentor = :mentor
				 			WHERE klasId = :id";
			if(!empty($this->post)){
				$this->db->sqlPrepare($klasSql);
				$this->db->bindParameter(':id', $this->id, PDO::PARAM_STR);
				$this->db->bindParameter(':klasnaam', $this->post['klasnaam'], PDO::PARAM_STR);
				$this->db->bindParameter(':mentor', ucfirst($this->post['mentor']), PDO::PARAM_STR);
				$this->db->executeNonQuery();
				header("Location: $this->base");
			}
		}
		
		public function deleteKlas()
		{
			$klasSql = "DELETE FROM `klassen` WHERE klasId = $this->id";
			$this->db->execute($klasSql);

			header("Location: $this->base");
		}
		
		public function viewKlas()
		{
			$klasSql = "SELECT * FROM `klassen` WHERE klasId = $this->id";
			$klasResult = $this->db->fetch($klasSql);
			
			$this->template->prepare_sub('view', array(
				"DIR" => $this->baseDir,
				"CASE" => 3,
				"ID" => $klasResult["klasId"],
				"KLASNAAM" => $klasResult["klasnaam"],
				"MENTOR" => $klasResult["mentor"],
			));
			return $this->template->pparse_noecho('view', 'klas');
		}
	}

?>