<?php
	class student extends baseController
	{
		/*
		 * studenten
		 * -----
		 * studentId
		 * studentnummer
		 * voornaam
		 * tussennaam
		 * achternaam
		 * adres
		 * postcode
		 * plaats
		 * email
		 * telefoonnummer
		 */

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
					$content = $this->viewStudent();
					break;
				case 5:
					$this->deleteStudent();
				case 4:
					$content = $this->saveEditStudent();
					break;
				case 3:
					$content = $this->editStudent();
					break;
				case 2:
					$this->saveStudent();
					break;
				case 1:
					$content = $this->addStudent();
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
			$studentSql = "SELECT * FROM `studenten` WHERE 1 = 1";
			$studentResult = $this->db->fetchall($studentSql);
			
			foreach($studentResult as $studentKey)
			{
				$naam = substr($studentKey['voornaam'], 0, 1).'. '.$studentKey['tussennaam'].' '.$studentKey['achternaam'];
				$this->template->prepare_row_var('STUDENTS', array( 
					'NAAM' => $naam,
					'ID' => $studentKey['studentId'],
					'CONFIRM' => 'confirmDelete("'. $studentKey['studentId'].'","'. $naam .'");'
					));
			}
			
			$this->template->prepare_sub('overview', array(
				"TITEL" => 'Studenten',
				"DIR" => $this->baseDir
				));
			return $this->template->pparse_noecho('overview', 'student');
		}
		
		public function addStudent()
		{
			$this->template->prepare_sub('add_or_edit', array(
				"DIR" => $this->baseDir,
				"CASE" => 2
				));
			return $this->template->pparse_noecho('add_or_edit', 'student');
		}

		public function saveStudent()
		{
			$studentSql = "INSERT INTO `studenten`(studentnummer, voornaam, tussennaam, achternaam, adres, postcode, plaats, email, telefoonnummer)
					VALUES(:studentnummer, :voornaam, :tussennaam, :achternaam, :adres, :postcode, :plaats, :email, :telefoonnummer) ";
			if(!empty($this->post)) {
				if(empty($this->post['tussenvoegsel']))
					$this->post['tussenvoegsel'] = '';
						
				$this->db->sqlPrepare($studentSql);
				$this->db->bindParameter(':studentnummer', $this->post['studentnr'], PDO::PARAM_STR);
				$this->db->bindParameter(':voornaam', ucfirst($this->post['voornaam']), PDO::PARAM_STR);
				$this->db->bindParameter(':tussennaam', $this->post['ts'], PDO::PARAM_STR);
				$this->db->bindParameter(':achternaam', ucfirst($this->post['achternaam']), PDO::PARAM_STR);
				$this->db->bindParameter(':adres', $this->post['adres'], PDO::PARAM_STR);
				$this->db->bindParameter(':postcode', $this->post['postcode'], PDO::PARAM_STR);
				$this->db->bindParameter(':plaats', $this->post['plaats'], PDO::PARAM_STR);
				$this->db->bindParameter(':email', $this->post['email'], PDO::PARAM_STR);
				$this->db->bindParameter(':telefoonnummer', $this->post['tn'], PDO::PARAM_STR);
				$this->db->executeNonQuery();
						
				$redir = $this->baseDir.'student/';
				header("Location: $redir");
			}
		}

		public function editStudent()
		{
			$studentSql = "SELECT * FROM `studenten` WHERE studentId = $this->id";
			$studentResult = $this->db->fetch($studentSql);
			
			$this->template->prepare_sub('add_or_edit', array(
				"DIR" => $this->baseDir,
				"CASE" => 4,
				"ID" => $studentResult["studentId"],
				"STUDENTNR" => $studentResult["studentnummer"],
				"VOORNAAM" => $studentResult["voornaam"],
				"TS" => $studentResult["tussennaam"],
				"ACHTERNAAM" => $studentResult["achternaam"],
				"ADRES" => $studentResult["adres"],
				"POSTCODE" => $studentResult["postcode"],
				"PLAATS" => $studentResult["plaats"],
				"EMAIL" => $studentResult["email"],
				"TN" => $studentResult["telefoonnummer"]
				
			));
			return $this->template->pparse_noecho('add_or_edit', 'student');
		}
		
		public function saveEditStudent()
		{
			$studentSql = " UPDATE `studenten`
							SET studentnummer = :studentnummer,
				 				voornaam = :voornaam, 
				 				tussennaam = :tussennaam, 
				 				achternaam = :achternaam, 
				 				adres = :adres, 
				 				postcode = :postcode, 
				 				plaats = :plaats, 
				 				email = :email, 
				 				telefoonnummer =  :telefoonnummer
				 			WHERE studentId = :id";
			if(!empty($this->post)){
				$this->db->sqlPrepare($studentSql);
				$this->db->bindParameter(':id', $this->id, PDO::PARAM_STR);
				$this->db->bindParameter(':studentnummer', $this->post['studentnr'], PDO::PARAM_STR);
				$this->db->bindParameter(':voornaam', ucfirst($this->post['voornaam']), PDO::PARAM_STR);
				$this->db->bindParameter(':tussennaam', $this->post['ts'], PDO::PARAM_STR);
				$this->db->bindParameter(':achternaam', ucfirst($this->post['achternaam']), PDO::PARAM_STR);
				$this->db->bindParameter(':adres', $this->post['adres'], PDO::PARAM_STR);
				$this->db->bindParameter(':postcode', $this->post['postcode'], PDO::PARAM_STR);
				$this->db->bindParameter(':plaats', $this->post['plaats'], PDO::PARAM_STR);
				$this->db->bindParameter(':email', $this->post['email'], PDO::PARAM_STR);
				$this->db->bindParameter(':telefoonnummer', $this->post['tn'], PDO::PARAM_STR);
				$this->db->executeNonQuery();
				$redir = $this->baseDir. "student/";
				header("Location: $redir");
			}
		}
		
		public function deleteStudent()
		{
			$studentSql = "DELETE FROM `studenten` WHERE studentId = $this->id";
			$this->db->execute($studentSql);

			$redir = $this->baseDir. "student/";
			header("Location: $redir");
		}
		
		public function viewStudent()
		{
			$studentSql = "SELECT * FROM `studenten` WHERE studentId = $this->id";
			$studentResult = $this->db->fetch($studentSql);
			
			$this->template->prepare_sub('view', array(
				"DIR" => $this->baseDir,
				"CASE" => 3,
				"ID" => $studentResult["studentId"],
				"STUDENTNR" => $studentResult["studentnummer"],
				"VOORNAAM" => $studentResult["voornaam"],
				"TS" => $studentResult["tussennaam"],
				"ACHTERNAAM" => $studentResult["achternaam"],
				"ADRES" => $studentResult["adres"],
				"POSTCODE" => $studentResult["postcode"],
				"PLAATS" => $studentResult["plaats"],
				"EMAIL" => $studentResult["email"],
				"TN" => $studentResult["telefoonnummer"]
				
			));
			return $this->template->pparse_noecho('view', 'student');
		}
	}

?>