<?php

namespace M;

class json
{
	public function GetJson($url)
	{
		return file_get_contents($url);
	}

	public function GetNoJson($url)
	{
		return json_decode(file_get_contents($url),true);
	}
}
