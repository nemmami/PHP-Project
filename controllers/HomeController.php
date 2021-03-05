<?php 
class HomeController {
		
	public function __construct(){	

	}
	
	public function run(){	
		$notification = "Hello World !";

		require_once(VIEWS_PATH.'home.php');
	}
	
}
?>