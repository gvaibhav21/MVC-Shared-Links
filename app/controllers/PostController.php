<?php
	namespace Controllers;
	use Models\Post;
	class PostController
	{
		protected $twig;
		public function __construct()
		{
			$loader=new \Twig_Loader_Filesystem(__DIR__ . '/../views');
			$this->twig=new \Twig_Environment($loader);
		}



		//$_SERVER['REQUEST_METHOD'] -> request method
		public function get()
		{
			echo $this->twig->render("create.html",array(
				"title" => "MVC Blog",
				"messages" => array("Hello World!!","again,hello!!")

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
				session_start();
				if(isset($_SESSION['loggenIn']))
				{
					$loggedIn=1;
				}
				else
					$loggedIn=0;
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				$posts=PostList::getPosts(0);
				foreach($posts as $index => $value)
				{
					$date=new \DateTime();
					$date->setTimeStamp($value['created_at']);
					$posts[$index]['date']=$date->format('Y-m-d H:i:s');
				}
				echo $this->twig->render("view_posts.html",array(
					"title" => "Posts | MVC Blog",
					"posts" => $posts,
					"loggedIn" => $loggedIn
				));
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