<?php
	require_once __DIR__ . "/../vendor/autoload.php";
	Toro::serve(array(
		"/" => "Controllers\\HomeController",
		"/create" => "Controllers\\PostCreateController",
		"/posts/all" => "Controllers\\PostDisplayController",
		"/posts/:number" => "Controllers\\SinglePostDisplayController",
		"/register" => "Controllers\\RegisterController",
		"/login" => "Controllers\\LoginController"
		));
	