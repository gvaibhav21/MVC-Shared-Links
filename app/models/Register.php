<?php
	namespace Models;
	class Register
	{
		protected $db;
		public function __construct()
		{
			$this->db = self::getDB();
		}

		public static function getDB()
		{
			return new \PDO("mysql:dbname=blog;host=localhost","root","1234");
		}

		public static function create($username,$password)
		{
			$db=self::getDB();
			$time=time();
			$statement=$db->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
			$result=$statement->execute(array(
				"username" => $username,
				"password" => $password
				));
			var_dump($result);
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}