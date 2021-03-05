<?php
	define('VIEWS_PATH','views/');

	function loadClass($className) {
		require_once('models/' . $className . '.class.php');
	}
	spl_autoload_register('loadClass');

	$db=Db::getInstance();

	include(VIEWS_PATH.'header.php'); 
	
	require_once('controllers/HomeController.php');	
	$controller = new HomeController($db);
	$controller->run();

	include(VIEWS_PATH.'footer.php');
?>