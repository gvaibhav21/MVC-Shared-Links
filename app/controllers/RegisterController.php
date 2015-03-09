<?php
	namespace Controllers;
	use Models\Register;
	class RegisterController
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
			echo $this->twig->render("register.html",array(
				"title" => "123"
				
				));
		}
		public function post()
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$created=Register::create($username,$password);
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