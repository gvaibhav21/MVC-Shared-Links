<?php
	namespace Models;
	class Post
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

		public static function create($title,$content)
		{
			session_start();
			$db=self::getDB();
			$time=time();
			$statement=$db->prepare("INSERT INTO posts(title, content, created_at, username) VALUES(:title, :content, :created_at, :username)");
			$result=$statement->execute(array(
				"title" => $title,
				"content" => $content,
				"created_at" => $time,
				"username" => $_SESSION['username'] 
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