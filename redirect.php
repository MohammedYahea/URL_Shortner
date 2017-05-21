<?php
	require_once 'classes/Shortner.php';


	if (isset($_GET['code'])) {
		$s = new Shortner;

		$code = $_GET['code'];

		if ($url = $s->getUrl($code)) {
			header("Location: {$url}");
			die();
		
		}
	
	}

	header('Location: index.php');

