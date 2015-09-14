<?php

namespace M;

class json
{
	public function GetJson($url)
	{
		return file_get_contents($url);
	}
}
