<?php
	class database
	{
		private $pdo;
		private $mysqli;
		private $result;
		
	    public function __construct($host,$database,$user,$password)
		{
			
			$this->pdo = new PDO("mysql:host=$host;dbname=$database","$user","$password");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$this->mysqli = new mysqli($host, $user, $password);
			mysqli_select_db($this->mysqli,$database);
		}
		
		public function fetchall($sql, $type = "pdo")
		{
			if($type == "pdo")
			{
				$results = $this->pdo->prepare($sql);
				$results->execute();
				$result = $results->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			} else {
				$result = mysqli_query($this->mysqli, $sql);
				if(mysql_num_rows($result) > 0) {
					return mysqli_fetch_assoc($result);
				} else {
					return false;
				}	
			}
		}
		
		public function fetch($sql, $type = "pdo")
		{
			if($type == "pdo")
			{
				$results = $this->pdo->prepare($sql);
				$results->execute();
				$result = $results->fetch(PDO::FETCH_ASSOC);
				if($results->rowCount() == 1) {
					$results = '';
					return $result;
				} else {
					return false;	
				}
			} else {
				$result = mysqli_query($this->mysqli, $sql);
				if(mysql_num_rows($result) == 1) {
					return mysql_fetch_row($result);
				} else {
					return false;
				}			
			}
		}
		
		public function insert_update($sql, $type = "pdo")
		{
			if($type == "pdo") {
				$result = $this->pdo->prepare($sql);
				return $result->execute();
			} else {
				return $this->mysqli->query($sql);
			}
		}
		
		// PDO only
		public function sqlPrepare($sql)
		{
			$this->result = $this->pdo->prepare($sql);
		}
		
		public function bindParameter($param, $value, $type)
		{
			$this->result->bindValue($param, $value, $type);
		}
		
		public function executeNonQuery()
		{
			$this->result->execute();
		}
		
		public function executeQuery($func)
		{
			$this->result->execute();
			return $this->result->$func(PDO::FETCH_ASSOC);
		}
	}
?>