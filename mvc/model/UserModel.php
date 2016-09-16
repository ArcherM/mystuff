<?php

class UserModel extends Model {
	
	
	public function __construct($database) {
		$db = $database;
    }

	public function getUserInfo ($db,$name) {
		$name = $this->clean($name);
		return($db->exec("SELECT * FROM users WHERE name = '$name'"));
	}
	
	public function addUser ($db,$name,$pass) {
		$name = $this->clean($name);
		$pass = $this->clean($pass);
		$db->exec("INSERT INTO users (name, pass) VALUES ('$name', '$pass')");
	}
	
	public function delUser ($db,$name) {
		$name = $this->clean($name);
		$db->exec(
			array(
				"INSERT INTO users (name, pass) VALUES ('$name', '$pass')",
				""
			)
		);
	}
}