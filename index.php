<?php
	define('VIEWS_PATH','views/');

	require_once(VIEWS_PATH.'header.php'); 
	
	require_once('controllers/HomeController.php');	
	$controller = new HomeController();
	$controller->run();

	require_once(VIEWS_PATH.'footer.php');
?>