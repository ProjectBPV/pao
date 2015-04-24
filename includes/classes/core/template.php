<?php
class template
{
	// $handle = specific template/row
	// $module = specific module required templates or specific area
	
	public function prepare_data($key)
	{
		foreach($key as $val => $ex)
		{
			$this->data[$val] = $ex;
		}
	}
	
	public function prepare_sub($handle,$key)
	{
		if(empty($handle)) {
			echo 'prepare_sub REQUIRES Handle';
			exit;
		}else {
			foreach($key as $val => $ex)
			{
				$this->sub[$handle][$val] = $ex;
			}	
		}
	}
	
	public function prepare_row_vars($handle,$row)
	{
		$temp ='';

		if(!empty($this->exe_block[$handle])) {
			$start = count($this->exe_block[$handle]);
		} else {
			$start = '0';
		}

		foreach($row as $key => $val)
		{
			$i = $start;
			foreach($val as $exe)
			{
				$this->exe_block[$handle][$i][$key] = $exe;	
				$i++;
			}
		}
	}
	public function prepare_row_var($handle,$row)
	{
		$temp ='';

		if(!empty($this->exe_block[$handle])) {
			$start = count($this->exe_block[$handle]);
		} else {
			$start = '0';
		}
		
		foreach($row as $key => $val)
		{
			$i = $start;
			$this->exe_block[$handle][$i][$key] = $val;	
		}
	}
	
	public function pparse_noecho($handle,$module ='')
	{
		if(!empty($module)) {
			$module .= '/';
		}
		$file = getcwd()."/template/$module$handle".'.tpl';
		if(file_exists($file)) {
			
			$html = file_get_contents($file);
			if(!empty($this->sub[$handle])) {
				$exe = $this->sub[$handle];
				foreach($exe as $key => $val)
				{
					$preg = "(\{$key\})";
					
					$html = preg_replace($preg,$val,$html);
				}
			}
			$html = preg_replace('/{\S+}/', '', $this->parse_row_vars($html)); 
			return $html;
		}
		$this->sub[$handle] = array();
	}
	
	public function fetch_tpl($data, $file,$module = '')
	{
		if(!empty($module)) {
			$module .= '/';
		}
		$file = "./template/$module$file.tpl";
		if(file_exists($file)) {
			$html = file_get_contents($file);
			if(!empty($data)) {
				foreach($data as $key => $val)
				{
					$preg = "(\{$key\})";
					
					$html = preg_replace($preg,$val,$html);
				}
			}
			// compiled code
			$this->html = preg_replace('/{\S+}/', '', $this->parse_row_vars($html)); 
			// uncompiled code
			//$this->html = $this->parse_row_vars($html);
		} else {
			$this->error = 'cant find template:'. getcwd() . $file;
		}
	}
	
	public function parse_row_vars($file)
	{
		$patt2 = "/.*/";
		if(!empty($this->exe_block)) {
			foreach($this->exe_block as $row => $useless)
			{
				$replace_row = '{'.$row.'}';
				if(preg_match($patt2,$file)) {
					preg_match_all($patt2, $file, $matches);
					$check = false;
					$pat_start = "/<!-- START $row -->/";
					$pat_end = "/<!-- END $row -->/";		
					foreach($matches[0] as $key)
					{					
						if(preg_match($pat_start,$key)) {
							$file = preg_replace("~$key~",'',$file);
							$check = true;
						} elseif(preg_match($pat_end,$key)) {
							$file = preg_replace("~$key~",$replace_row,$file);
							$check = false;
						} elseif($check) {
							if(!empty($key)) {
								$preg = '('. $key.')';
								$file = preg_replace($preg,'',$file);
								if(!empty($this->rows[$row])) {	
									$this->rows[$row] .= $key;
								}else {
									$this->rows[$row] = $key;
								}
							}
						}
					}
					if(!empty($this->rows)) {
						foreach($this->rows as $row => $rows)
						{
							$end = '';
							if(!empty($this->exe_block[$row])) {
								foreach($this->exe_block[$row] as $key => $val)
								{
									$currow = $rows;
									foreach($val as $exe => $cur)
									{
										$preg = "(\{$row.$exe\})";
										$currow = preg_replace($preg, $cur, $currow);
									}
									$end .= $currow;	
								}
								$set = '/{'.$row.'}/';
								$this->exe_block[$row] = array();
								$file = preg_replace($set,$end,$file);
							}
						}
						$this->rows = array();
					}
				}		
			}
		}	
		return $this->clearEmpty($file);
	}
	private function clearEmpty($file)
	{
		$check = false;
		$patt2 = "/.*/";
		$pat_start = "/<!-- START ([A-Z]+) -->/";
		$pat_end = "/<!-- END ([A-Z]+) -->/";
		preg_match_all($patt2, $file, $matches);
		foreach($matches[0] as $key)
		{
			if(preg_match($pat_start,$key)) {
				$file = preg_replace("/$key/",'',$file);
				$check = true;
			} elseif(preg_match($pat_end,$key)) {
				$file = preg_replace("/$key/",'',$file);
				$check = false;
			} elseif($check) {
				if(!empty($key)) {
					$preg = '('. $key.')';
					$file = preg_replace($preg,'',$file);
				}
			}
		}
		return $file;
	}
	
	public function parse_body($template)
	{
		$this->fetch_tpl($this->data, $template);
		if(empty($this->error)) {
			print $this->html;
		} else {
			print $this->error;
		}
	}
	
	public function throw404($error = '')
	{
		switch($error) 
		{
			case 'moved':
				$content = "The url you have requested doesn't exist. Try using the sitemap";
				break;
			default:
				$content = 'Error 404: the current page does not exist or the url has been changed.';
				break;
		}
		$this->prepare_data(array(
			'CONTENT' => $content
			));
		$this->parse_body('body');
		exit;
	}
}
?>