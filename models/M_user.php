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
		$sql = "INSERT INTO users(`email`, `first_name`, `last_name`, `password`) VALUES('".$post['email']."', '".$post['firstname'] ."', '".$post['lastname'] ."', '".$post['password'] ."')";
		$db->insert_update($sql);
		print_r($_POST);
	}

    public function getOne($db, $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $db->fetch($sql);
        $json = json_encode($result);

        return $json;
    }
	
	public function edit($db, $id, $post)
	{
		print_r($post);
		$sql ="UPDATE users SET email = '". $post['email']."', first_name = '".$post['firstname']."', last_name = '".$post['lastname']."', password = '".$post['password']."' where id = " .$id;
		$result = $db->insert_update($sql);
	}
}
