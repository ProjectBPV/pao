<?php

class form {

    private $_passed = false,
            $_errors = array();

    public function __construct() 
    {
    }

    public function check($source, $items = array()) 
    {    	
    	foreach ($items as $item => $rules) 
        {
        	// Debug
			/*	echo $source[$item];
				$this->printvar($rules, true); */
			foreach ($rules as $rule => $rule_value) 
			{
				switch($rule)
				{
					case 'min':
						if(strlen($source[$item]) < $rule_value){
							$this->error[$item][$rule] = 'false';
						}
						break;
					case 'max':
						if(strlen($source[$item]) > $rule_value){
							$this->error[$item][$rule] = 'false';
						}
						break;
					case 'required';
						if(!empty($source[$item])){
							$this->error[$item][$rule] = 'false';
						}
						break;
					case 'unique':
						// requires database
						break;
				}
				/*if($source[$item])
				echo $rule .' ' . $rule_value.'<br>';*/
			}
		}
		// error display 
		//$this->printvar($this->error, true);
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}
