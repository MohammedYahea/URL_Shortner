<?php
	
	session_start();
	require_once 'classes/Shortner.php';

	$s = new Shortner;

	if(isset($_POST['url'])){
		$url = $_POST['url'];

		if($code = $s->makeCode($url)){
			$_SESSION['feedback'] = "Generated! Your short URL is: <a href=\"http://localhost:81/url_shortner_new/{$code}\">http://localhost:81/url_shortner_new/{$code}</a>";
		}else{
			//there was a problem 
			$_SESSION['feedback'] = "There was a problem , Invalid URL perhaps";
		}
	}

	header('Location: index.php');

