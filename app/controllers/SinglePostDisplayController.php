<?php
	namespace Controllers;
	use Models\PostList;
	class SinglePostDisplayController
	{
		protected $twig;
		public function __construct()
		{
			$loader=new \Twig_Loader_Filesystem(__DIR__ . '/../views');
			$this->twig=new \Twig_Environment($loader);
		}



		//$_SERVER['REQUEST_METHOD'] -> request method
		public function get($id)
		{
				$post['date']=$date->format('Y-m-d H:i:s');
			echo $this->twig->render("view_post.html",array(
				"title" => "Post ".$id,
				"post" => $post

				));
		}
		public function post()
		{
			$title=$_POST['title'];
			echo "hello1";

			$content=$_POST['content'];
			
			echo "hello2";
			
			$created=Post::create($title,$content);
			echo "hello1";
			
			if($created)
			{
				$message="Post Created";
			}
			else
			{
				$message="Post Creation failed";
			}

			echo $this->twig->render("post_created.html",array(
				"title" => $message
				));
		}
	}