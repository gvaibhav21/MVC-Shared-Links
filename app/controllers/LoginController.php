<?php
	namespace Controllers;
	use Controllers\PostDisplayController;
	use Models\Login;
	use Models\PostList;

	class LoginController
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
			echo $this->twig->render("login.html",array(
				"title" => " "

				));
		}
		public function post()
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$loggedIn=Login::login($username,$password);
			if($loggedIn)
			{
				session_start();
				$_SESSION['loggedIn']=1;
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
					"loggedIn" => 1
				));
			}
			else
			{
				echo $this->twig->render("login.html",array(
				"title" => "Invalid Username or Password"

				));
			}

			echo $this->twig->render("post_created.html",array(
				"title" => $message
				));
		}
	}