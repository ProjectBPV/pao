<?php
	class database
	{
		private $db;
		private $result;
		
	    public function __construct($host,$database,$user,$password)
		{
			
			$this->db = new PDO("mysql:host=$host;dbname=$database","$user","$password");
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
				$results = $this->db->prepare($sql);
				$results->execute();
				$result = $results->fetch(PDO::FETCH_ASSOC);
				if($results->rowCount() == 1) {
					$results = '';
					return $result;
				} else {
					return false;	
				}
		}
		
		public function insert_update($sql)
		{
			$result = $this->db->prepare($sql);
			return $result->execute();
		}
		public function sqlPrepare($sql)
		{
			$this->result = $this->db->prepare($sql);
		}
		public function bindParameter($param, $value, $type)
		{
			$this->result->bindValue($param, $value, $type);
		}
		public function executeNonQuery()
		{
			$this->result->execute();
			print 'Derp '.$this->db->lastInsertId();
		}
		public function executeQuery($func)
		{
			$this->result->execute();
			return $this->result->$func(PDO::FETCH_ASSOC);
		}
	}
?>