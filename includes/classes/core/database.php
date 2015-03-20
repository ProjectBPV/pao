<?php
	class database
	{
		private $db;
		
	    public function connect_pdo($host,$database,$user,$password)
		{
			$this->db = new PDO("mysql:host=$host;dbname=$database","$user","$password");
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->globalVarProtector();
		}
		
		public function fetchall($sql)
		{
	
				$results = $this->db->prepare($sql);
				$results->execute();
				$result = $results->fetchAll(PDO::FETCH_ASSOC);
				return $result;
		}
		
		public function fetch($sql)
		{
				$results = $db->prepare($sql);
				$results->execute();
				$result = $results->fetch(PDO::FETCH_ASSOC);
				if($result) {
					$results = '';
					return $result;
				} else {
					return false;	
				}
		}
		
		public function insert_update($db,$sql)
		{
			$result = $db->prepare($sql);
			return $result->execute();
		}
		public function globalVarProtector()
		{
			global $_GET,$_POST;
			$_GET = addslashes($_GET);
			$_POST = addslashes($_POST);
		}
	}
?>