<?php
	# Variable(s) globale(s) du site
	define('CHEMIN_VUES','views/');

	# Ecrire ici le header commun à toutes les vues
	require_once(CHEMIN_VUES.'header.php'); 
	
	# Appeler ici le contrôleur à exécuter
	require_once('controllers/AccueilController.php');	
	$controller = new AccueilController();
	$controller->run();
	
	# Ecrire ici le footer commun à toutes les vues
	require_once(CHEMIN_VUES.'footer.php');
?>