<?php

class Validation
{
    public function validateForm($propertys, $types){
		$check = true;
		foreach($propertys as $key => $val)
		{
			if(!$this->validateProperty($val, $types[$key])){
				$check = false;
			}	
		}
		//var_dump($check);
		return $check;
	}
	public function validateProperty($property, $type)
	{
		if($type == 'string') {
			$pattern = "/[a-zA-Z]+/";
		} else if($type == 'email') {
			$pattern = '/[a-zA-Z0-9]+@{1}[a-z]+.{1}[a-zA-Z]{1,10}/';
		} else if($type == 'password'){
			return true;
		}
		
		echo $pattern.' '. $property .' ';
		if(preg_match(trim($pattern), $property)){
			//echo 'matched<br>';
			return true;
		} else {
			//echo'<br>false '. $property. ' ' .$pattern.'<br>';
			return false;
		}
	}
}
