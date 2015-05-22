<?php
	class company extends baseController
	{
		/*
		 * bedrijven
		 * ---------
		 * bedrijfid
		 * bedrijfsnaam
		 * adres
		 * postcode
		 * plaats
		 * telefoonnummer
		 * email
		 * website
		 * codeleerbedrijf
		 * opmerking
		 * 
		 * opleidingengeschikt
		 * -------------------
		 * bedrijfid
		 * MI
		 * MBI
		 * IB
		 * AO
		 * NB
		 * 
		 * bedrijvenKopleiders
		 * -----------------
		 * bedrijfId
		 * praktijkopleiderId
		 * 
		 * opleiders
		 * ---------
		 * praktijkopleiderId
		 * praktijkopleiders / contactpersoon
		 * naam
		 * functie
		 * telefoonnummer
		 * email
		 * 
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
				case 5:
					$this->deleteUser();
					break;
				case 4:
					$this->saveEditCompany();
					break;
				case 3:
					$content = $this->editCompany();
					break;
				case 2:
					$content = $this->saveCompany();
					break;
				case 1:
					$content = $this->addCompany();
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
			$companySql = "SELECT * FROM `bedrijven` WHERE 1 = 1";
			$companyResult = $this->db->fetchall($companySql);
			
			foreach($companyResult as $companyKey)
			{
				
				$this->template->prepare_row_var('COMPANYS', array( 
					'NAAM' => $companyKey['bedrijfnaam'],
					'ID' => $companyKey['bedrijfid'],
					'CONFIRM' => 'confirmDelete("'. $companyKey['bedrijfid'].'");'
					));
			}
			
			$this->template->prepare_sub('overview', array(
				"TITEL" => 'Bedrijven',
				"DIR" => $this->baseDir
				));
			return $this->template->pparse_noecho('overview', 'company');
		}
		
		public function addCompany()
		{

			$this->template->prepare_sub('add_or_edit_company', array(
				"DIR" => $this->baseDir,
				"CASE" => 2
				));
			return $this->template->pparse_noecho('add_or_edit_company','company');
		}
		
		public function saveCompany()
		{
			if(!empty($this->post)) {
				$companySql = "INSERT INTO `bedrijven`(bedrijfnaam, adres, postcode, plaats, telefoonnummer, email, website, codeleerbedrijf, opmerking) 
							VALUES(:bedrijfnaam, :adres, :postcode, :plaats, :telefoonnummer, :email, :website, :codeleerbedrijf, :opmerking)";
				$this->db->sqlPrepare($companySql);
				$this->db->bindParameter(':bedrijfnaam', $this->post['bedrijfsnaam'], PDO::PARAM_STR);
				$this->db->bindParameter(':adres', $this->post['adres'], PDO::PARAM_STR);
				$this->db->bindParameter(':postcode', $this->post['postcode'], PDO::PARAM_STR);
				$this->db->bindParameter(':plaats', $this->post['plaats'], PDO::PARAM_STR);
				$this->db->bindParameter(':telefoonnummer', $this->post['telefoonnummer'], PDO::PARAM_STR);
				$this->db->bindParameter(':email', $this->post['email'], PDO::PARAM_STR);
				$this->db->bindParameter(':website', $this->post['website'], PDO::PARAM_STR);
				$this->db->bindParameter(':codeleerbedrijf', $this->post['code'], PDO::PARAM_STR);
				$this->db->bindParameter(':opmerking', $this->post['opmerking'], PDO::PARAM_STR);
				$this->db->executeNonQuery();
				
				header("Location: $this->baseDir".'company/');
			} else {
				return $this->addCompany();
			}
		}
		
		public function editCompany()
		{
			$companySql = "SELECT * FROM `bedrijven` WHERE bedrijfid = $this->id";
			$companyResult = $this->db->fetch($companySql);
			
			$this->template->prepare_sub('add_or_edit_company', array(
				"DIR" => $this->baseDir,
				"CASE" => 4,
				"ID" => $this->id,
				"BEDRIJFSNAAM" => $companyResult['bedrijfnaam'],
				"ADRES" => $companyResult['adres'],
				"POSTCODE" => $companyResult['postcode'],
				"PLAATS" => $companyResult['plaats'],
				"TELEFOONNUMMER" => $companyResult['telefoonnummer'],
				"EMAIL" => $companyResult['email'],
				"WEBSITE" => $companyResult['website'],
				"CODE" => $companyResult['codeleerbedrijf'],
				"OPMERKING" => $companyResult['opmerking']
				));
				
			return $this->template->pparse_noecho('add_or_edit_company','company');
		}
		
		public function saveEditCompany()
		{
			$companySql = "UPDATE `bedrijven` 
						SET bedrijfnaam = :bedrijfnaam, 
							adres = :adres, 
							postcode = :postcode, 
							plaats = :plaats, 
							telefoonnummer = :telefoonnummer, 
							email = :email, 
							website = :website,
							codeleerbedrijf = :codeleerbedrijf,
							opmerking = :opmerking
						WHERE bedrijfid = $this->id";
			
			$this->db->sqlPrepare($companySql);
			$this->db->bindParameter(':bedrijfnaam', $this->post['bedrijfsnaam'], PDO::PARAM_STR);
			$this->db->bindParameter(':adres', $this->post['adres'], PDO::PARAM_STR);
			$this->db->bindParameter(':postcode', $this->post['postcode'], PDO::PARAM_STR);
			$this->db->bindParameter(':plaats', $this->post['plaats'], PDO::PARAM_STR);
			$this->db->bindParameter(':telefoonnummer', $this->post['telefoonnummer'], PDO::PARAM_STR);
			$this->db->bindParameter(':email', $this->post['email'], PDO::PARAM_STR);
			$this->db->bindParameter(':website', $this->post['website'], PDO::PARAM_STR);
			$this->db->bindParameter(':codeleerbedrijf', $this->post['code'], PDO::PARAM_STR);
			$this->db->bindParameter(':opmerking', $this->post['opmerking'], PDO::PARAM_STR);
			$this->db->executeNonQuery();
			header("Location: $this->baseDir".'company/');
		}
		
		public function deleteUser()
		{
			if(!empty($this->id)) {
				$companySql = "DELETE FROM `bedrijven` WHERE bedrijfid = $this->id";
				$this->db->execute($companySql);
			}
			$redir = $this->baseDir .'company/';
			header("Location: $redir");
		}
	}

?>