<?php
	namespace Controllers;
	use Models\PostList;
	class PostDisplayController
	{
		public $twig;
		public function __construct()
		{
			$loader=new \Twig_Loader_Filesystem(__DIR__ . '/../views');
			$this->twig=new \Twig_Environment($loader);
		}



		//$_SERVER['REQUEST_METHOD'] -> request method
		public function get()
		{
			$posts=PostList::getPosts(0);
			foreach($posts as $index => $value)
			{
				$date=new \DateTime();
				$date->setTimeStamp($value['created_at']);
				$posts[$index]['date']=$date->format('Y-m-d H:i:s');
			}
			echo $this->twig->render("view_posts.html",array(
				"title" => "Posts | MVC Blog",
				"posts" => $posts

				));
		}
		public function post()
		{
			$title=$_POST['title'];
			

			$content=$_POST['content'];
			
			
			
			$created=Post::create($title,$content);
			
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