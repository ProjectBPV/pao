<?php

class form extends functions {

    private $_passed = false,
            $_errors = array();

    public function __construct() 
    {
		parent::__construct();
    }

    public function check($source, $items = array()) 
    {    	
    	foreach ($items as $item => $rules) 
        {
        	// Debug
			/*echo $source[$item];
			$this->printvar($rules, true);*/
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
    	
		
		// oude code niet gebruiken
        /*
        foreach ($items as $item => $rules) 
        {
            foreach ($rules as $rule => $rule_value) 
            {
                $value = trim($source[$item]);
                $item = escape($item);
				
                $user = new User();

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is verplicht");
                } elseif(!empty($value)) {
                    switch ($rule) 
                    {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                        break;

                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                        break;

                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
						break;
							
                        case 'unique':
							
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
							
                            if ($check->count()) {
                                $this->addError("{$item} bestaat al");
                            }
                           break;

                        case 'uniquechange':
                            $userid = $this->_db->get($rule_value, array($item, '=', $value));
                            foreach ($userid->results() as $key => $value2) 
                            {
                                $check = $this->_db->get($rule_value, array($item, '=', ($value . "AND `ID` <> " . $value2->ID)));
                            }               
                            if ($check->count()) {
                                $this->addError("{$item} bestaat al");
                            }						
						break;
	                }
	            }
	        }
	        if (empty($this->_errors)) {
	            $this->_passed = true;
	        }
	        return $this;
	    }
		 */
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}
