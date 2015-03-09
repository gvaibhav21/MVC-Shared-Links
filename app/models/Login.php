<?php
	namespace Models;
	class Login
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

		public static function login($username,$password)
		{
			$db=self::getDB();
			$users=array();
			$statement=$db->prepare("SELECT * FROM users WHERE username='{$username}' AND password='{$password}'");
			$statement->execute();
			while($row=$statement->fetch(\PDO::FETCH_ASSOC))
			{
				$users[]=$row;
			}
			if(count($users)==1)
				return true;
			else
				return false;
		}
		public static function getPost($id)
		{
			$db=self::getDB();
			$statement=$db->prepare("SELECT * FROM posts WHERE id=:id");
			$statement->bindValue(':id',$id,\PDO::PARAM_INT);
			$statement->execute();
			$row=$statement->fetch(\PDO::FETCH_ASSOC);
			return $row;
		}
	}