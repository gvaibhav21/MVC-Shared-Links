<?php
	namespace Models;
	class PostList
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

		public static function getPosts($offset,$limit=10)
		{
			$db=self::getDB();
			$posts=array();
			$statement=$db->prepare("SELECT * FROM posts ORDER BY id DESC");
			$statement->bindValue(':limit',$limit,\PDO::PARAM_INT);
			$statement->bindValue(':offset',$offset,\PDO::PARAM_INT);

			$statement->execute();
			while($row=$statement->fetch(\PDO::FETCH_ASSOC))
			{
				$posts[]=$row;
			}
			return $posts;
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