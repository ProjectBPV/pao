<?php

namespace M;

class user
{
    public function content($db)
    {
        $users = $db->fetchall("SELECT * FROM users");
        $json = json_encode($users);
        return $json;
    }
	public function insert($db, $post)
	{
		print_r($_POST);
	}
}
